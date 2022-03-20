<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [
                'tagRefId' => 0,
                'tagTypeId' => 1,
                'tag' => 'Mobiles',
                'icon' => 'fas fa-mobile-alt',
                'displayOrder' => 1,
                'visibility' => 1,
                'slug' => 'mobiles'
            ],
            [
                'tagRefId' => 0,
                'tagTypeId' => 1,
                'tag' => 'Fashion',
                'icon' => 'fas fa-tshirt',
                'displayOrder' => 2,
                'visibility' => 1,
                'slug' => 'fashion'
            ],
            [
                'tagRefId' => 0,
                'tagTypeId' => 1,
                'tag' => 'Electronics',
                'icon' => 'fas fa-plug',
                'displayOrder' => 3,
                'visibility' => 1,
                'slug' => 'electronics'
            ],
            [
                'tagRefId' => 0,
                'tagTypeId' => 1,
                'tag' => 'Home',
                'icon' => 'fas fa-utensils',
                'displayOrder' => 4,
                'visibility' => 1,
                'slug' => 'home'
            ],
            [
                'tagRefId' => 0,
                'tagTypeId' => 1,
                'tag' => 'Appliances',
                'icon' => 'fas fa-tv',
                'displayOrder' => 5,
                'visibility' => 1,
                'slug' => 'appliances'
            ],
            [
                'tagRefId' => 0,
                'tagTypeId' => 1,
                'tag' => 'Beauty',
                'icon' => 'fas fa-air-freshener',
                'displayOrder' => 6,
                'visibility' => 1,
                'slug' => 'beauty'
            ],
            [
                'tagRefId' => 0,
                'tagTypeId' => 1,
                'tag' => 'Toys & Baby',
                'icon' => 'fas fa-baby-carriage',
                'displayOrder' => 7,
                'visibility' => 1,
                'slug' => 'toys_&_baby'
            ],
            [
                'tagRefId' => 0,
                'tagTypeId' => 1,
                'tag' => 'Furniture',
                'icon' => 'fas fa-chair',
                'displayOrder' => 1,
                'visibility' => 1,
                'slug' => 'furniture'
            ],
            [
                'tagRefId' => 0,
                'tagTypeId' => 1,
                'tag' => 'Sports',
                'icon' => 'fas fa-basketball-ball',
                'displayOrder' => 9,
                'visibility' => 1,
                'slug' => 'sports'
            ],
            [
                'tagRefId' => 0,
                'tagTypeId' => 1,
                'tag' => 'Stationary',
                'icon' => 'fas fa-pencil-ruler',
                'displayOrder' => 10,
                'visibility' => 1,
                'slug' => 'stationary'
            ],
            [
                'tagRefId' => 0,
                'tagTypeId' => 1,
                'tag' => 'Medical',
                'icon' => 'fas fa-briefcase-medical',
                'displayOrder' => 11,
                'visibility' => 1,
                'slug' => 'medical'
            ],
            [
                'tagRefId' => 2,
                'tagTypeId' => 2,
                'tag' => 'Men\'s Clothing',
                'icon' => 'fas fa-male',
                'displayOrder' => 1,
                'visibility' => 1,
                'slug' => 'mens_clothing'
            ],
            [
                'tagRefId' => 2,
                'tagTypeId' => 3,
                'tag' => 'Addidas',
                'icon' => 'fas fa-addidas',
                'displayOrder' => 1,
                'visibility' => 1,
                'slug' => 'addidas'
            ]
        ];
        foreach($tags as $tag) Tag :: create($tag);
    }
}
