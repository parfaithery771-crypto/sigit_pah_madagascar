<?php
declare(strict_types=1);
namespace App\Controller;

class InterventionsController extends AppController
{
    public function index()
    {
        $redirect = $this->requireLogin();
        if ($redirect) return $redirect;
        $Interventions = $this->getTableLocator()->get('Interventions');
        $interventions = $Interventions->find()->orderBy(['created' => 'DESC'])->toArray();
        $this->set('interventions', $interventions);
    }

    public function add()
    {
        $redirect = $this->requireLogin();
        if ($redirect) return $redirect;
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $session = $this->request->getSession();
            $Interventions = $this->getTableLocator()->get('Interventions');
            $intervention = $Interventions->newEntity([
                'date_intervention' => $data['date_intervention'],
                'observation'       => $data['observation'] ?? '',
                'beneficiaire'      => $data['beneficiaire'],
                'type_intervention' => $data['type_intervention'],
                'statut'            => $data['statut'] ?? 'cours',
                'user_id'           => $session->read('Auth.id'),
            ]);
            if ($Interventions->save($intervention)) {
                $this->Flash->success('Intervention ajoutee avec succes.');
                return $this->redirect('/dashboard');
            }
            $this->Flash->error('Erreur lors de l ajout.');
        }
        return $this->redirect('/dashboard');
    }

    public function edit($id = null)
    {
        $redirect = $this->requireLogin();
        if ($redirect) return $redirect;
        $Interventions = $this->getTableLocator()->get('Interventions');
        $intervention = $Interventions->get($id);
        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            $intervention = $Interventions->patchEntity($intervention, [
                'date_intervention' => $data['date_intervention'],
                'observation'       => $data['observation'] ?? '',
                'beneficiaire'      => $data['beneficiaire'],
                'type_intervention' => $data['type_intervention'],
                'statut'            => $data['statut'],
            ]);
            if ($Interventions->save($intervention)) {
                $this->Flash->success('Intervention modifiee.');
                return $this->redirect('/dashboard');
            }
        }
        $this->set('intervention', $intervention);
    }

    public function delete($id = null)
    {
        $redirect = $this->requireLogin();
        if ($redirect) return $redirect;
        $Interventions = $this->getTableLocator()->get('Interventions');
        $intervention = $Interventions->get($id);
        if ($Interventions->delete($intervention)) {
            $this->Flash->success('Intervention supprimee.');
        }
        return $this->redirect('/dashboard');
    }

    public function view($id = null)
    {
        $redirect = $this->requireLogin();
        if ($redirect) return $redirect;
        $Interventions = $this->getTableLocator()->get('Interventions');
        $intervention = $Interventions->get($id);
        $this->set('intervention', $intervention);
    }
}