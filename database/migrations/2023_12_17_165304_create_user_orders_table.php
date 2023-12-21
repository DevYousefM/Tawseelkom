<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_orders', function (Blueprint $table) {
            $table->id()->from(100);
            $table->foreignUlid("user_id")->references("id")->on("users")->onDelete("cascade");
            // Route data
            $table->string("from");
            $table->string("to");
            $table->string("shipment_type");
            $table->string("price");
            $table->float("distance");
            // Payment data
            $table->string("who_pay");
            $table->string("payment_status")->default("غير مدفوع");
            $table->string("payment_id")->nullable();
            // Order data
            $table->string("status")->default("قيد المراجعة");
            // Recipient data
            $table->string("recipient_name");
            $table->string("recipient_phone");
            // Sender data
            $table->string("sender_name");
            // Another data
            $table->text("details")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_orders');
    }
};
