<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SlidersTableSeedert extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sliders = [
            [
                'image' => 'banner1.png',
                'tagId' => 0,
                'displayOrder' => 1,
                'visibility' => 1
            ],
            [
                'image' => 'banner2.png',
                'tagId' => 0,
                'displayOrder' => 2,
                'visibility' => 1
            ],
            [
                'image' => 'banner3.png',
                'tagId' => 0,
                'displayOrder' => 3,
                'visibility' => 1
            ]
        ];
        foreach($sliders as $slider) Slider :: create($slider);
    }
}
