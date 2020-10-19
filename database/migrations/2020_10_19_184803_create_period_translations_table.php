<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('period_translations', function (Blueprint $table) {
            $table->increments('periods_trans_id');
            $table->string('locale', 191)->index();
            $table->text('name');

            $table->unsignedInteger('periods_id');
            $table->foreign('periods_id')->references('id')->on('periods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('period_translations');
    }
}
