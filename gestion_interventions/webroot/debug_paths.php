<?php
$root = dirname(dirname(__FILE__));
$file = $root . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'Pages' . DIRECTORY_SEPARATOR . 'home.php';
echo '<b>ROOT:</b> ' . $root . '<br>';
echo '<b>File path:</b> ' . $file . '<br>';
echo '<b>File exists:</b> ' . (file_exists($file) ? '<span style="color:green">OUI</span>' : '<span style="color:red">NON</span>') . '<br>';
echo '<b>Dir listing:</b><br><pre>';
print_r(scandir($root . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'Pages'));
echo '</pre>';