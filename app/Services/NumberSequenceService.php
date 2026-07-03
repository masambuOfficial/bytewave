<?php

namespace App\Services;

use App\Models\NumberSequence;
use Illuminate\Support\Facades\DB;

class NumberSequenceService
{
    public function next(string $key, ?int $year = null): int
    {
        $year = $year ?? (int) date('Y');

        return DB::transaction(function () use ($key, $year) {
            $sequence = NumberSequence::lockForUpdate()->firstOrCreate(
                ['key' => $key, 'year' => $year],
                ['next_number' => 1]
            );

            $current = (int) $sequence->next_number;
            $sequence->next_number = $current + 1;
            $sequence->save();

            return $current;
        });
    }

    public function format(string $key, int $number, ?int $year = null): string
    {
        $year = $year ?? (int) date('Y');

        $seq = str_pad((string) $number, 3, '0', STR_PAD_LEFT);

        if ($key === 'invoice') {
            return 'INV-' . $seq . '/' . $year;
        }

        if ($key === 'work_order') {
            return 'WO-' . $seq . '/' . $year;
        }

        return $seq . '/' . $year;
    }
}
