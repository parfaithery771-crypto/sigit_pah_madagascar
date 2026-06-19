<?php
$file = __DIR__ . '/../logs/error.log';
if (file_exists($file)) {
    echo "<pre>";
    $lines = file($file);
    $last = array_slice($lines, -80);
    echo htmlspecialchars(implode('', $last));
    echo "</pre>";
} else {
    echo "Fichier tsy hita: " . $file;
    echo "<br><br>Dossier logs: <pre>";
    print_r(scandir(__DIR__ . '/../logs'));
    echo "</pre>";
}