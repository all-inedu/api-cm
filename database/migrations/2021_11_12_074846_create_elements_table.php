<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->id();
            //! TODO - add foreign key to 'roles'
            $table->unsignedBigInteger('part_id');
            $table->foreign('part_id')->references('id')->on('parts')->onUpdate('cascade')->onDelete('cascade');

            $table->string('category_element');
            $table->text('description')->nullable();
            $table->text('video_link')->nullable();
            $table->text('image_path')->nullable();
            $table->text('file_path')->nullable();
            $table->text('question')->nullable();
            $table->integer('total_point');
            $table->tinyInteger('order');
            $table->integer('group');
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
        Schema::dropIfExists('elements');
    }
}
