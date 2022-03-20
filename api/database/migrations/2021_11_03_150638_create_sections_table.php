<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->integer('tagId');
            $table->string('name');
            $table->enum('type', ['special', 'normal', 'static','banner']);
            $table->string('specialImage') -> nullable();
            $table->string('mark') -> nullable();
            $table->tinyInteger('displayOrder');
            $table->tinyInteger('visibility');
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
        Schema::dropIfExists('sections');
    }
}
