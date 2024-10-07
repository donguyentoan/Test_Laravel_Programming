<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
        {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description');
                $table->string('image');
                $table->float('price');
                $table->bigInteger('categories_id')->unsigned();
                $table->bigInteger('manufacture_id')->unsigned();
                $table->timestamps();
    
                // $table->foreign('categories_id')->references('id')->on('categories');
                // $table->foreign('manufacture_id')->references('id')->on('manufactures');
            });
        }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
