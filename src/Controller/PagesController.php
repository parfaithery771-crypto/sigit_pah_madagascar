<?php
declare(strict_types=1);
namespace App\Controller;

class PagesController extends AppController
{
    public function home(): void { $this->set("showOverlay",""); }

    public function dashboard(): void
    {
        if (!$this->isLoggedIn()) { $this->redirect("/login"); return; }
        $Interventions = $this->getTableLocator()->get("Interventions");
        $Livrables = $this->getTableLocator()->get("Livrables");
        $total      = $Interventions->find()->count();
        $resolues   = $Interventions->find()->where(["statut"=>"repare"])->count();
        $enCours    = $Interventions->find()->where(["statut"=>"cours"])->count();
        $reparables = $Interventions->find()->where(["statut"=>"reparable"])->count();
        $stats = [
            ["label"=>"Total",     "value"=>$total,     "sub"=>"Toutes",    "icon"=>"&#9874;"],
            ["label"=>"Resolues",  "value"=>$resolues,  "sub"=>"Reglees",   "icon"=>"&#10003;"],
            ["label"=>"En Cours",  "value"=>$enCours,   "sub"=>"Traitement","icon"=>"&#9203;"],
            ["label"=>"Reparables","value"=>$reparables,"sub"=>"En attente","icon"=>"&#128295;"],
        ];
        $countByType = [
            "resolution_probleme"        => $Interventions->find()->where(["type_intervention"=>"resolution_probleme"])->count(),
            "installation_configuration" => $Interventions->find()->where(["type_intervention"=>"installation_configuration"])->count(),
            "restoration_mise_a_niveau"  => $Interventions->find()->where(["type_intervention"=>"restoration_mise_a_niveau"])->count(),
            "supervision_fonctionnement" => $Interventions->find()->where(["type_intervention"=>"supervision_fonctionnement"])->count(),
            "supervision_analyse_pannes" => $Interventions->find()->where(["type_intervention"=>"supervision_analyse_pannes"])->count(),
        ];
        $livrablesList = $Livrables->find()->orderBy(["date_livraison"=>"DESC"])->limit(5)->toArray();
        if ($this->isAdmin()) {
            $recentInterventions = $Interventions->find()->orderBy(["created"=>"DESC"])->limit(10)->toArray();
        } else {
            $userId = $this->currentUserId();
            $recentInterventions = $Interventions->find()->where(["user_id"=>$userId])->orderBy(["created"=>"DESC"])->limit(10)->toArray();
            $total      = $Interventions->find()->where(["user_id"=>$userId])->count();
            $resolues   = $Interventions->find()->where(["statut"=>"repare","user_id"=>$userId])->count();
            $enCours    = $Interventions->find()->where(["statut"=>"cours","user_id"=>$userId])->count();
            $reparables = $Interventions->find()->where(["statut"=>"reparable","user_id"=>$userId])->count();
            $stats = [
                ["label"=>"Total",     "value"=>$total,     "sub"=>"Toutes",    "icon"=>"&#9874;"],
                ["label"=>"Resolues",  "value"=>$resolues,  "sub"=>"Reglees",   "icon"=>"&#10003;"],
                ["label"=>"En Cours",  "value"=>$enCours,   "sub"=>"Traitement","icon"=>"&#9203;"],
                ["label"=>"Reparables","value"=>$reparables,"sub"=>"En attente","icon"=>"&#128295;"],
            ];
        }
        $this->set(compact("stats","livrablesList","recentInterventions","countByType","total","resolues","enCours","reparables"));
    }

    public function apropos(): void { $this->set("showOverlay","apropos"); $this->render("home"); }
    public function parametres(): void { $this->set("showOverlay","parametre"); $this->render("home"); }
    public function aide(): void { $this->set("showOverlay","aide"); $this->render("home"); }

    public function beneficiaires(): void
    {
        $redirect = $this->requireLogin();
        if ($redirect) return;
        $Interventions = $this->getTableLocator()->get("Interventions");
        $beneficiaires = $Interventions->find()
            ->select(["beneficiaire","total"=>"COUNT(*)"])
            ->groupBy("beneficiaire")
            ->orderBy(["total"=>"DESC"])
            ->toArray();
        $this->set(compact("beneficiaires"));
    }

    public function materiel(): void
    {
        $redirect = $this->requireLogin();
        if ($redirect) return;
        $Interventions = $this->getTableLocator()->get("Interventions");
        $parType = $Interventions->find()
            ->select(["type_intervention","total"=>"COUNT(*)"])
            ->groupBy("type_intervention")
            ->orderBy(["total"=>"DESC"])
            ->toArray();
        $this->set(compact("parType"));
    }

    public function rapports(): void
    {
        $redirect = $this->requireLogin();
        if ($redirect) return;
        $Interventions = $this->getTableLocator()->get("Interventions");
        $total    = $Interventions->find()->count();
        $resolues = $Interventions->find()->where(["statut"=>"repare"])->count();
        $enCours  = $Interventions->find()->where(["statut"=>"cours"])->count();

        $parType = [
            "resolution_probleme"        => $Interventions->find()->where(["type_intervention"=>"resolution_probleme"])->count(),
            "installation_configuration" => $Interventions->find()->where(["type_intervention"=>"installation_configuration"])->count(),
            "restoration_mise_a_niveau"  => $Interventions->find()->where(["type_intervention"=>"restoration_mise_a_niveau"])->count(),
            "supervision_fonctionnement" => $Interventions->find()->where(["type_intervention"=>"supervision_fonctionnement"])->count(),
            "supervision_analyse_pannes" => $Interventions->find()->where(["type_intervention"=>"supervision_analyse_pannes"])->count(),
        ];

        $allInterventions = $Interventions->find()->orderBy(["date_intervention"=>"DESC"])->toArray();

        $grouped = [];
        foreach($allInterventions as $i) {
            $type = $i->type_intervention;
            if(!isset($grouped[$type])) $grouped[$type] = [];
            $grouped[$type][] = $i;
        }

        $recentInterventions = $allInterventions;
        $this->set(compact("total","resolues","enCours","parType","grouped","recentInterventions"));
    }
}