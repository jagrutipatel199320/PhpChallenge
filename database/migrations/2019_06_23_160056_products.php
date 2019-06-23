<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

         Schema::create('Categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

         Schema::create('Products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('SKU');
            $table->integer('price');
            $table->timestamps();
        });

          Schema::create('ProductCategory', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();
        });


        Schema::table('ProductCategory', function ($table) {
            $table->foreign('category_id')->references('id')->on('Categories')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('Products')->onDelete('cascade');
        });
       


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
