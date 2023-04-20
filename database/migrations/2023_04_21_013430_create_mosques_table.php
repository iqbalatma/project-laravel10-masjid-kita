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
        Schema::create('mosques', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("latitude");
            $table->string("longitude");
            $table->string("area_wide")->nullable();
            $table->decimal("balance", 14, 2)->default(0);
            $table->decimal("claim", 14, 2)->default(0);
            $table->decimal("debt", 14, 2)->default(0);
            $table->unsignedBigInteger("village_id");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mosques');
    }
};
