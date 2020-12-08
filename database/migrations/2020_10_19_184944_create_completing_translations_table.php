<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompletingTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('completing_translations', function (Blueprint $table) {
            $table->increments('completing_trans_id');
            $table->string('locale', 191)->index();
            $table->text('name');

            $table->unsignedInteger('completing_id');
            $table->foreign('completing_id')->references('id')->on('completings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('completing_translations');
    }
}
