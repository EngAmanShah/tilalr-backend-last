<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Get all offers with full URLs and extract just the path
        DB::table('offers')
            ->whereRaw("image LIKE 'https://%'")
            ->get()
            ->each(function ($offer) {
                if ($offer->image && preg_match('/^https?:\/\//', $offer->image)) {
                    // Extract path from URL
                    $parsed = parse_url($offer->image);
                    $path = ltrim($parsed['path'] ?? $offer->image, '/');
                    
                    // Remove 'storage/' prefix if present
                    if (str_starts_with($path, 'storage/')) {
                        $path = substr($path, 8);
                    }
                    
                    DB::table('offers')
                        ->where('id', $offer->id)
                        ->update(['image' => $path]);
                }
            });
    }

    public function down(): void
    {
        // Cannot safely rollback this migration
    }
};
