<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    
    protected $table = [
        'tableName' => 'admins',
        'fieldDetails' => [
            'type' => [
                'type'     => 'select',
                'name'     => 'type',
                'label'    => 'Admin type',
                'required' => true,
                'feedback' => "Admin type is required.",
                'options' => [
                    ['id' => 1, 'value' => 'Admin'],
                    ['id' => 2, 'value' => 'Sub admin'],
                    ['id' => 3, 'value' => 'Employee']
                ]
            ],
            'name' => [
                'type'     => 'text',
                'name'     => 'name',
                'label'    => 'Admin name',
                'required' => true,
                'feedback' => "Name is required."
            ],
            'username' => [
                'type'     => 'text',
                'name'     => 'username',
                'label'    => 'Username',
                'required' => true,
                'feedback' => "Username is required."
            ],
            'email' => [
                'type'     => 'email',
                'name'     => 'email',
                'label'    => 'Email',
                'required' => true,
                'feedback' => "Email is required."
            ],
            'mobileNo' => [
                'type'     => 'text',
                'name'     => 'mobileNo',
                'label'    => 'Mobile number'
            ]
        ],
    ];

    public function profile(Request $request){
        return $this -> view($request, $request -> admin['id']);
    }
    
    public function view(Request $request,$id = null){
        if($id)
            return view('pages.profile', [
                'breadcrumbs' => [
                    ['name' => "Admins", "url" => url('admin')],
                    ["name" => "profile"]
                ],
                'admin' => $request -> admin,
                "profile" => Admin :: where('id', $id) -> first(),
                "types" => ["Admin","Sub Admin","Employee"]
            ]);

        $this -> table['actions'] = ['add' => true, 'edit' => false];
        $this -> table['listFields'] = ['type','name','username','email','mobileNo'];
        $this -> table['addFields']  = ['type','name','username','email','mobileNo'];
        $this -> table['extraActions'] = [
            [
                'link' => url('admin/{id}'),
                'name' => 'Employee Profile',
                'class' => 'btn-primary',
                'icon' => 'mdi mdi-account',
                'replace' => ['{id}' => 'id']
            ]
        ];
        $this -> table['admin'] = $request -> admin;
        $this -> table['pageName'] = 'admins';
        $this -> table['url'] = url('admins');
        $this -> table['breadcrumbs'] = [
            ['name' => "Admins"]
        ];
        
        return view('pages.table', $this -> table);
    }

    public function index(Request $request){
        $admins = Admin :: where('id' ,'!=', $request -> admin['id']) -> get(['id','type','name','username','email','mobileNo','address','description','authorize']);

        return [
            'success' => true,
            'admins' => $admins
        ];
    }

}
