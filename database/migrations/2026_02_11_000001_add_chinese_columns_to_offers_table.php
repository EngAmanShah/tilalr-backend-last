<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * This migration is now a no-op.
     * All columns for offers table are added by 2026_02_10_000001_add_chinese_language_columns.php
     * This file exists only for backwards compatibility with the migration history.
     */
    public function up(): void
    {
        // All columns already exist - this is a no-op
    }

    public function down(): void
    {
        // No columns were added by this migration - this is a no-op
    }
};
