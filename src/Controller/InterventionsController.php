<?php
declare(strict_types=1);
namespace App\Controller;
class InterventionsController extends AppController
{
    public function index()
    {
        $redirect = $this->requireLogin();
        if ($redirect) return $redirect;
        try {
            $Interventions = $this->getTableLocator()->get('Interventions');
            $interventions = $Interventions->find()->orderBy(['Interventions.id' => 'DESC'])->toArray();
            $this->set('interventions', $interventions);
        } catch (\Exception $e) {
            $this->Flash->error('Erreur: ' . $e->getMessage());
            $this->set('interventions', []);
        }
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
            'date_intervention'   => $data['date_intervention'],
            'observation'         => $data['observation'] ?? '',
            'description_travaux' => $data['description_travaux'] ?? '',
            'beneficiaire'        => $data['beneficiaire'],
            'type_intervention'   => $data['type_intervention'],
            'statut'              => $data['statut'] ?? 'cours',
            'user_id'             => $session->read('Auth.id'),
        ]);
        try {
            if ($Interventions->save($intervention)) {
                $this->Flash->success('Intervention ajoutee avec succes.');
                return $this->redirect('/dashboard');
            }
            $this->Flash->error('Validation: ' . json_encode($intervention->getErrors()));
            return $this->redirect('/dashboard');
        } catch (\Exception $e) {
            $this->Flash->error('Exception: ' . $e->getMessage());
            return $this->redirect('/dashboard');
        }
    }
}