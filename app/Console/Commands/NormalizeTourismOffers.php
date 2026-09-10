<?php

namespace App\Console\Commands;

use App\Models\TourismOffer;
use Illuminate\Console\Command;

class NormalizeTourismOffers extends Command
{
    protected $signature = 'tourism:normalize-offers';
    protected $description = 'Normalize stored JSON fields for tourism offers.';

    public function handle(): int
    {
        $this->info('Scanning tourism_offers...');

        $rows = TourismOffer::all();
        $updated = 0;

        foreach ($rows as $offer) {
            $normalized = false;

            foreach (['basic_info', 'contact_info', 'payment_methods'] as $field) {
                $value = $offer->getAttributes()[$field] ?? null;

                if (is_string($value)) {
                    $decoded = json_decode($value, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $offer->{$field} = $decoded;
                        $normalized = true;
                    }
                }
            }

            if ($normalized) {
                $offer->save();
                $updated++;
            }
        }

        $this->info(sprintf('Normalized %d offer(s).', $updated));

        return 0;
    }
}
