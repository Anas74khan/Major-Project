<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Cart;

class OrderController extends Controller
{

    public $productImagePath = "images/products/";
    
    public function view(Request $request, $status = "all", $page = 0){

        $orderIndex = $this -> index($status,$page);
        $pageData = [
            'admin' => $request -> admin,
            'breadcrumbs' => [['name' => 'All orders']],
            'orders' => $orderIndex['orders'],
            'totalPages' => $orderIndex['totalPages'],
            'status' => $status
        ];

        if($status === "pending")
            $pageData['breadcrumbs'][0]['name'] = "pending orders";
        else if($status === "under_process")
            $pageData['breadcrumbs'][0]['name'] = "orders under process";
        else if($status === "cancelled")
            $pageData['breadcrumbs'][0]['name'] = "cancelled orders";
        else if($status === "completed")
            $pageData['breadcrumbs'][0]['name'] = "completed orders";
        else
            $status = "all";

        return view('pages.orders',$pageData);
    }

    public function viewOrder(Request $request, $orderNo = null){
        $order = Order :: where('orderNo', $orderNo)
                    -> join('products', 'orders.productId', '=', 'products.id')
                    -> join('varieties', 'orders.varietyId', '=', 'varieties.id')
                    -> join('tags', 'tags.id', '=', 'products.brand')
                    -> first([
                        'varieties.images', 'tags.tag AS brand', 'orders.orderNo',
                        'orders.productName', 'orders.sellingPrice', 'orders.offerPrice',
                        'orders.offerEnable', 'orders.name', 'orders.type',
                        'orders.mobileNo', 'orders.address1', 'orders.address2',
                        'orders.pincode', 'orders.city', 'orders.state',
                        'orders.status', 'orders.id', 'orders.quantity'
                    ]);
        
        $order['offerPercentage'] = 0;
        if(!empty($order['id'])){
            $order['image'] = asset($this -> productImagePath . json_decode($order['images'], true)[0]);
            $order['offerPercentage'] = round((($order['sellingPrice'] - $order['offerPrice']) / $order['sellingPrice']) * 100);
        }
        else
            $order['images'] = asset('images/placeholder.png');

        $pageData = [
            'admin' => $request -> admin,
            'breadcrumbs' => [
                ['name' => 'Order', 'url' => url('orders')],
                ['name' => $order['orderNo']]
            ],
            'order' => $order
        ];
        
        return view('pages.order',$pageData);
    }

    // Action

    public function index($status = null, $page = 0){

        $orders = Order :: skip($page * 20)
            -> take(20)
            -> join('products', 'orders.productId', '=', 'products.id')
            -> join('varieties', 'orders.varietyId', '=', 'varieties.id')
            -> join('statuses', 'orders.status', '=', 'statuses.id')
            -> orderBy('orders.id','DESC');
        
        $totalPages = null;

        if($status === "pending"){
            $orders -> where('orders.status', '=', 1);
            $totalPages = Order :: where('orders.status', '=', 1);
        }
        else if($status === "under_process"){
            $orders -> where('orders.status', '>', 2) -> where('orders.status', '<', 6);
            $totalPages = Order :: where('orders.status', '>', 2) -> where('orders.status', '<', 6);
        }
        else if($status === "cancelled"){
            $orders -> where('orders.status', '=', 2);
            $totalPages = Order :: where('orders.status', '=', 2);
        }
        else if($status === "completed"){
            $orders -> where('orders.status', '=', 6);
            $totalPages = Order :: where('orders.status', '=', 6);
        }
        else $totalPages = Order :: where('orders.status', '>', 0);

        $orders = $orders -> get([
            'statuses.status',
            'orders.status AS statusId',
            'products.name AS productName',
            'varieties.name AS varietyName',
            'varieties.images',
            'orders.orderNo',
            'orders.quantity',
            'orders.name',
            'orders.mobileNo',
            'orders.address1',
            'orders.address2',
            'orders.pincode',
            'orders.city',
            'orders.state',
            'orders.type'
        ]);

        for($i = 0; $i < count($orders); $i++)
            $orders[$i]['images'] = json_decode($orders[$i]['images'],true);


        return [
            'success' => true,
            'currentPage' => $page,
            'totalPages' => ($totalPages -> count()) / 20,
            'orders' => $orders
        ];
    }

    public function apiIndex(Request $request, $from = 0){
        $from--;
        if((int)$from < 1) $from = 0;

        $orders = Order :: where('userId',$request -> user['id']) -> take(20) -> skip($from) -> orderBy('id','DESC') -> get();

        return ['success' => true, 'orders' => $orders];
    }

    public function orderCart(Request $request){
        $address = [
            'name' => $request -> input('name'),
            'mobileNo' => $request -> input('mobileNo'),
            'address1' => $request -> input('address1'),
            'pincode' => $request -> input('pincode'),
            'city' => $request -> input('city'),
            'state' => $request -> input('state')
        ];
        
        $cart = Cart :: join('varieties','varieties.id','=','carts.varietyId')
                    -> join('products','products.id','=','carts.productId')
                    -> where('userId', $request -> user['id'])
                    -> get(['carts.id','carts.productId','carts.varietyId','carts.quantity',Cart::raw('CONCAT(products.name," | ",varieties.name) AS productName'),'varieties.sellingPrice','varieties.offerPrice','varieties.offerEnable']);
        if(count($cart) < 1)
            return ['success' => false, 'code' => 121, 'text' => 'Cart is empty.'];

        $response = ['success' => false, 'code' => 122];
        foreach($address as $key => $data){
            if(empty($data)){
                $response['text'] = $key .' is required';
                return $response;
            }
        }
        $address['address2'] = $request -> input('address1');
        $address['type'] = $request -> input('type') == 'Office' ? 'Office' : 'Home';

        $orders = [];
        for($i = 0; $i < count($cart); $i++){
            array_push($orders,new Order());
            $orders[$i] -> userId = $request -> user['id'];
            $orders[$i] -> orderNo = time().$i.$orders[$i] -> userId;
            foreach($address as $key => $data)
                $orders[$i] -> $key = $data;

            $orders[$i] -> productId = $cart[$i]['productId'];
            $orders[$i] -> varietyId = $cart[$i]['varietyId'];
            $orders[$i] -> quantity = $cart[$i]['quantity'];
            $orders[$i] -> productName = $cart[$i]['productName'];
            $orders[$i] -> sellingPrice = $cart[$i]['sellingPrice'];
            $orders[$i] -> offerPrice = $cart[$i]['offerPrice'];
            $orders[$i] -> offerEnable = $cart[$i]['offerEnable'];

            $orders[$i] -> save();

            Cart :: where('id', $cart[$i]['id']) -> delete();
        }

        return ['success' => true, 'orders' => $orders];
    }

    public function cancelOrder(Request $request,$id){
        $order = ['status' => 2];

        $status = Order :: where('userId',$request -> user['id']) -> where('id',$id) -> where('status','<',5) -> update($order);

        $order['id'] = $id;

        if($status)
            return ['success' => true, 'order' => $order];
        
        return ['success' => false, 'code' => 123, 'text' => 'Invalid action.'];
    }

}
