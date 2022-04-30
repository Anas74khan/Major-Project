<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVarietiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('varieties', function (Blueprint $table) {
            $table->text('features')->nullable()->change();
            $table->boolean('inStock')->default(1)->change();
            $table->boolean('visibility')->default(1)->change();
            $table->text('tags')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
