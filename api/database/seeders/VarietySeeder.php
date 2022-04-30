<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Variety;

class VarietySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $varietys = [
            [
                'productId' => 1,
                'name' => 'Test',
                'images' => '["81fPKd-2AYL._AC_SL1500_.jpg"]',
                'features' => '',
                'sellingPrice' => 100.00,
                'offerPercentage' => 1,
                'offerEnable' => 1,
                'offerPrice' => 99.00,
                'inStock' => 1,
                'visibility' => 1,
                'tags' => 'Test'
            ],
            [
                'productId' => 2,
                'name' => 'Test',
                'images' => '["71-3HjGNDUL._AC_SY879._SX._UX._SY._UY_.jpg"]',
                'features' => '',
                'sellingPrice' => 100.00,
                'offerPercentage' => 1,
                'offerEnable' => 1,
                'offerPrice' => 99.00,
                'inStock' => 1,
                'visibility' => 1,
                'tags' => 'Test'
            ],
            [
                'productId' => 3,
                'name' => 'Test',
                'images' => '["71li-ujtlUL._AC_UX679_.jpg"]',
                'features' => '',
                'sellingPrice' => 100.00,
                'offerPercentage' => 1,
                'offerEnable' => 1,
                'offerPrice' => 99.00,
                'inStock' => 1,
                'visibility' => 1,
                'tags' => 'Test'
            ],
            [
                'productId' => 4,
                'name' => 'Test',
                'images' => '["71YXzeOuslL._AC_UY879_.jpg"]',
                'features' => '',
                'sellingPrice' => 100.00,
                'offerPercentage' => 1,
                'offerEnable' => 1,
                'offerPrice' => 99.00,
                'inStock' => 1,
                'visibility' => 1,
                'tags' => 'Test'
            ],
            [
                'productId' => 5,
                'name' => 'Test',
                'images' => '["71pWzhdJNwL._AC_UL640_QL65_ML3_.jpg"]',
                'features' => '',
                'sellingPrice' => 100.00,
                'offerPercentage' => 1,
                'offerEnable' => 1,
                'offerPrice' => 99.00,
                'inStock' => 1,
                'visibility' => 1,
                'tags' => 'Test'
            ],
            [
                'productId' => 6,
                'name' => 'Test',
                'images' => '["61sbMiUnoGL._AC_UL640_QL65_ML3_.jpg"]',
                'features' => '',
                'sellingPrice' => 100.00,
                'offerPercentage' => 1,
                'offerEnable' => 1,
                'offerPrice' => 99.00,
                'inStock' => 1,
                'visibility' => 1,
                'tags' => 'Test'
            ],
            [
                'productId' => 7,
                'name' => 'Test',
                'images' => '["71YAIFU48IL._AC_UL640_QL65_ML3_.jpg"]',
                'features' => '',
                'sellingPrice' => 100.00,
                'offerPercentage' => 1,
                'offerEnable' => 1,
                'offerPrice' => 99.00,
                'inStock' => 1,
                'visibility' => 1,
                'tags' => 'Test'
            ],
            [
                'productId' => 8,
                'name' => 'Test',
                'images' => '["51UDEzMJVpL._AC_UL640_QL65_ML3_.jpg"]',
                'features' => '',
                'sellingPrice' => 100.00,
                'offerPercentage' => 1,
                'offerEnable' => 1,
                'offerPrice' => 99.00,
                'inStock' => 1,
                'visibility' => 1,
                'tags' => 'Test'
            ],
            [
                'productId' => 9,
                'name' => 'Test',
                'images' => '["61IBBVJvSDL._AC_SY879_.jpg"]',
                'features' => '',
                'sellingPrice' => 100.00,
                'offerPercentage' => 1,
                'offerEnable' => 1,
                'offerPrice' => 99.00,
                'inStock' => 1,
                'visibility' => 1,
                'tags' => 'Test'
            ]
        ];
        foreach($varietys as $variety) Variety :: create($variety);
    }
}
