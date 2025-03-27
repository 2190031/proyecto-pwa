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
        Schema::table('bill', function (Blueprint $table) {
            $table->foreign(['order_id'], 'bill_ibfk_1')->references(['id'])->on('order')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['payment_method_id'], 'bill_ibfk_2')->references(['id'])->on('pay_method')->onUpdate('no action')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bill', function (Blueprint $table) {
            $table->dropForeign('bill_ibfk_1');
            $table->dropForeign('bill_ibfk_2');
        });
    }
};
