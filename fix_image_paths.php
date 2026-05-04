<?php
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Find all international islands with images
$islands = \App\Models\IslandDestination::where('type', 'international')
    ->whereNotNull('image')
    ->get();

echo "Found " . count($islands) . " international islands with images\n\n";

foreach ($islands as $island) {
    $oldImage = $island->image;
    
    // If image doesn't start with international/, add it
    if (!str_starts_with($oldImage, 'international/')) {
        // Extract just the filename if it's a full path
        $filename = basename($oldImage);
        $newImage = 'international/' . $filename;
        
        $island->update(['image' => $newImage]);
        echo "Updated: {$island->slug}\n";
        echo "  Old: {$oldImage}\n";
        echo "  New: {$newImage}\n\n";
    }
}

echo "Done!\n";
?>
