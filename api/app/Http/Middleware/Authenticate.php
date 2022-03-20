<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin;
use App\Models\User;

class Authenticate
{
    
    public function handle($request, Closure $next)
    {
        if($request -> is('api/*')){
            $token = $request -> bearerToken();
            $user = User :: where('remember_token', $token) -> get();
            if(count($user) != 1)
                return redirect('api/unauthorize');
            $request -> user = $user[0];
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
