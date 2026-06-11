<?php
declare(strict_types=1);
namespace App\Model\Table;
use Cake\ORM\Table;

class InterventionsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('interventions');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Users', ['foreignKey' => 'user_id']);
        $this->hasMany('Livrables', ['foreignKey' => 'intervention_id']);
    }
}