<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    
    protected $table = [
        'tableName' => 'users',
        'fieldDetails' => [
            'name' => [
                'name'     => 'name',
                'label'    => 'Name',
            ],
            'email' => [
                'name'     => 'email',
                'label'    => 'Email',
            ],
            'username' => [
                'name' => 'username',
                'label' => 'Username',
            ],
        ],
    ];

    public function viewIndex(Request $request){
        $this -> table['actions'] = [];
        $this -> table['listFields'] = ['name','email','username'];
        $this -> table['addFields'] = [];
        $this -> table['editFields'] = [];
        $this -> table['admin'] = $request -> admin;
        $this -> table['pageName'] = 'users';
        $this -> table['url'] = url('users');
        $this -> table['breadcrumbs'] = [
            ['name' => "Users"]
        ];

        return view('pages.table', $this -> table);
    }

    public function index(Request $request){
        $users = User :: get(['name','email','username']);
        return [
            'success' => true,
            'users' => $users
        ];
    }

    public function login(Request $request)
    {
        $username = $request -> input('username');
        $password = $request -> input('password');

        if(empty($username) || empty($password))
            return ['success' => false, 'code' => 101, 'text' => 'All fields are required.'];

        
        $users = User :: where('username',$username)
            -> where('password',$password) -> get();

        if(count($users) == 1)
            return ['success' => true, 'access_token' => $users[0]['remember_token']];

        return ['success' => false, 'code' => 102, 'text' => 'Invalid login credentials.'];
    }

    public function register(Request $request){
        $user = [
            'username' => $request -> input('username'),
            'password' => $request -> input('password'),
            'email' => $request -> input('email'),
            'name' => $request -> input('name'),
        ];
        
        if(empty($user['username']) || empty($user['password']) || empty($user['email']) || empty($user['name']))
            return ['success' => false, 'code' => 103, 'text' => 'All fields are required.'];
        
        if(strlen($user['username']) < 6)
            return ['success' => false, 'code' => 104, 'text' => 'Username must be atleast 6 character long.'];
        
        if(strlen($user['password']) < 6)
            return ['success' => false, 'code' => 105, 'text' => 'Password must be atleast 6 character long.'];

        $temp = User :: where('username' , $request['username']) -> get();
        if(count($temp) > 0)
            return ['success' => false, 'code' => 106, 'text' => 'Username already taken.'];
        
        $temp = User :: where('email',$request['email']) -> get();
        if(count($temp) > 0)
            return ['success' => false, 'code' => 107, 'text' => "Email already exists"];

        $user['remember_token'] = time().Str::random(55);

        User::create($user);
        return ['success' => true, 'access_token' => $user['remember_token']];
    }

    public function notLogin(){
        return array('result' => false , 'error' => 'Not logged in.');;
    }
    
}
