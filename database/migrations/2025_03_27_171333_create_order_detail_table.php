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
        Schema::create('order_detail', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('order_id')->nullable()->index('order_id');
            $table->integer('product_id')->nullable()->index('product_id');
            $table->integer('quantity');
            $table->float('unit_price');
            $table->float('discount_amount')->nullable()->default(0);
            $table->float('subtotal_price');
            $table->float('total_price');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_detail');
    }
};
