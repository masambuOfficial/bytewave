<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    // Work Done is no longer editable; carry it into Our Solution where that is still empty.
    public function up(): void
    {
        DB::table('portfolios')
            ->whereNotNull('work_done')
            ->where('work_done', '!=', '')
            ->where(fn ($q) => $q->whereNull('solution')->orWhere('solution', ''))
            ->update(['solution' => DB::raw('work_done'), 'work_done' => null]);
    }

    public function down(): void
    {
        // Not reversible: the original split between the two fields is not recorded.
    }
};
