<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipment_types', function (Blueprint $table) {
            $table->id()->from(100);
            $table->string("title")->unique();
            $table->string("desc");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipment_types');
    }
};
