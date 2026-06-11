<?php
require 'vendor/autoload.php';
require 'config/bootstrap.php';
$Users = Cake\ORM\TableRegistry::getTableLocator()->get('Users');
$user = $Users->newEntity([
    'nom'      => 'Admin',
    'prenom'   => 'SIGIT',
    'email'    => 'admin@sigit.mg',
    'password' => password_hash('admin123', PASSWORD_DEFAULT),
    'role'     => 'admin',
]);
if ($Users->save($user)) {
    echo 'User cree avec succes!' . PHP_EOL;
    echo 'Email: admin@sigit.mg' . PHP_EOL;
    echo 'Password: admin123' . PHP_EOL;
} else {
    print_r($user->getErrors());
}