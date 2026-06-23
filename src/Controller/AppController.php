<?php
declare(strict_types=1);
namespace App\Controller;
use Cake\Controller\Controller;
use Cake\Event\EventInterface;
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

    protected function isAdmin(): bool
    {
        return $this->request->getSession()->read('Auth.role') === 'admin';
    }

    protected function requireAdmin(): ?\Cake\Http\Response
    {
        $redirect = $this->requireLogin();
        if ($redirect) return $redirect;
        if (!$this->isAdmin()) {
            $this->Flash->error('Acces reserve aux administrateurs.');
            return $this->redirect('/dashboard');
        }
        return null;
    }

    protected function currentUserId(): ?int
    {
        return $this->request->getSession()->read('Auth.id');
    }

    public function beforeRender(EventInterface $event): void
    {
        parent::beforeRender($event);
        if ($this->isLoggedIn() && $this->isAdmin()) {
            try {
                $Users = $this->getTableLocator()->get('Users');
                $pendingCount = $Users->find()->where(['status' => 'pending'])->count();
                $this->set('pendingCount', $pendingCount);
            } catch (\Exception $e) {
                $this->set('pendingCount', 0);
            }
        } else {
            $this->set('pendingCount', 0);
        }
    }
}