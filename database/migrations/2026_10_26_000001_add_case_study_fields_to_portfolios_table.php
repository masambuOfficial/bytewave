<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            if (!Schema::hasColumn('portfolios', 'project_type')) {
                $table->string('project_type', 20)->default('ict');
            }
            if (!Schema::hasColumn('portfolios', 'challenge')) {
                $table->text('challenge')->nullable();
            }
            if (!Schema::hasColumn('portfolios', 'solution')) {
                $table->text('solution')->nullable();
            }
            if (!Schema::hasColumn('portfolios', 'results')) {
                $table->text('results')->nullable();
            }
            if (!Schema::hasColumn('portfolios', 'highlights')) {
                $table->json('highlights')->nullable();
            }
            if (!Schema::hasColumn('portfolios', 'process_steps')) {
                $table->json('process_steps')->nullable();
            }
            if (!Schema::hasColumn('portfolios', 'testimonial')) {
                $table->text('testimonial')->nullable();
            }
            if (!Schema::hasColumn('portfolios', 'testimonial_author')) {
                $table->string('testimonial_author')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $columns = ['project_type', 'challenge', 'solution', 'results', 'highlights', 'process_steps', 'testimonial', 'testimonial_author'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('portfolios', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
