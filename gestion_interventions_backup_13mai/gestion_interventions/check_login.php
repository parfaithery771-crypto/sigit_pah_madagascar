<?php
require 'vendor/autoload.php';
require 'config/bootstrap.php';
$Users = Cake\ORM\TableRegistry::getTableLocator()->get('Users');
$user = $Users->find()->where(['email' => 'admin@sigit.mg'])->first();
if ($user) {
    echo 'User hita: ' . $user->nom . PHP_EOL;
    echo 'Hash: ' . $user->password . PHP_EOL;
    $test = password_verify('admin123', $user->password);
    echo 'password_verify admin123: ' . ($test ? 'OUI' : 'NON') . PHP_EOL;
} else {
    echo 'User tsy hita!' . PHP_EOL;
}