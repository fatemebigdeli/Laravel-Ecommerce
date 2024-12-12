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

            $table->foreignId('user_id')->constrained()->onDelete('cascade')->name('orders_user_id_foreign');
            $table->foreignId('address_id')->constrained('user_addresses')->onDelete('cascade')->name('orders_address_id_foreign');
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->onDelete('cascade')->name('orders_coupon_id_foreign');

            $table->tinyInteger('status')->default(0);
            $table->unsignedInteger('total_amount')->default(0);
            $table->unsignedInteger('delivery_amount')->default(0);
            $table->unsignedInteger('coupon_amount')->default(0);
            $table->unsignedInteger('paying_amount')->default(0);
            $table->enum('payment_type', ['pos', 'cash', 'shabaNumber', 'cardToCard', 'online']);
            $table->tinyInteger('payment_status')->default(0);
            $table->text('description')->nullable();

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
