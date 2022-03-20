<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = [
            [
                'tagId' => 0,
                'name' => 'Flash Sale',
                'type' => 'special',
                'specialImage' => 'specialImage.png',
                'displayOrder' => 1,
                'visibility' => 1
            ],
            [
                'tagId' => 0,
                'name' => 'Sponsored',
                'type' => 'banner',
                'specialImage' => 'banner5.png',
                'displayOrder' => 2,
                'visibility' => 1
            ],
            [
                'tagId' => 0,
                'name' => 'Popular Product',
                'type' => 'normal',
                'displayOrder' => 3,
                'visibility' => 1
            ],
            [
                'tagId' => 0,
                'name' => 'Sponsored',
                'type' => 'banner',
                'specialImage' => 'banner6.png',
                'displayOrder' => 4,
                'visibility' => 1
            ],
            [
                'tagId' => 0,
                'name' => 'Recommended For You',
                'type' => 'static',
                'displayOrder' => 5,
                'visibility' => 1
            ]
        ];
        foreach($sections as $section) Section :: create($section);
    }
}
