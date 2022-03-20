<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->integer('productId');
            $table->integer('varietyId');
            $table->integer('quantity');
            $table->string('name');
            $table->string('mobileNo');
            $table->string('address1');
            $table->string('address2');
            $table->integer('pincode');
            $table->string('city');
            $table->string('state');
            $table->enum('type',['Office','Home']) -> default('Home');
            $table->tinyInteger('status') -> default(1);
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
