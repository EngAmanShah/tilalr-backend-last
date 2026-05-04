<?php
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$island = \App\Models\IslandDestination::where('type', 'local')->first(['id', 'slug', 'image', 'title_en']);
echo "Island ID: " . $island->id . "\n";
echo "Slug: " . $island->slug . "\n";
echo "Title: " . $island->title_en . "\n";
echo "Image (RAW): " . json_encode($island->image) . "\n";
echo "Image (String): " . $island->image . "\n";

// Check if file exists
$filename = 'public/storage/' . $island->image;
if (file_exists($filename)) {
    echo "✓ File exists: " . $filename . "\n";
} else {
    echo "✗ File NOT found: " . $filename . "\n";
}

// Try checking from storage
$storageFile = 'storage/app/public/' . str_replace('storage/', '', $island->image);
if (file_exists($storageFile)) {
    echo "✓ File exists in storage: " . $storageFile . "\n";
} else {
    echo "✗ File NOT in storage: " . $storageFile . "\n";
}
?>
