<?php
require 'vendor/autoload.php';
require 'config/bootstrap.php';
$Users = Cake\ORM\TableRegistry::getTableLocator()->get('Users');
$all = $Users->find()->toArray();
foreach($all as $u) {
    echo 'ID:' . $u->id . ' | Email:' . $u->email . ' | Role:' . $u->role . PHP_EOL;
}
echo 'Total users: ' . count($all) . PHP_EOL;