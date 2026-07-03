<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('payments')) {
            return;
        }

        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('invoice_id');

            $table->decimal('amount', 15, 2);
            $table->string('currency', 3)->default('UGX');

            $table->date('paid_at');

            $table->string('method')->nullable();
            $table->string('reference')->nullable();
            $table->text('notes')->nullable();

            $table->unsignedBigInteger('received_by_user_id')->nullable();

            $table->timestamps();

            $table->index('invoice_id');
            $table->index('paid_at');
            $table->index('received_by_user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
