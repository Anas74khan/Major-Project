<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Variety;

class CartController extends Controller
{
    
    protected $productImage = "images/products/";
    public function get(Request $request){
        $user = $request -> user;

        $carts = Cart :: where('userId',$user['id'])
                        -> join('products','products.id', '=', 'carts.productId')
                        -> join('varieties','varieties.id', '=', 'carts.varietyId')
                        -> get([
                            'products.name AS productName', 'varieties.name AS varietyName', 'varieties.sellingPrice',
                            'varieties.offerPrice','varieties.offerPercentage','varieties.offerEnable',
                            'carts.quantity', 'varieties.images AS image', 'carts.productId', 'carts.id'
                        ]);

        for($i = 0; $i < count($carts); $i++)
            $carts[$i]['image'] = asset($this -> productImage.json_decode($carts[$i]['image'], true)[0]);

        return ['success' => true, 'carts' => $carts, 'addresses' => (AddressController :: get($request))['addresses']];
    }

    public function add(Request $request){

        $cart = new Cart();
        $cart -> userId = $request -> user['id'];
        $cart -> productId = $request -> input('productId');
        $cart -> varietyId = $request -> input('varietyId');
        $cart -> quantity = 1;

        if(empty($cart -> productId) || empty($cart -> varietyId))
            return ['success' => false, 'code' => 111, 'text' => 'All fields not provided.'];
        
        $temp = Variety :: where('id', $cart['varietyId']) -> where('productId', $cart['productId']) -> get();
        if(count($temp) == 0)
            return ['success' => false, 'code' => 112, 'text' => 'Invalid product variety.'];
        
        try{
            $cart -> save();
            return ['success' => true, 'cart' => $cart];
        } catch (\Illuminate\Database\QueryException $e) {
            return ['success' => false, 'code' => 113, 'text' => 'Product already in cart.'];
        }

    }

    public function update(Request $request){
        $cart = ['quantity' => (int)$request -> input('quantity')];

        if($cart['quantity'] < 1)
            return ['success' => false, 'code' => 105, 'text' => 'Invalid quantity.'];

        $status = Cart :: where('userId',$request -> user['id']) -> where('id',$request -> input('id')) -> update($cart);

        $cart['id'] = $request -> input('id');
        if($status)
            return ['success' => true, 'text' => 'Quantity updated successfully.', 'cart' => $cart];
            
        return ['success' => false, 'code' => 106, 'text' => 'Invalid request.'];
    }

    public function delete(Request $request,$id){
        $status = Cart :: where('id',$id) -> where('userId',$request -> user['id']) -> delete();

        if($status)
            return ['success' => true, 'text' => 'Product removed from cart.'];

        return ['success' => false, 'code' => 104, 'text' => 'Cart does not exist.'];
    }

}
