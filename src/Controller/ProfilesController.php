<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\I18n;

class ProfilesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated([]);
    }
    
    public function edit()
    {
        $identity = $this->request->getAttribute('identity');
        $userId = $identity->id;
        
        $profile = $this->getTableLocator()->get('Profiles')
            ->find()
            ->where(['user_id' => $userId])
            ->first();
        
        if (!$profile) {
            $profile = $this->getTableLocator()->get('Profiles')->newEmptyEntity();
            $profile->user_id = $userId;
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $profile = $this->getTableLocator()->get('Profiles')
                ->patchEntity($profile, $this->request->getData());
            
            if ($this->getTableLocator()->get('Profiles')->save($profile)) {
                $this->Flash->success(__('Profile updated'));
                return $this->redirect(['action' => 'edit']);
            }
            $this->Flash->error('Error al guardar perfil');
        }
        
        $idiomas = ['es_ES' => 'Español', 'en_US' => 'English'];
        $this->set(compact('profile', 'idiomas'));
    }
}

    public function language()
    {
        $identity = $this->request->getAttribute('identity');
        
        if ($this->request->is(['post', 'put'])) {
            $lang = $this->request->getData('idioma');
            
            $profile = $this->getTableLocator()->get('Profiles')
                ->find()
                ->where(['user_id' => $identity->id])
                ->first();
            
            if ($profile) {
                $profile->idioma = $lang;
                $this->getTableLocator()->get('Profiles')->save($profile);
            }
            
            I18n::setLocale($lang);
            $this->Flash->success('Idioma cambiado a ' . ($lang === 'es_ES' ? 'Español' : 'English'));
        }
        
        return $this->redirect($this->referer());
    }
