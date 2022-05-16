<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Tag;

class SliderController extends Controller
{
    
    protected $table = [
        'tableName' => 'sliders',
        'imageFolder' => 'banners/',
        'fieldDetails' => [
            'tagId' => [
                'type'     => 'hidden',
                'name'     => 'tagId',
                'value'    => '0'
            ],
            'image' => [
                'type'     => 'image',
                'name'     => 'image',
                'label'    => 'Slider image',
                'required' => true,
                'feedback' => "This image is required.",
                'path' => 'images/banners/'
            ]
        ],
    ];

    public function viewIndex(Request $request){
        $this -> table['actions'] = ['add' => true, 'edit' => true, 'delete' => true];
        $this -> table['listFields'] = ['image'];
        $this -> table['addFields']  = ['tagId','image'];
        $this -> table['editFields'] = ['tagId','image'];
        $this -> table['admin'] = $request -> admin;
        $this -> table['pageName'] = 'sliders';
        $this -> table['url'] = url('sliders');
        $this -> table['breadcrumbs'] = [
            ['name' => "Sliders"]
        ];
        
        return view('pages.table', $this -> table);
    }


    
    /*
    |---------------------------------------------------------------------------
    | Actions
    |---------------------------------------------------------------------------
    */

    public function index(){
        $sliders = Slider :: leftJoin('tags', 'tags.id', '=', 'sliders.tagId')
                -> where('sliders.visibility',1)
                -> orderBy('tags.displayOrder','asc')
                -> orderBy('sliders.displayOrder','asc')
                ->get(['sliders.id','sliders.tagId','sliders.image','sliders.displayOrder','sliders.visibility']);

        return [
            'success' => true,
            'sliders' => $sliders,
            'relations' => [
                'tags' => Tag :: where('tagTypeId',1) -> where('visibility',1) -> orderBy('displayOrder','asc') -> get(['id','tag'])
            ]
        ];
    }

    public function add(Request $request){
        $image = $request->file('image');
        $tagId = (int)$request -> input('tagId');
        if(empty($tagId)) $tagId = $this -> table['fieldDetails']['tagId']['value'];

        $slider = ['image' => time().'.'.$image->getClientOriginalExtension(),'tagId' => $tagId];
        $image->move(public_path($this -> table['fieldDetails']['image']['path']), $slider['image']);
        Slider :: insert($slider);
        return ["success" => true, "text" => "Data added successfully"];
    }

    public function update(Request $request){
        $id = $request -> input('id');
        $result = ['success' => false];
        $slider = Slider :: where('id', $id) -> first();
        if(empty($slider['id']))
            $result['text'] = 'Invalid action: Slider does not exist.';
        else{

            $image_path = $this -> table['fieldDetails']['image']['path'].'/'.$slider['image'];
            if(File::exists($image_path))
                File::delete($image_path);

            $image = $request->file('image');
            $slider = ['image' => time().'.'.$image->getClientOriginalExtension()];
            $image->move(public_path($this -> table['fieldDetails']['image']['path']), $slider['image']);
            Slider :: where('id', $id) -> update($slider);

            $result = ['success' => true, 'text' => 'Data updated successfully.'];
        }
        return $result;
    }

    public function delete($id, Request $request){
        $result = ['success' => false];
        $slider = Slider :: where('id', $id) -> first();
        if(empty($slider['id']))
            $result['text'] = 'Invalid action: Slider does not exist.';
        else{
            $image_path = $this -> table['fieldDetails']['image']['path'].'/'.$slider['image'];
            if(File::exists($image_path))
                File::delete($image_path);
            Slider :: where('id',$id) -> delete();

            $result = ['success' => true, 'text' => 'Record deleted successfully.'];
        }
        return ['success' => true, "text" => "Data deleted successfully", "id" => $id];
    }

    public function get($slug = null){
        $sliders = Slider :: leftJoin('tags','tags.id','=','sliders.tagId')
                    -> where('tags.slug',$slug)
                    -> where('sliders.visibility',1)
                    -> orderBy('sliders.displayOrder','asc')
                    -> get(['sliders.image']);
        for($i = 0; $i < count($sliders); $i++)
            $sliders[$i] = [
                'src' => asset($this -> table['fieldDetails']['image']['path'].$sliders[$i]['image']),
                'altText' => '',
                'caption' => '',
                'header' => ''
            ];
        return ['success' => true, 'sliders' => $sliders];
    }

}
