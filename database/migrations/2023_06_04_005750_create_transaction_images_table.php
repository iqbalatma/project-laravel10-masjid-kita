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
        Schema::create(\App\Enums\TableEnum::TRANSACTION_IMAGES->value, function (Blueprint $table) {
            $table->id();
            $table->string("image");
            $table->foreignId("user_id")->nullable();
            $table->foreignId("transaction_id");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(\App\Enums\TableEnum::TRANSACTION_IMAGES->value);
    }
};
