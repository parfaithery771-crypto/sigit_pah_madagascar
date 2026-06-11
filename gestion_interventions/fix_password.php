<?php
require 'vendor/autoload.php';
require 'config/bootstrap.php';
$Users = Cake\ORM\TableRegistry::getTableLocator()->get('Users');
$user = $Users->find()->where(['email' => 'admin@sigit.mg'])->first();
if ($user) {
    $user->password = password_hash('admin123', PASSWORD_DEFAULT);
    if ($Users->save($user)) {
        echo 'Password reset OK!' . PHP_EOL;
        echo 'Email: admin@sigit.mg' . PHP_EOL;
        echo 'Password: admin123' . PHP_EOL;
        echo 'Hash: ' . $user->password . PHP_EOL;
    }
} else {
    echo 'User tsy hita!' . PHP_EOL;
}