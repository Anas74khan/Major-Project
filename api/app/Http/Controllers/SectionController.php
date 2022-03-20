<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Tag;

class SectionController extends Controller
{

    protected $table = [
        'tableName' => 'sections',
        'imageFolder' => 'banners/',
        'fieldDetails' => [
            'tagId' => [
                'type'     => 'hidden',
                'name'     => 'tagId',
                'value'    => '0'
            ],
            'name' => [
                'type'     => 'text',
                'name'     => 'name',
                'label'    => 'Section name',
                'required' => true,
                'feedback' => "Please enter a valid name"
            ],
            'type' => [
                'type'     => 'select',
                'name'     => 'type',
                'label'    => 'Section type',
                'required' => true,
                'options'  => [
                    ['id' => 'special', 'value' => 'Special'],
                    ['id' => 'normal', 'value' => 'Normal'],
                    ['id' => 'static', 'value' => 'Static'],
                    ['id' => 'banner', 'value' => 'Banner'],
                ],
                'feedback' => "Please enter a valid name",
                'onchange' => [
                    [
                        'field' => 'type',
                        'visible' => ['special']
                    ],
                    [
                        'field' => 'specialImage',
                        'visible' => ['special','banner'],
                        'changeLable' => [
                            'special' => 'Background image',
                            'banner' => 'Banner image',
                        ],
                        'required' => ['special','banner'],
                        'feedback' => 'This image is required'
                    ]
                ]
            ],
            'specialImage' => [
                'type' => 'image',
                'name' => 'specialImage',
                'label' => 'Image',
                'path' => 'images/banners/'
            ],
            'mark' => [
                'type' => 'text',
                'name' => 'mark',
                'label' => 'Mark on products',
            ],
        ],
    ];

    public function view(Request $request){
        $this -> table['actions'] = ['add' => true, 'edit' => true, 'delete' => true];
        $this -> table['listFields'] = ['name','type','specialImage','mark'];
        $this -> table['addFields']  = ['tagId','name','type','specialImage','mark'];
        $this -> table['editFields'] = ['tagId','name','type','specialImage','mark'];
        $this -> table['admin'] = $request -> admin;
        $this -> table['pageName'] = 'sections';
        $this -> table['url'] = url('sections');
        $this -> table['breadcrumbs'] = [
            ['name' => "Sections"]
        ];

        return view('pages.table', $this -> table);
    }

    function index(){
        $sections =  Section :: leftJoin('tags', 'tags.id', '=', 'sections.tagId')
                -> where('sections.visibility',1)
                -> orderBy('tags.displayOrder','asc')
                -> orderBy('sections.displayOrder','asc')
                ->get(['sections.id','sections.tagId','sections.name','sections.type','sections.specialImage','sections.mark','sections.visibility','sections.displayOrder']);
        return [
            'success' => true,
            'sections' => $sections,
            'relations' => [
                'tags' => Tag :: orderBy('displayOrder','asc') -> get(['id','tag'])
            ]
        ];
    }
    
    public function delete($id, Request $request){
        Section :: where('id',$id) -> delete();
        return ['success' => true, "text" => "Data deleted successfully", "id" => $id];
    }

}
