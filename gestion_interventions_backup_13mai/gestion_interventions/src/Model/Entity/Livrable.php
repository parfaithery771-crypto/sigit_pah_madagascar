<?php
declare(strict_types=1);
namespace App\Model\Entity;
use Cake\ORM\Entity;
class Livrable extends Entity {
    protected array $_accessible = [
        "date_livraison"=>true,"etat"=>true,"direction"=>true,
        "intervention_id"=>true,"created"=>true,"modified"=>true
    ];
}