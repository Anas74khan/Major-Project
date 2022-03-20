<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviews = [
            [
                'userId' => 1,
                'productId' => 1,
                'rating' => 4,
                'description' => 'Nice product, upto the mark. I think you all should try.'
            ]
        ];
        foreach($reviews as $review) Review :: create($review);
    }
}
