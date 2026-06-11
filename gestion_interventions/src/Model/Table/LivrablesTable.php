<?php
declare(strict_types=1);
namespace App\Model\Table;
use Cake\ORM\Table;

class LivrablesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('livrables');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Interventions', ['foreignKey' => 'intervention_id']);
    }
}