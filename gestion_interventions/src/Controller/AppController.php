<?php
declare(strict_types=1);
namespace App\Controller;
use Cake\Controller\Controller;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Flash');
    }

    protected function isLoggedIn(): bool
    {
        return (bool)$this->request->getSession()->read('Auth.loggedIn');
    }

    protected function requireLogin(): ?\Cake\Http\Response
    {
        if (!$this->isLoggedIn()) {
            $this->Flash->error('Veuillez vous connecter.');
            return $this->redirect('/');
        }
        return null;
    }
}