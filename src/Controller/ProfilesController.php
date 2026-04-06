<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\I18n;
use Authentication\PasswordHasher\DefaultPasswordHasher;

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
        
        if (!$identity) {
            $this->Flash->error('Debes iniciar sesion');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
        
        $usersTable = $this->getTableLocator()->get('Users');
        $user = $usersTable->get($identity->id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $profileData = [
                'name' => $data['name'] ?? $user->name,
                'last_name' => $data['last_name'] ?? $user->last_name,
                'telefono' => $data['telefono'] ?? $user->telefono,
                'idioma' => $data['idioma'] ?? $user->idioma,
            ];

            if (!in_array((string)$profileData['idioma'], ['es_ES', 'en_US'], true)) {
                $this->Flash->error(__('Idioma no valido'));

                return $this->redirect(['action' => 'edit']);
            }

            $user = $usersTable->patchEntity($user, $profileData);

            $currentPassword = (string)($data['current_password'] ?? '');
            $newPassword = (string)($data['new_password'] ?? '');
            $confirmPassword = (string)($data['confirm_password'] ?? '');

            if ($newPassword !== '' || $confirmPassword !== '' || $currentPassword !== '') {
                $hasher = new DefaultPasswordHasher();
                $passwordMatches = $hasher->check($currentPassword, (string)$user->password) || $currentPassword === (string)$user->password;

                if (!$passwordMatches) {
                    $this->Flash->error(__('La contrasena actual no es correcta'));

                    return $this->redirect(['action' => 'edit']);
                }

                if ($newPassword === '' || strlen($newPassword) < 5) {
                    $this->Flash->error(__('La nueva contrasena debe tener al menos 5 caracteres'));

                    return $this->redirect(['action' => 'edit']);
                }

                if ($newPassword !== $confirmPassword) {
                    $this->Flash->error(__('La confirmacion de contrasena no coincide'));

                    return $this->redirect(['action' => 'edit']);
                }

                $user->password = $newPassword;
            }

            if ($usersTable->save($user)) {
                I18n::setLocale((string)$user->idioma);
                $this->request->getSession()->write('App.locale', (string)$user->idioma);
                $this->Flash->success(__('Perfil actualizado correctamente'));

                return $this->redirect(['action' => 'edit']);
            } else {
                $this->Flash->error(__('Error al guardar el perfil'));
            }
        }
        
        $idiomas = ['es_ES' => 'Espanol', 'en_US' => 'English'];
        $this->set(compact('user', 'idiomas'));
    }
    
    public function language()
    {
        $identity = $this->request->getAttribute('identity');

        if (!$identity || !isset($identity->id)) {
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
        
        if ($this->request->is(['post', 'put'])) {
            $lang = (string)$this->request->getData('idioma');

            if (!in_array($lang, ['es_ES', 'en_US'], true)) {
                $this->Flash->error(__('Idioma no valido'));
                return $this->redirect($this->referer());
            }

            $usersTable = $this->getTableLocator()->get('Users');
            $user = $usersTable->get($identity->id);
            $user->idioma = $lang;
            
            if ($usersTable->save($user)) {
                I18n::setLocale($lang);
                $this->request->getSession()->write('App.locale', $lang);
                $this->Flash->success(__('Idioma cambiado a {0}', $lang === 'es_ES' ? 'Espanol' : 'English'));
            } else {
                $this->Flash->error(__('No se pudo cambiar el idioma'));
            }
        }
        
        return $this->redirect($this->referer());
    }
}
