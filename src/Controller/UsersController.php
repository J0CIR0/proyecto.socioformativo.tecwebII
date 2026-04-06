<?php
declare(strict_types=1);

namespace App\Controller;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['login', 'add']);
    }

    public function login()
    {
        $identity = $this->request->getAttribute('identity');
        if ($identity) {
            return $this->redirect(['controller' => 'Autos', 'action' => 'index']);
        }

        $result = $this->Authentication->getResult();
        if ($this->request->is('post') && $result->isValid()) {
            return $this->redirect(['controller' => 'Autos', 'action' => 'index']);
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid email or password'));
        }
    }

    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['action' => 'login']);
    }
    
    public function add()
    {
        $usersTable = $this->getTableLocator()->get('Users');
        $user = $usersTable->newEmptyEntity();
        
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['rol'] = 'user';
            $data['idioma'] = 'es_ES';
            
            $user = $usersTable->patchEntity($user, $data);
            if ($usersTable->save($user)) {
                $this->Flash->success(__('User created successfully'));
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('Error creating user'));
            }
        }
        $this->set(compact('user'));
    }
    
    public function index()
    {
        $identity = $this->request->getAttribute('identity');
        
        if (!$identity || $identity->rol !== 'admin') {
            $this->Flash->error(__('You do not have permission to view this page'));
            return $this->redirect(['controller' => 'Autos', 'action' => 'index']);
        }
        
        $users = $this->paginate($this->getTableLocator()->get('Users'));
        $this->set(compact('users'));
    }
    
    public function view($id = null)
    {
        $identity = $this->request->getAttribute('identity');
        
        if (!$identity || $identity->rol !== 'admin') {
            $this->Flash->error(__('You do not have permission to view this page'));
            return $this->redirect(['controller' => 'Autos', 'action' => 'index']);
        }
        
        $user = $this->getTableLocator()->get('Users')->get($id, [
            'contain' => ['Autos']
        ]);
        
        $this->set(compact('user'));
    }
    
    public function edit($id = null)
    {
        $identity = $this->request->getAttribute('identity');
        
        if (!$identity || $identity->rol !== 'admin') {
            $this->Flash->error(__('You do not have permission to view this page'));
            return $this->redirect(['controller' => 'Autos', 'action' => 'index']);
        }
        
        $usersTable = $this->getTableLocator()->get('Users');
        $user = $usersTable->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $usersTable->patchEntity($user, $this->request->getData());
            if ($usersTable->save($user)) {
                $this->Flash->success(__('User updated successfully'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Error updating user'));
        }
        
        $this->set(compact('user'));
    }
    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        
        $identity = $this->request->getAttribute('identity');
        
        if (!$identity || $identity->rol !== 'admin') {
            $this->Flash->error(__('You do not have permission to view this page'));
            return $this->redirect(['controller' => 'Autos', 'action' => 'index']);
        }
        
        $usersTable = $this->getTableLocator()->get('Users');
        $user = $usersTable->get($id);
        
        if ($usersTable->delete($user)) {
            $this->Flash->success(__('User deleted successfully'));
        } else {
            $this->Flash->error(__('Error deleting user'));
        }
        
        return $this->redirect(['action' => 'index']);
    }
}
