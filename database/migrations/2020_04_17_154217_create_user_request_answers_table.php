<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRequestAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_request_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('answer');
            $table->unsignedBigInteger('group_requests_id');
            $table->timestamps();

            $table->foreign('group_requests_id')->references('id')->on('group_requests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_request_answers');
    }
}
