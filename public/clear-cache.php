<?php
// Temporary cache clearing script
if (function_exists('opcache_reset')) {
    opcache_reset();
    echo "✓ OPCache cleared successfully!\n";
    echo "Timestamp: " . date('Y-m-d H:i:s') . "\n";
} else {
    echo "✗ OPCache is not enabled or function not available\n";
}
?>
