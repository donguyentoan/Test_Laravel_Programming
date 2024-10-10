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
                $table->string('manufacturer')->nullable();
                $table->string('model')->nullable();
                $table->string('engine_capacity')->nullable();
                $table->double('price');
                $table->json('tags')->nullable(); // For storing tags like 'red', '5-door'
                $table->string('image');
                $table->boolean('is_active')->default(0); // Admin activation
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
        Schema::dropIfExists('products');
    }
}
