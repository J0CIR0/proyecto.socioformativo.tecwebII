<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;
use Cake\I18n\I18n;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication');
    }
    
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $session = $this->request->getSession();
        $locale = (string)$session->read('App.locale');
        $identity = $this->request->getAttribute('identity');

        if (!$locale && $identity && !empty($identity->idioma)) {
            $locale = (string)$identity->idioma;
        }

        if (!in_array($locale, ['es_ES', 'en_US'], true)) {
            $locale = 'es_ES';
        }

        I18n::setLocale($locale);
        $session->write('App.locale', $locale);
    }
}

    public function beforeFilter(EventInterface $event)
    {
        // Verificar sesión expirada
        if ($this->request->getAttribute('identity') && !$this->request->getSession()->read('Auth')) {
            $this->Authentication->logout();
            $this->Flash->error('Sesión expirada');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    public function beforeFilter(EventInterface $event)
    {
        // Verificar sesión expirada
        if ($this->request->getAttribute('identity') && !$this->request->getSession()->read('Auth')) {
            $this->Authentication->logout();
            $this->Flash->error('Sesión expirada');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }
