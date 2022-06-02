<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Status;

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
            'order' => $order,
            'statuses' => Status :: get()
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

        $orders = Order :: where('userId',$request -> user['id'])
                        -> join('varieties', 'varieties.id', '=', 'orders.varietyId')
                        -> join('statuses', 'statuses.statusId', '=', 'orders.status')
                        -> take(20)
                        -> skip($from)
                        -> orderBy('orders.id','DESC')
                        -> get([
                            'orders.orderNo','orders.quantity','orders.name',
                            'orders.mobileNo','orders.address1','orders.pincode',
                            'orders.city','orders.state','orders.type',
                            'orders.updated_at AS actionDate','orders.productName','orders.sellingPrice',
                            'orders.offerPrice','orders.offerEnable','varieties.images AS image',
                            'statuses.status'
                        ]);
        
        for($i = 0; $i < count($orders); $i++){
            $orders[$i]['image'] = asset($this -> productImagePath.json_decode($orders[$i]['image'], true)[0]);
            $orders[$i]['actionDate'] = date('d M Y', strtotime($orders[$i]['actionDate']));
        }

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

    public function cancelOrder(Request $request,$orderNo = 0){
        $order = ['status' => 2];

        $status = Order :: where('userId',$request -> user['id']) -> where('orderNo',$orderNo) -> where('status','<',5) -> update($order);

        $order['orderNo'] = $orderNo;

        if($status)
            return ['success' => true, 'order' => $order];
        
        return ['success' => false, 'code' => 123, 'text' => 'Invalid action.'];
    }

    public function rejectOrder(Request $request,$orderNo = 0){
        $result = [];
        $result['success'] = Order :: where('orderNo', $orderNo) -> where('status', 1) -> update(['status' => 7]);

        if($result['success'])
            $result['text'] = "Product rejected successfully.";
        else
            $result['text'] = "Action error: some error occured.";
        
        return $result;
    }

    public function nextAction(Request $request,$orderNo = 0){
        $result = ['success' => false];
        $order = Order ::where('orderNo', $orderNo) -> where('status', '<', 6) -> where('status', '!=', 2) -> first();
        
        if(empty($order['id']))
            $result['text'] = "Invalid action: order has no actions available.";
        else{
            $status = 3;
            if($order['status'] != 1)
                $status = $order['status'] + 1;
            
            $result['success'] = Order :: where('id', $order['id']) -> update(['status' => $status]);

            if($result['success'])
                $result['text'] = "Status updated successfully;";
            else
                $result['text'] = "Error occured: Some error occured try again later.";
        }

        return $result;
    }

    public function order(Request $request, $orderNo = 0){
        $order = Order :: where('userId',$request -> user['id'])
                        -> where('orderNo', $orderNo)
                        -> join('varieties', 'varieties.id', '=', 'orders.varietyId')
                        -> join('statuses', 'statuses.statusId', '=', 'orders.status')
                        -> first([
                            'orders.orderNo','orders.quantity','orders.name',
                            'orders.mobileNo','orders.address1','orders.pincode',
                            'orders.city','orders.state','orders.type',
                            'orders.updated_at AS actionDate','orders.productName','orders.sellingPrice',
                            'orders.offerPrice','orders.offerEnable','varieties.images AS image',
                            'statuses.status', 'orders.id', 'statuses.statusId'
                        ]);

        if($order['id'] < 1) return ['success' => false, 'code' => 203, 'text' => 'Order not found.'];
        
        $order['image'] = asset($this -> productImagePath.json_decode($order['image'], true)[0]);
        $order['actionDate'] = date('d M Y', strtotime($order['actionDate']));

        return ['success' => true, 'order' => $order];
    }

}
