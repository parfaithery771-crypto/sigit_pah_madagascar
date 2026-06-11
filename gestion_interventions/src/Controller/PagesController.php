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
        $stats = [
            ["label"=>"Total","value"=>$Interventions->find()->count(),"sub"=>"Toutes","icon"=>"&#9874;"],
            ["label"=>"Resolues","value"=>$Interventions->find()->where(["statut"=>"repare"])->count(),"sub"=>"Reglees","icon"=>"&#10003;"],
            ["label"=>"En Cours","value"=>$Interventions->find()->where(["statut"=>"cours"])->count(),"sub"=>"Traitement","icon"=>"&#9203;"],
            ["label"=>"Reparables","value"=>$Interventions->find()->where(["statut"=>"reparable"])->count(),"sub"=>"En attente","icon"=>"&#128295;"],
        ];
        $livrablesList = $Livrables->find()->orderBy(["date_livraison"=>"DESC"])->limit(5)->toArray();
        $recentInterventions = $Interventions->find()->orderBy(["created"=>"DESC"])->limit(10)->toArray();
        $this->set(compact("stats","livrablesList","recentInterventions"));
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
        $total = $Interventions->find()->count();
        $resolues = $Interventions->find()->where(["statut"=>"repare"])->count();
        $enCours = $Interventions->find()->where(["statut"=>"cours"])->count();
        $recentInterventions = $Interventions->find()->orderBy(["created"=>"DESC"])->limit(50)->toArray();
        $this->set(compact("total","resolues","enCours","recentInterventions"));
    }
}