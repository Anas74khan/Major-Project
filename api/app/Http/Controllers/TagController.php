<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{

    protected $table = [
        'tableName' => 'tags',
        'actions' => [
            'add' => true,
            'edit' => true,
            'delete' => true
        ],
        'listFields' => ['tag', 'icon', 'slug'],
        'addFields' => ['tagRefId','tagTypeId','tag','icon'],
        'editFields' => ['tagRefId','tagTypeId','tag','icon'],
        'fieldDetails' => [
            'icon' => [
                'type' => 'text',
                'name' => 'icon',
                'label' => 'Icon',
                'required' => true,
                'feedback' => "Please provide a icon"
            ],
            'slug' => [
                'name' => 'slug',
                'label' => 'Search Text'
            ],
        ],
    ];
    
    
    public function categoryView(Request $request){
        $this -> table['admin'] = $request -> admin;
        $this -> table['pageName'] = 'categories';
        $this -> table['url'] = url('categories');
        $this -> table['breadcrumbs'] = [
            ['name' => "Categories"]
        ];
        $this -> table['fieldDetails']['tagRefId'] = [
            'type'     => 'hidden',
            'name'     => 'tagRefId',
            'value'    => '0'
        ];
        $this -> table['fieldDetails']['tagTypeId'] = [
            'type'     => 'hidden',
            'name'     => 'tagTypeId',
            'value'    => '1'
        ];
        $this -> table['fieldDetails']['tag'] = [
            'type'     => 'text',
            'name'     => 'tag',
            'label'    => 'Category name',
            'required' => true,
            'feedback' => "Please enter a valid name"
        ];
        return view('pages.table', $this -> table);
    }
    public function categories(Request $request){
        return $this -> index(null,$request);
    }
    

    public function subcategoryView(Request $request){
        $this -> table['admin'] = $request -> admin;
        $this -> table['pageName'] = 'subcategories';
        $this -> table['url'] = url('subcategories');
        $this -> table['breadcrumbs'] = [
            ['name' => "Sub categories"]
        ];
        $this -> table['fieldDetails']['tagRefId'] = [
            'type'     => 'select',
            'name'     => 'tagRefId',
            'label'    => 'Category',
            'required' => true,
            'feedback' => "Category is required.",
            'relation' => 'tags'
        ];
        $this -> table['fieldDetails']['tagTypeId'] = [
            'type'     => 'hidden',
            'name'     => 'tagTypeId',
            'value'    => '2'
        ];
        $this -> table['fieldDetails']['tag'] = [
            'type'     => 'text',
            'name'     => 'tag',
            'label'    => 'Sub category name',
            'required' => true,
            'feedback' => "Please enter a valid name"
        ];
        $this -> table['extraFilter'] = [
            [
                'field' => 'tagRefId',
                'Lable' => 'Category',
                'all' => true
            ]
        ];
        array_unshift($this -> table['listFields'],'tagRefId');
        return view('pages.table', $this -> table);
    }
    public function subcategories(Request $request){
        return $this -> index("subcategories",$request);
    }


    public function brandView(Request $request){
        $this -> table['admin'] = $request -> admin;
        $this -> table['pageName'] = 'brands';
        $this -> table['url'] = url('brands');
        $this -> table['breadcrumbs'] = [
            ['name' => "Brands"]
        ];
        $this -> table['fieldDetails']['tagRefId'] = [
            'type'     => 'select',
            'name'     => 'tagRefId',
            'label'    => 'Category',
            'required' => true,
            'feedback' => "Category is required.",
            'relation' => 'tags'
        ];
        $this -> table['fieldDetails']['tagTypeId'] = [
            'type'     => 'hidden',
            'name'     => 'tagTypeId',
            'value'    => '3'
        ];
        $this -> table['fieldDetails']['tag'] = [
            'type'     => 'text',
            'name'     => 'tag',
            'label'    => 'Brand name',
            'required' => true,
            'feedback' => "Please enter a valid name"
        ];
        $this -> table['extraFilter'] = [
            [
                'field' => 'tagRefId',
                'Lable' => 'Category',
                'all' => true
            ]
        ];
        array_unshift($this -> table['listFields'],'tagRefId');
        return view('pages.table', $this -> table);
    }
    public function brands(Request $request){
        return $this -> index("brands",$request);
    }

    
    /*
    |---------------------------------------------------------------------------
    | Actions
    |---------------------------------------------------------------------------
    */

    public function index($name = false,$request){

        $response = ['success' => true];
        
        $valueField = "categories";
        if($name){
            $valueField = "subcategories";
            $tagTypeId = 2;
            if($name == "brands"){
                $valueField = "brands";
                $tagTypeId = 3;
            }
            $response['relations'] = ['tags' => Tag :: where('visibility',1)
                -> orderBy('displayOrder')
                -> where('tagTypeId',1)
                -> get(['id','tag AS value'])
            ];
            $response[$valueField] = Tag :: where('visibility',1)
                -> orderBy('displayOrder')
                -> where('tagTypeId',$tagTypeId)
                -> get([
                    'id','tagRefId','tagTypeId',
                    'tag','icon','displayOrder',
                    'visibility','slug'
                ]);
        }
        else
            $response['categories'] = Tag :: where('visibility',1)
                -> orderBy('displayOrder')
                -> where('tagTypeId',1)
                -> get([
                    'id','tagRefId','tagTypeId',
                    'tag','icon','displayOrder',
                    'visibility','slug'
                ]);


        return $response;
    }

    public function add(Request $request){
        $data = [];

        $data['tagRefId'] = (int)$request -> input('tagRefId');
        $data['tagTypeId'] = (int)$request -> input('tagTypeId');
        if(empty($data['tagRefId']) || $data['tagRefId'] === 0 || empty($data['tagTypeId'])){
            $data['tagRefId'] = 0;
            $data['tagTypeId'] = 1;
        }

        $data['displayOrder'] = (int)$request -> input('displayOrder');
        if(empty($data['displayOrder'])) $data['displayOrder'] = 1;
        $data['visibility'] = 1;

        $result = ['success' => false];
        $data['tag'] = $request -> input('tag');
        $data['icon'] = $request -> input('icon');

        if(empty($data['tag']) || empty($data['icon']))
            $result['text'] = "All fields are required";
        else{
            $data['slug'] = strtolower(str_replace(' ','-',$data['tag']));
            Tag :: insert($data);
            $result = ["success" => true, "text" => "Data added successfully"];
        }

        return $result;
    }

    public function update(Request $request){
        $data = [];
        $result = ['success' => true];

        $data['tagRefId'] = (int)$request -> input('tagRefId');
        $data['tagTypeId'] = (int)$request -> input('tagTypeId');
        $data['tag'] = $request -> input('tag');
        $data['icon'] = $request -> input('icon');
        $id = (int)$request -> input('id');
        if((empty($data['tagRefId']) && $data['tagRefId'] !== 0) || empty($data['tagTypeId']) || empty($data['tag']) || empty($data['icon']) || empty($id)){
            $result = ['success' => false, 'text' => 'All fields are required.'];
            if(empty($id))
                $result['text'] = 'Invalid tag.';
        }
        $data['displayOrder'] = (int)$request -> input('displayOrder');
        if(empty($data['displayOrder'])) $data['displayOrder'] = 1;
        $data['visibility'] = 1;

        if($result['success']){
            $data['slug'] = strtolower(str_replace(' ','-',$data['tag']));
            $result['success'] = Tag :: where('id',$id) -> update($data);
            if(!$result['success'])
                $result['text'] = "Invalid Tag.";
            else
                $result['text'] = "Data updated successfully.";
        }
        return $result;
    }

    public function delete($id, Request $request){
        $response = [
            "success" => Tag :: where('id',$id) -> delete() === 1,
            "text"    => "Record not found!"
        ];
        if($response['success']){
            Tag :: where('tagRefId',$id) -> delete();
            // delete sections and sliders and unlink resources
            $response['text'] = "Data deleted successfully.";
        }

        return $response;
    }

    public function get($category = 'categories', $slug = null){
        $tags = Tag :: where('tags.visibility', 1);
        $tags -> leftJoin('tags AS t','t.id','=','tags.tagRefId');

        $tagTypeId = 1;
        if($category == "subcategories") $tagTypeId = 2;
        else if($category == "brands") $tagTypeId = 3;

        $tags -> where('t.slug', $slug) -> where('tags.tagTypeId',$tagTypeId) -> orderBy('tags.displayOrder','asc');

        return ['success' => true, $category => $tags -> get(['tags.id','tags.tagTypeId','tags.tag','tags.icon','tags.slug'])];
    }

}
