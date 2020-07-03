<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('length');
            $table->string('type')->default('photo');
            $table->string('text')->nullable();
            $table->string('media')->nullable();
            $table->unsignedBigInteger('story_id');
            $table->timestamps();

            $table->foreign('story_id')->references('id')->on('stories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('story_items');
    }
}
