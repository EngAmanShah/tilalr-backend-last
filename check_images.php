<?php
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$islands = \App\Models\IslandDestination::where('type', 'local')
    ->orderByDesc('id')
    ->limit(5)
    ->get(['id', 'slug', 'image']);

foreach ($islands as $i) {
    echo $i->id . ' | ' . $i->slug . ' | ' . $i->image . PHP_EOL;
}
?>
