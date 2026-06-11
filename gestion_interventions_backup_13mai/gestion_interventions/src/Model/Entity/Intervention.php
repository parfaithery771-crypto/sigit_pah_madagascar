<?php
declare(strict_types=1);
namespace App\Model\Entity;
use Cake\ORM\Entity;
class Intervention extends Entity {
    protected array $_accessible = [
        "date_intervention"=>true,"observation"=>true,"beneficiaire"=>true,
        "type_intervention"=>true,"statut"=>true,"user_id"=>true,
        "created"=>true,"modified"=>true
    ];
}