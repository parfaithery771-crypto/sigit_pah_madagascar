<?php
declare(strict_types=1);
namespace App\Controller;
class LivrablesController extends AppController
{
    public function index()
    {
        $redirect = $this->requireLogin();
        if ($redirect) return $redirect;
        $Livrables = $this->getTableLocator()->get("Livrables");
        $livrables = $Livrables->find()->orderBy(["date_livraison" => "DESC"])->toArray();
        $this->set("livrables", $livrables);
    }
    public function add()
    {
        $redirect = $this->requireLogin();
        if ($redirect) return $redirect;
        if ($this->request->is("post")) {
            $data = $this->request->getData();
            $Livrables = $this->getTableLocator()->get("Livrables");
            $livrable = $Livrables->newEntity([
                "date_livraison"  => $data["date_livraison"] ?? date("Y-m-d"),
                "etat"            => $data["etat"] ?? "en_attente",
                "direction"       => $data["direction"] ?? "",
                "intervention_id" => !empty($data["intervention_id"]) ? (int)$data["intervention_id"] : null,
            ]);
            if ($Livrables->save($livrable)) {
                $this->Flash->success("Livrable ajoute.");
                return $this->redirect("/livrables");
            }
            $this->Flash->error("Erreur lors de l ajout.");
        }
        return $this->redirect("/livrables");
    }
    public function edit($id = null)
    {
        $redirect = $this->requireLogin();
        if ($redirect) return $redirect;
        $Livrables = $this->getTableLocator()->get("Livrables");
        $livrable = $Livrables->get($id);
        if ($this->request->is(["post", "put"])) {
            $data = $this->request->getData();
            $etat = $data["etat"] ?? $livrable->etat ?? "en_attente";
            $livrable->date_livraison = $data["date_livraison"] ?? $livrable->date_livraison;
            $livrable->etat = $etat;
            $livrable->direction = $data["direction"] ?? "";
            $livrable->intervention_id = !empty($data["intervention_id"]) ? (int)$data["intervention_id"] : null;
            if ($Livrables->save($livrable)) {
                $this->Flash->success("Livrable modifie.");
                return $this->redirect("/livrables");
            }
            $this->Flash->error("Erreur modification.");
        }
        $this->set("livrable", $livrable);
    }
    public function delete($id = null)
    {
        $redirect = $this->requireLogin();
        if ($redirect) return $redirect;
        $Livrables = $this->getTableLocator()->get("Livrables");
        $livrable = $Livrables->get($id);
        if ($Livrables->delete($livrable)) {
            $this->Flash->success("Livrable supprime.");
        }
        return $this->redirect("/livrables");
    }
}