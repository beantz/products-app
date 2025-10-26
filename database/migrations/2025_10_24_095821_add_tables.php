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
        Schema::create('products', function(Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('description');
            $table->double('price');
            //ver como cria enum apartir da migration
            $table->enum('category', ['fruits_vegetables' ,'butcher_shop' ,'bakery' ,'drinks' ,'frozen_foods']);

            $table->timestamps();

        });

        /*um pra um*/
        Schema::create('products_details', function(Blueprint $table) {

            $table->id();
            $table->foreignId('product_id')->unique()->constrained()->onDelete('cascade');
            $table->string('ingredients');
            $table->date('date_manuf');
            $table->date('date_val');
            $table->timestamps();

        });

        /*um pra muitos*/
        Schema::create('products_review', function(Blueprint $table) {

            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('rating');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('products');
        Schema::dropIfExists('products_details');
        Schema::dropIfExists('products_review');

        Schema::enableForeignKeyConstraints();
 
    }
};
