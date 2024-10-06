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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename');
            $table->string('address');
            $table->string('contactnumber');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role');
            $table->timestamps();
        });

        Schema::create('buildings', function (Blueprint $table) {
            $table->increments('building_id');
            $table->string('name');
            $table->string('image');
        });
        Schema::create('niches', function (Blueprint $table) {
            $table->increments('niche_id');
            $table->string('receipt_id')->nullable();
            $table->string('building_id');
            $table->integer('niche_number');
            $table->integer('capacity');
            $table->string('status');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('image');
            $table->string('paymentmethod')->nullable();
            $table->string('paymenttype')->nullable();
            $table->string('ref')->nullable();
            $table->string('level');
            $table->decimal('price');
            $table->decimal('downpayment')->nullable();
            $table->decimal('monthly')->nullable();
            $table->date('date')->nullable();
        });

        Schema::create('urns', function (Blueprint $table) {
            $table->increments('urn_id');
            $table->integer('niche_id')->unsigned()->nullable();
            $table->foreign('niche_id')->references('niche_id')->on('niches');
            $table->integer('urn_number');
            $table->string('urn_image')->nullable();
            $table->string('message')->nullable();
            $table->string('name')->nullable();
            $table->string('deceased_image')->nullable();
        });

        Schema::create('service_categories', function (Blueprint $table) {
            $table->increments('service_id');
            $table->string('name');
            $table->string('status');
            $table->string('image');
            $table->decimal('price')->nullable();
        });

        Schema::create('service_list', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('start');
            $table->datetime('end');
            $table->string('deceasedname')->nullable();
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('service_id')->on('service_categories');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('priest');
            $table->string('payment_mode');
            $table->string('ref')->nullable();
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('priests', function (Blueprint $table) {
            $table->increments('priest_id');
            $table->string('name');
            $table->string('contactnumber');
            $table->string('address');
            $table->string('status');
        });


        Schema::create('shop_categories', function (Blueprint $table) {
            $table->increments('category_id');
            $table->string('name');
            $table->string('status');
            $table->string('image');
        });

        Schema::create('shop_sellers', function (Blueprint $table) {
            $table->increments('seller_id');
            $table->string('name');
            $table->string('contactnumber');
            $table->string('address');
            $table->string('status');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')
                ->references('category_id')
                ->on('shop_categories')
                ->onDelete('cascade');
            $table->integer('seller_id')->unsigned();
            $table->foreign('seller_id')
                ->references('seller_id')
                ->on('shop_sellers')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('description');
            $table->integer('stock');
            $table->decimal('price');
            $table->string('status');
            $table->string('image');
        });


        Schema::create('product_orderline', function (Blueprint $table) {
            $table->increments('orderline_id');
            $table->string('receipt_number')->unique();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('status');
            $table->string('ref')->nullable();
            $table->timestamps();
        });

        Schema::create('product_orderinfo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orderline_id')->unsigned();
            $table->foreign('orderline_id')->references('orderline_id')->on('product_orderline');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->integer('qty');
        });




        // Schema::create('memorial_images', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('memorial_id')->unsigned();
        //     $table->foreign('memorial_id')->references('memorial_id')->on('memorials');
        //     $table->string('image');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('memorials');
        Schema::dropIfExists('product_orderinfo');
        Schema::dropIfExists('product_orderline');
        Schema::dropIfExists('products');
        Schema::dropIfExists('shop_sellers');
        Schema::dropIfExists('shop_categories');
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('service_list');
        Schema::dropIfExists('service_categories');
        Schema::dropIfExists('urns');
        Schema::dropIfExists('niches');
        Schema::dropIfExists('buildings');
        Schema::dropIfExists('users');
    }
};
