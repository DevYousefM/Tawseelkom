<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id()->from(100);
            $table->foreignId('from_area_id')->references('id')->on('areas')->onDelete("cascade");
            $table->foreignId('to_area_id')->references('id')->on('areas')->onDelete("cascade");
            $table->foreignId('shipment_type_id')->references('id')->on('shipment_types')->onDelete("cascade");
            $table->integer("price")->nullable();
            $table->float("distance")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
