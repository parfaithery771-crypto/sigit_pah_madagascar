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
        $total = $Interventions->find()->count();
        $resolues = $Interventions->find()->where(["statut" => "repare"])->count();
        $enCours = $Interventions->find()->where(["statut" => "cours"])->count();
        $reparables = $Interventions->find()->where(["statut" => "reparable"])->count();
        $taux = $total > 0 ? round(($resolues / $total) * 100, 1) : 0;
        $parType = [
            "resolution_probleme" => $Interventions->find()->where(["type_intervention" => "resolution_probleme"])->count(),
            "installation_configuration" => $Interventions->find()->where(["type_intervention" => "installation_configuration"])->count(),
            "restoration_mise_a_niveau" => $Interventions->find()->where(["type_intervention" => "restoration_mise_a_niveau"])->count(),
            "supervision_fonctionnement" => $Interventions->find()->where(["type_intervention" => "supervision_fonctionnement"])->count(),
            "supervision_analyse_pannes" => $Interventions->find()->where(["type_intervention" => "supervision_analyse_pannes"])->count(),
        ];
        $this->set(compact("total","resolues","enCours","reparables","taux","parType"));
    }
}