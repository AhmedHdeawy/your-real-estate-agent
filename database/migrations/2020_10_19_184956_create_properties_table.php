<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('price', 10, 3)->nullable();
            $table->decimal('lat', 10, 6)->nullable();
            $table->decimal('long', 10, 6)->nullable();
            $table->text('address')->nullable();
            $table->enum('status', [0, 1])->default(1)->comment('0 => Stopped, 1 => Active');
            $table->string('agent_phone')->nullable();
            $table->string('agent_email')->nullable();
            $table->string('agent_name')->nullable();

            $table->tinyInteger('no_of_rooms')->default(0);
            $table->tinyInteger('no_of_maidrooms')->default(0);
            $table->tinyInteger('no_of_bathrooms')->default(0);
            $table->string('height')->nullable();
            $table->string('width')->nullable();

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unsignedInteger('type_id');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');

            $table->unsignedInteger('period_id');
            $table->foreign('period_id')->references('id')->on('periods')->onDelete('cascade');

            $table->unsignedInteger('furnishing_id')->nullable();
            $table->foreign('furnishing_id')->references('id')->on('furnishings')->onDelete('cascade');

            $table->unsignedInteger('completing_id');
            $table->foreign('completing_id')->references('id')->on('completings')->onDelete('cascade');

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
        Schema::dropIfExists('properties');
    }
}
