<?php
declare(strict_types=1);
namespace App\Controller;
class StatistiquesController extends AppController
{
    public function index()
    {
        $redirect = $this->requireLogin();
        if ($redirect) return $redirect;
        $Interventions = $this->getTableLocator()->get("Interventions");
        $userId = $this->currentUserId();
        $base = $this->isAdmin() ? [] : ["user_id" => $userId];
        $total      = $Interventions->find()->where($base)->count();
        $resolues   = $Interventions->find()->where(array_merge($base, ["statut"=>"repare"]))->count();
        $enCours    = $Interventions->find()->where(array_merge($base, ["statut"=>"cours"]))->count();
        $reparables = $Interventions->find()->where(array_merge($base, ["statut"=>"reparable"]))->count();
        $taux = $total > 0 ? round(($resolues / $total) * 100, 1) : 0;
        $parType = [
            "resolution_probleme"        => $Interventions->find()->where(array_merge($base, ["type_intervention"=>"resolution_probleme"]))->count(),
            "installation_configuration" => $Interventions->find()->where(array_merge($base, ["type_intervention"=>"installation_configuration"]))->count(),
            "restoration_mise_a_niveau"  => $Interventions->find()->where(array_merge($base, ["type_intervention"=>"restoration_mise_a_niveau"]))->count(),
            "supervision_fonctionnement" => $Interventions->find()->where(array_merge($base, ["type_intervention"=>"supervision_fonctionnement"]))->count(),
            "supervision_analyse_pannes" => $Interventions->find()->where(array_merge($base, ["type_intervention"=>"supervision_analyse_pannes"]))->count(),
        ];
        $dernieres = $Interventions->find()->where($base)->orderBy(["created"=>"DESC"])->limit(15)->toArray();
        $this->set(compact("total","resolues","enCours","reparables","taux","parType","dernieres"));
    }
}