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
            $table->increments('furnishings_trans_id');
            $table->string('locale', 191)->index();
            $table->text('name');

            $table->unsignedInteger('furnishings_id');
            $table->foreign('furnishings_id')->references('id')->on('furnishings')->onDelete('cascade');
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
