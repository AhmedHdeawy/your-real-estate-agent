<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFurnishingTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('furnishing_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('locale', 191)->index();
            $table->text('name');

            $table->unsignedInteger('furnishing_id');
            $table->foreign('furnishing_id')->references('id')->on('furnishings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('furnishing_translations');
    }
}
