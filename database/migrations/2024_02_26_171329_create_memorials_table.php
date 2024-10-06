<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('memorials', function (Blueprint $table) {


                $table->increments('memorial_id');
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users');
                $table->string('message')->nullable();;
                $table->string('deceasedname');
                $table->datetime('date_time')->nullable();

                $table->string('location')->nullable();
                $table->string('password')->nullable();
                $table->text('link')->nullable();


        });

        Schema::create('memorial_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('memorial_id')->unsigned();
            $table->foreign('memorial_id')->references('memorial_id')->on('memorials');
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memorials');
    }
};
