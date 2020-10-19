<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmenitieTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amenitie_translations', function (Blueprint $table) {
            $table->increments('amenities_trans_id');
            $table->string('locale', 191)->index();
            $table->text('name');

            $table->unsignedInteger('amenities_id');
            $table->foreign('amenities_id')->references('id')->on('amenities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amenitie_translations');
    }
}
