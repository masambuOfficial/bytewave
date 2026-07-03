<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('work_orders')) {
            return;
        }

        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();

            $table->string('work_order_number')->unique();

            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('quotation_id')->nullable();

            $table->string('title')->nullable();

            $table->string('status', 20)->default('pending');

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->text('notes')->nullable();

            $table->unsignedBigInteger('created_by_user_id')->nullable();

            $table->timestamps();

            $table->index('client_id');
            $table->index('quotation_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
