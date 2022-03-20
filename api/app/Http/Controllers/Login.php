<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class Login extends Controller
{

    public function index(Request $request){
        $adminId = $request -> session() -> get('adminId');
        if(!empty($adminId))
            return redirect('dashboard');
        return view('pages.login');
    }

    public function login(Request $request){

        $result = ["result" => false];

        $adminId = $request -> session() -> get('adminId');
        if(!empty($adminId))
            $result['error'] = "Already logged in";
        else{

            $username = $request -> input('username');
            $password = sha1($request -> input('password'));

            $error = false;
            if(empty($username) || empty($password)) $error = true;
            
            if($error)
                $result['error'] = "All parameters are required";
            else {
                $admins = Admin :: where('username',$username)
                    -> where('password',$password)
                    -> get();
                if(count($admins) == 1){
                    $request->session()->put('adminId',$admins[0]['id']);
                    $result['result'] = true;
                }
                else
                    $result['error'] = "Invalid login credentials";
            }
            
        }

        return $result;
    }

    public function logout(Request $request){
        $request -> session() -> forget('adminId');
    }
}
