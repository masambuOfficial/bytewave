<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * bytewave_icon.jpg moved from public/ to public/images/, so update any
     * author avatars that still point at the old location.
     */
    public function up(): void
    {
        DB::table('authors')
            ->where('avatar', '/bytewave_icon.jpg')
            ->update(['avatar' => '/images/bytewave_icon.jpg']);
    }

    public function down(): void
    {
        DB::table('authors')
            ->where('avatar', '/images/bytewave_icon.jpg')
            ->update(['avatar' => '/bytewave_icon.jpg']);
    }
};
