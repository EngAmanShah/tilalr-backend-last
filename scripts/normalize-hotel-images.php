<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\InternationalHotel;

$updated = 0;
foreach (InternationalHotel::all() as $hotel) {
    $img = $hotel->getAttributes()['image'] ?? null;
    if (!$img) continue;
    if (preg_match('#^https?://#', $img)) {
        $path = parse_url($img, PHP_URL_PATH) ?: $img;
        $path = ltrim($path, '/');
        $path = preg_replace('#^storage/#', '', $path);
        $hotel->image = $path; // will use model setter
        $hotel->save();
        $updated++;
        echo "Normalized hotel id={$hotel->id} -> {$path}\n";
    }
}

echo "Done. Updated: {$updated}\n";
