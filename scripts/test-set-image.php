<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$h = App\Models\InternationalHotel::find(1);
$raw = $h->image;
$clean = $raw ? preg_replace('#^/+|^storage/#', '', $raw) : null;
$h->image = asset('storage/' . $clean);
print_r([
    'getAttribute_raw' => $h->getAttributes()['image'],
    'model_property' => $h->image,
    'toArray_image' => $h->toArray()['image'],
    'asset_storage' => asset('storage/' . $clean),
    'asset_plain' => asset($raw),
]);
