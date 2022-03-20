<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVarietiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('varieties', function (Blueprint $table) {
            $table->id();
            $table->integer('productId');
            $table->string('name');
            $table->text('images');
            $table->text('features');
            $table->double('sellingPrice', 11, 2);
            $table->tinyInteger('offerPercentage');
            $table->tinyInteger('offerEnable');
            $table->double('offerPrice', 11, 2);
            $table->tinyInteger('visibility');
            $table->text('tags');
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
        Schema::dropIfExists('varieties');
    }
}
