<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('custom_payment_offers', function (Blueprint $table) {
            $table->string('token_number', 20)->unique()->nullable()->after('id');
            $table->index('token_number');
        });

        // Generate token numbers for existing records
        $offers = \App\Models\CustomPaymentOffer::whereNull('token_number')->get();
        foreach ($offers as $offer) {
            $offer->token_number = $this->generateToken();
            $offer->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_payment_offers', function (Blueprint $table) {
            $table->dropColumn('token_number');
        });
    }

    /**
     * Generate a unique token number like "CPO-2026-0001"
     */
    private function generateToken(): string
    {
        $year = date('Y');
        $lastOffer = \App\Models\CustomPaymentOffer::whereYear('created_at', $year)
            ->whereNotNull('token_number')
            ->orderBy('id', 'desc')
            ->first();

        if ($lastOffer && preg_match('/CPO-' . $year . '-(\d+)/', $lastOffer->token_number, $matches)) {
            $nextNumber = intval($matches[1]) + 1;
        } else {
            $nextNumber = 1;
        }

        return sprintf('CPO-%s-%04d', $year, $nextNumber);
    }
};
