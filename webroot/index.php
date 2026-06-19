<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

require dirname(__DIR__) . '/vendor/autoload.php';

use App\Application;
use Cake\Http\Server;

try {
    $server = new Server(new Application(dirname(__DIR__) . '/config'));
    $server->emit($server->run());
} catch (\Throwable $e) {
    header('Content-Type: text/plain');
    echo "EXCEPTION CLASS: " . get_class($e) . "\n\n";
    echo "MESSAGE: " . $e->getMessage() . "\n\n";
    echo "FILE: " . $e->getFile() . " LINE: " . $e->getLine() . "\n\n";
    echo "TRACE:\n" . $e->getTraceAsString();
}