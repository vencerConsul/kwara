<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->uuid('seller_id');
            $table->uuid('product_id');
            $table->text('order_number');
            $table->string('product_name');
            $table->string('product_price');
            $table->text('product_image');
            $table->integer('product_quantity');
            $table->integer('total_price');
            $table->string('product_size')->nullable();
            $table->string('product_color')->nullable();
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('order_products');
    }
}
