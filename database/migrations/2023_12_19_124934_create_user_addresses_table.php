<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id()->from(100);
            $table->foreignUlid("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->string("name");
            $table->foreignId("area_id")->references("id")->on("areas")->onDelete("cascade");
            $table->text("desc");
            $table->boolean("is_default")->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
