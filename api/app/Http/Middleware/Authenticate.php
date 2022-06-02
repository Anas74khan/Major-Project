<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin;
use App\Models\User;

class Authenticate
{
    
    public function handle($request, Closure $next, $type)
    {
        if($type == "api" || $type == "apiUser"){
            $token = $request -> bearerToken();
            $user = User :: where('remember_token', $token)
                        -> first([
                            'name','email','username','id',
                            User :: raw('(SELECT SUM(carts.quantity) FROM carts WHERE carts.userId = users.id) AS cart')
                        ]);
            if($user !== null)
                $request -> user = $user;
            else if($type != "apiUser")
                return redirect('api/unauthorize');
        }
        else{
            $adminId = $request -> session() -> get('adminId');
            if (empty($adminId)) 
                return redirect('login');
                
            $request -> admin = Admin :: where('id',$adminId) -> first();
        }

        return $next($request);
    }
    
}
