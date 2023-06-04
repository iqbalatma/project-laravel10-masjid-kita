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
        $statusTransactions = \App\Enums\StatusTransactionEnum::cases();
        $statusTransactions = collect($statusTransactions)->map(function ($item) {
            return $item->value;
        })->toArray();
        Schema::create('transactions', function (Blueprint $table) use($statusTransactions){
            $table->id();
            $table->text("description")->default("-");
            $table->decimal("amount", 14, 2)->default(0);
            $table->unsignedBigInteger("transaction_type_id");
            $table->enum("method", ["income", "expense"]);
            $table->unsignedBigInteger("mosque_id");
            $table->unsignedBigInteger("user_id");
            $table->enum("status", $statusTransactions)->default("pending");
            $table->unsignedBigInteger("status_changed_by")->nullable();
            $table->timestamp("status_change_at")->useCurrent();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
