<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    
    public function get(Request $request){
        $address = Address :: where('userId', $request -> user['id']) -> get();

        return ['success' => true, 'addresses' => $address];
    }

    public function add(Request $request){
        $temp = [
            'name' => $request -> input('name'),
            'mobileNo' => $request -> input('mobileNo'),
            'address1' => $request -> input('address1'),
            'pincode' => $request -> input('pincode'),
            'city' => $request -> input('city'),
            'state' => $request -> input('state')
        ];

        $address = new Address();
        $response = ['success' => false,'code' => 131];
        foreach($temp as $key => $data){
            if(empty($data)){
                $response['text'] = $key . ' is required';
                return $response;
            }
            $address -> $key = $data;
        }
        $address -> address2 = $request -> input('address2');
        $address -> type = $request -> input('address2') == "Office" ? 'Office' : 'Home';
        $address -> userId = $request -> user['id'];

        $address -> save();
        $address -> inUse = 1;

        $this -> inUse($request -> user['id'],$address -> id);
        return ['success' => true, 'address' => $address];
    }

    public function update(Request $request){
        $address = [
            'name' => $request -> input('name'),
            'mobileNo' => $request -> input('mobileNo'),
            'address1' => $request -> input('address1'),
            'pincode' => $request -> input('pincode'),
            'city' => $request -> input('city'),
            'state' => $request -> input('state')
        ];
        $status = Address :: where('id',$request -> input('id')) -> where('userId',$request -> user['id']) -> get();

        if(count($status) != 1)
            return ['success' => false,'code' => 132, 'text' => 'Invalid address id.'];
        
        $response = ['success' => false,'code' => 131];
        foreach($address as $key => $data){
            if(empty($data)){
                $response['text'] = $key . ' is required';
                return $response;
            }
        }
        $address['address2'] = $request -> input('address2');
        $address['type'] = $request -> input('type');
        
        Address :: where('id',$request -> input('id')) -> where('userId',$request -> user['id']) -> update($address);

        $address['id'] = $request -> input('id');
        $address['inUse'] = 1;
        $this -> inUse($request -> user['id'],$address['id']);
        return ['success' => true, 'address' => $address];

    }

    public function delete(Request $request, $id){
        $status = Address :: where('id',$id) -> where('id',$request -> user['id']) -> delete();

        if($status)
            return ['success' => true, 'text' => 'Address deleted successfully.'];
        
        return ['success' => false, 'code' => 133, 'text' => 'Address not found.'];
    }

    public function useAddress(Request $request, $id){
        $status = Address :: where('id',$id) -> where('id',$request -> user['id']) -> get();

        if(count($status) != 1)
            return ['success' => false, 'code' => 133, 'text' => 'Address not found.'];

        $this -> inUse($request -> user['id'],$id);
        return ['success' => true, 'address' => ['id' => $id]];
    }

    protected function inUse($userId,$id){
        Address :: where('userId',$userId) -> update(['inUse' => 0]);
        Address :: where('userId',$userId) -> where('id',$id) -> update(['inUse' => 1]);
    }

}
