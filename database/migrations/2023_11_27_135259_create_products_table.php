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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('main_img')->nullable();
            $table->integer('company_id');
            $table->integer('category_id');
            $table->integer('section_id');
            $table->string('price');
            $table->string('discount');
            $table->string('supplier_price');
            $table->string('gomalla_price');
            $table->string('carton_price');
            $table->integer('quantity');
            $table->integer('max_order_quantity');
            $table->text('description');
            $table->boolean('status')->default('1');
            $table->boolean('best_seller')->default('0');
            $table->boolean('highest_rated')->default('0');
            $table->boolean('recommend')->default('0');
            $table->integer('sale_unit_id');
            $table->integer('purchase_unit_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
