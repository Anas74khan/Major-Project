<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SectionProduct;

class SectionProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionProducts = [
            [
                'sectionId' => 1,
                'ProductId' => 1,
                'displayOrder' => 1,
                'visibility' => 1
            ],
            [
                'sectionId' => 1,
                'ProductId' => 2,
                'displayOrder' => 2,
                'visibility' => 1
            ],
            [
                'sectionId' => 1,
                'ProductId' => 3,
                'displayOrder' => 3,
                'visibility' => 1
            ],
            [
                'sectionId' => 3,
                'ProductId' => 4,
                'displayOrder' => 1,
                'visibility' => 1
            ],
            [
                'sectionId' => 3,
                'ProductId' => 5,
                'displayOrder' => 2,
                'visibility' => 1
            ],
            [
                'sectionId' => 3,
                'ProductId' => 6,
                'displayOrder' => 3,
                'visibility' => 1
            ],
            [
                'sectionId' => 5,
                'ProductId' => 7,
                'displayOrder' => 1,
                'visibility' => 1
            ],
            [
                'sectionId' => 5,
                'ProductId' => 8,
                'displayOrder' => 2,
                'visibility' => 1
            ],
            [
                'sectionId' => 5,
                'ProductId' => 9,
                'displayOrder' => 3,
                'visibility' => 1
            ]
        ];
        foreach($sectionProducts as $sectionProduct) SectionProduct :: create($sectionProduct);
    }
}
