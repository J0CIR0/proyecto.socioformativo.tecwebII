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
        
        $identity = $this->request->getAttribute('identity');
        if ($identity && !empty($identity->idioma)) {
            I18n::setLocale($identity->idioma);
        } else {
            I18n::setLocale('es_ES');
        }
    }
}
