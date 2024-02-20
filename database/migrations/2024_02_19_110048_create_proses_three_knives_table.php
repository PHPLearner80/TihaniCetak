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
        Schema::create('proses_three_knives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_order_id')->nullable();
            $table->foreign('sale_order_id')->references('id')->on('sale_orders')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('machine')->nullable();
            $table->string('status')->nullable();

            $table->string('b_1')->nullable();
            $table->string('b_2')->nullable();
            $table->string('b_3')->nullable();
            $table->string('b_4')->nullable();
            $table->string('b_5')->nullable();
            $table->string('b_6')->nullable();
            $table->string('b_7')->nullable();
            $table->string('b_8')->nullable();
            $table->string('b_9')->nullable();
            $table->string('b_10')->nullable();
            $table->string('b_11')->nullable();
            $table->string('b_12')->nullable();
            $table->string('b_13')->nullable();

            $table->string('verified_by_date')->nullable();
            $table->string('verified_by_user')->nullable();
            $table->string('verified_by_designation')->nullable();
            $table->string('verified_by_department')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proses_three_knives');
    }
};
