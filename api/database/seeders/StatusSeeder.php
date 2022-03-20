<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            [
                'statusId' => 1,
                'status' => 'Order Placed'
            ],
            [
                'statusId' => 2,
                'status' => 'Order Cancelled'
            ],
            [
                'statusId' => 3,
                'status' => 'Order Accepted by Seller'
            ],
            [
                'statusId' => 4,
                'status' => 'Order Shipped'
            ],
            [
                'statusId' => 5,
                'status' => 'Out for Delivery'
            ],
            [
                'statusId' => 6,
                'status' => 'Order Delivered'
            ],
            [
                'statusId' => 7,
                'status' => 'Seller Rejected Product Request'
            ],
            [
                'statusId' => 8,
                'status' => 'Replacement Initiated'
            ],
            [
                'statusId' => 9,
                'status' => 'Replacement Done'
            ]
        ];
        foreach($status as $value) Status :: create($value);
    }
}
