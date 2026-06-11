<?php
$root = 'C:/xampp/htdocs/gestion_interventions';
$paths = [
    $root . '/templates/Pages/home.php',
    $root . '/templates/pages/home.php',
    $root . '/src/Template/Pages/home.php',
];
foreach ($paths as $p) {
    echo $p . ' => ' . (file_exists($p) ? '<b style="color:green">EXISTE</b>' : '<span style="color:red">NON</span>') . '<br>';
}
echo '<hr><b>Dir templates/Pages:</b><pre>';
print_r(scandir($root . '/templates/Pages'));
echo '</pre>';