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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('province_id')->unsigned()->nullable();
            $table->integer('district_id')->unsigned()->nullable();
            $table->integer('sale_id')->unsigned()->nullable();
            $table->double('lat');
            $table->double('lng');
            $table->integer('status')->default('1')->comment('0 Inactive, 1 Active');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->text('api_token')->nullable();
            $table->text('activity_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
