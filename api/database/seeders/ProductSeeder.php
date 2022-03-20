<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'categories' => '2',
                'subCategories' => '12',
                'brand' => 13,
                'name' => 'Addidas - Foldsack No. 1 Backpack',
                'description' => 'Your perfect pack for everyday use and walks in the forest. Stash your laptop (up to 15 inches) in the padded sleeve, your everyday'
            ],
            [
                'categories' => '2',
                'subCategories' => '12',
                'brand' => 13,
                'name' => 'Mens Casual Premium Slim Fit T-Shirts',
                'description' => 'Slim-fitting style, contrast raglan long sleeve, three-button henley placket, light weight & soft fabric for breathable and comfortable wearing. And Solid stitched shirts with round neck made for durability and a great fit for casual fashion wear and diehard baseball fans. The Henley style round neckline includes a three-button placket.',
                'similar' => '1,2'
            ],
            [
                'categories' => '2',
                'subCategories' => '12',
                'brand' => 13,
                'name' => 'Mens Cotton Jacket',
                'description' => 'great outerwear jackets for Spring/Autumn/Winter, suitable for many occasions, such as working, hiking, camping, mountain/rock climbing, cycling, traveling or other outdoors. Good gift choice for you or your family member. A warm hearted love to Father, husband or son in this thanksgiving or Christmas Day.',
                'similar' => '1,2'
            ],
            [
                'categories' => '2',
                'subCategories' => '12',
                'brand' => 13,
                'name' => 'Mens Casual Slim Fit',
                'description' => 'The color could be slightly different between on the screen and in practice. / Please note that body builds vary by person, therefore, detailed size information should be reviewed below on the product description.',
                'similar' => '1,2'
            ],
            [
                'categories' => '2',
                'subCategories' => '12',
                'brand' => 13,
                'name' => 'John Hardy Women\'s Legends Naga Gold & Silver Dragon Station Chain Bracelet',
                'description' => 'From our Legends Collection, the Naga was inspired by the mythical water dragon that protects the ocean\'s pearl. Wear facing inward to be bestowed with love and abundance, or outward for protection.',
                'similar' => '1,2'
            ],
            [
                'categories' => '2',
                'subCategories' => '12',
                'brand' => 13,
                'name' => 'Solid Gold Petite Micropave',
                'description' => 'Satisfaction Guaranteed. Return or exchange any order within 30 days.Designed and sold by Hafeez Center in the United States. Satisfaction Guaranteed. Return or exchange any order within 30 days.',
                'similar' => '1,2'
            ],
            [
                'categories' => '2',
                'subCategories' => '12',
                'brand' => 13,
                'name' => 'White Gold Plated Princess',
                'description' => 'Classic Created Wedding Engagement Solitaire Diamond Promise Ring for Her. Gifts to spoil your love more for Engagement, Wedding, Anniversary, Valentine\'s Day...',
                'similar' => '1,2'
            ],
            [
                'categories' => '2',
                'subCategories' => '12',
                'brand' => 13,
                'name' => 'Pierced Owl Rose Gold Plated Stainless Steel Double',
                'description' => 'Rose Gold Plated Double Flared Tunnel Plug Earrings. Made of 316L Stainless Steel',
                'similar' => '1,2'
            ],
            [
                'categories' => '2',
                'subCategories' => '12',
                'brand' => 13,
                'name' => 'WD 2TB Elements Portable External Hard Drive - USB 3.0',
                'description' => 'USB 3.0 and USB 2.0 Compatibility Fast data transfers Improve PC Performance High Capacity; Compatibility Formatted NTFS for Windows 10, Windows 8.1, Windows 7; Reformatting may be required for other operating systems; Compatibility may vary depending on user’s hardware configuration and operating system',
                'similar' => '1,2'
            ]
        ];
        foreach($products as $product) Product :: create($product);
    }
}
