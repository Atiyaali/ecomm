<?php

use App\Models\ShippingFee;
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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->string('order_status')->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('pending');
            $table->decimal('subtotal')->nullable();
            $table->decimal('shipping_fee')->nullable();
            $table->decimal('total')->nullable();
            $table->json('shipping_address')->nullable();
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
