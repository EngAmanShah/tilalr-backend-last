<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$h = App\Models\InternationalHotel::find(1);
$raw = $h->image;
$clean = $raw ? preg_replace('#^/+|^storage/#', '', $raw) : null;
echo "raw=" . $raw . PHP_EOL;
echo "clean=" . $clean . PHP_EOL;
echo "asset_storage=" . asset('storage/' . $clean) . PHP_EOL;
echo "asset_plain=" . asset($raw) . PHP_EOL;
