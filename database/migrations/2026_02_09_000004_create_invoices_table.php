<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('invoices')) {
            return;
        }

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->string('invoice_number')->unique();

            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('quotation_id')->nullable();
            $table->unsignedBigInteger('work_order_id')->nullable();

            $table->date('date')->nullable();
            $table->date('due_date')->nullable();

            $table->string('status', 20)->default('draft');

            $table->string('currency', 3)->default('UGX');

            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('tax_rate', 8, 2)->default(0);
            $table->decimal('tax_amount', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2)->default(0);

            $table->text('notes')->nullable();
            $table->text('payment_details')->nullable();

            $table->timestamp('issued_at')->nullable();
            $table->unsignedBigInteger('issued_by_user_id')->nullable();

            $table->timestamps();

            $table->index('client_id');
            $table->index('quotation_id');
            $table->index('work_order_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
