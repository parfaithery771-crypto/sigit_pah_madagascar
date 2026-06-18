<?php
header("Content-Type: text/plain");
echo "Testing connection to sql7.freesqldatabase.com:3306...\n";
$start = microtime(true);
$conn = @fsockopen("sql7.freesqldatabase.com", 3306, $errno, $errstr, 5);
$elapsed = round(microtime(true) - $start, 2);
if ($conn) {
    echo "CONNECTED in {$elapsed}s\n";
    fclose($conn);
} else {
    echo "FAILED in {$elapsed}s - errno=$errno errstr=$errstr\n";
}
$url = getenv("DATABASE_URL");
if ($url) {
    $parts = parse_url($url);
    echo "\nDATABASE_URL is SET. host=" . ($parts["host"] ?? "?") . " port=" . ($parts["port"] ?? "?") . " db=" . trim($parts["path"] ?? "", "/") . "\n";
} else {
    echo "\nDATABASE_URL is NOT SET\n";
}
