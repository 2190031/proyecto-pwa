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
        Schema::create('bill', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('order_id')->nullable()->index('bill_ibfk_1');
            $table->dateTime('bill_date');
            $table->string('status', 20)->default('Issued');
            $table->integer('customer_id')->index('bill_ibfk_3_idx');
            $table->integer('payment_method_id')->nullable()->index('bill_ibfk_2');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill');
    }
};
