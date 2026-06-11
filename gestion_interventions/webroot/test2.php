<?php
require dirname(__DIR__) . '/vendor/autoload.php';
\Cake\Core\Configure::write('debug', true);
\Cake\Core\Configure::write('App.namespace', 'App');
use Cake\Core\App;
$paths = App::path('templates');
echo '<h2>Paths tadiaviny CakePHP:</h2>';
foreach ($paths as $p) {
    echo '<b>' . $p . '</b><br>';
    echo 'Pages/home.php exists: ' . (file_exists($p . 'Pages/home.php') ? '<span style="color:green">OUI</span>' : '<span style="color:red">NON</span>') . '<br><br>';
}