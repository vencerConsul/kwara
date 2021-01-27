<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('store_name');
            $table->string('profile')->default('0');
            $table->string('email')->unique();
            $table->string('status')->default('not-approve');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('expiration_date');
            $table->rememberToken();
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
        Schema::dropIfExists('sellers');
    }
}
