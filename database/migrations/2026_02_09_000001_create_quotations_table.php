<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('quotations')) {
            return;
        }

        Schema::create('quotations', function (Blueprint $table) {
            $table->id();

            $table->string('quote_number')->unique();

            $table->unsignedBigInteger('client_id');

            $table->date('date');
            $table->date('valid_until')->nullable();

            $table->string('status', 20)->default('draft');

            $table->string('currency', 3)->default('UGX');

            $table->string('subject')->nullable();
            $table->string('attn_name')->nullable();

            $table->text('notes')->nullable();

            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('tax_total', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2)->default(0);

            $table->unsignedBigInteger('prepared_by_user_id')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->unsignedBigInteger('accepted_by_user_id')->nullable();

            $table->timestamps();

            $table->index('client_id');
            $table->index('status');
            $table->index('date');
            $table->index('prepared_by_user_id');
            $table->index('accepted_by_user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
