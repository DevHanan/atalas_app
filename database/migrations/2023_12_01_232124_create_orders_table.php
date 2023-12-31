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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_date')->nullable();
            $table->string('delivery_date')->nullable();
            $table->integer('client_id');
            $table->integer('sale_id')->nullable();
            $table->double('total');
            $table->double('paid')->default(0);
            $table->double('remainig_payment')->default(0);
            $table->text('status_reason')->nullable();
            $table->integer('status')->default('1')->comment('1 New, 2 STATUS_SHIPMENT , 3 STATUS_DELIVERED ,4 STATUS_POSTPONE ,5 Failed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
