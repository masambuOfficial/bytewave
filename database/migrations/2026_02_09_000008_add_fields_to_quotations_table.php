<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('quotations')) {
            return;
        }

        Schema::table('quotations', function (Blueprint $table) {
            if (!Schema::hasColumn('quotations', 'currency')) {
                $table->string('currency', 3)->default('UGX')->after('status');
            }

            if (!Schema::hasColumn('quotations', 'subject')) {
                $table->string('subject')->nullable()->after('currency');
            }

            if (!Schema::hasColumn('quotations', 'attn_name')) {
                $table->string('attn_name')->nullable()->after('subject');
            }

            if (!Schema::hasColumn('quotations', 'subtotal')) {
                $table->decimal('subtotal', 15, 2)->default(0)->after('notes');
            }

            if (!Schema::hasColumn('quotations', 'tax_total')) {
                $table->decimal('tax_total', 15, 2)->default(0)->after('subtotal');
            }

            if (!Schema::hasColumn('quotations', 'prepared_by_user_id')) {
                $table->unsignedBigInteger('prepared_by_user_id')->nullable()->after('total_amount');
            }

            if (!Schema::hasColumn('quotations', 'accepted_at')) {
                $table->timestamp('accepted_at')->nullable()->after('prepared_by_user_id');
            }

            if (!Schema::hasColumn('quotations', 'accepted_by_user_id')) {
                $table->unsignedBigInteger('accepted_by_user_id')->nullable()->after('accepted_at');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('quotations')) {
            return;
        }

        Schema::table('quotations', function (Blueprint $table) {
            $columns = [
                'currency',
                'subject',
                'attn_name',
                'subtotal',
                'tax_total',
                'prepared_by_user_id',
                'accepted_at',
                'accepted_by_user_id',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('quotations', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
