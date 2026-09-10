<?php

namespace App\Console\Commands;

use App\Models\TourismDestination;
use Illuminate\Console\Command;

class NormalizeTourismDestinations extends Command
{
    protected $signature = 'tourism:normalize-destinations';
    protected $description = 'Normalize stored JSON fields for tourism destinations.';

    public function handle(): int
    {
        $this->info('Scanning tourism_destinations...');

        $rows = TourismDestination::all();
        $updated = 0;

        foreach ($rows as $destination) {
            $normalized = false;

            foreach (['basic_info', 'contact_info', 'payment_methods'] as $field) {
                $value = $destination->getAttributes()[$field] ?? null;

                if (is_string($value)) {
                    $decoded = json_decode($value, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $destination->{$field} = $decoded;
                        $normalized = true;
                    }
                }
            }

            if ($normalized) {
                $destination->save();
                $updated++;
            }
        }

        $this->info(sprintf('Normalized %d destination(s).', $updated));

        return 0;
    }
}
