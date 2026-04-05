<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\I18n;

class AutosController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated([]);
        $this->_setLanguage();
    }
    
    protected function _setLanguage(): void
    {
        $identity = $this->request->getAttribute('identity');
        if ($identity && isset($identity->profile) && $identity->profile) {
            $lang = $identity->profile->idioma;
            I18n::setLocale($lang);
        } else {
            I18n::setLocale('es_ES');
        }
    }
    
    public function index()
    {
        $search = $this->request->getQuery('search');
        $estado = $this->request->getQuery('estado');
        $userId = $this->request->getAttribute('identity')->id;
        
        $query = $this->Autos->find('filtered', [
            'user_id' => $userId,
            'search' => $search,
            'estado' => $estado
        ]);
        
        $autos = $this->paginate($query, ['limit' => 10]);
        
        $estados = [
            'pendiente' => __('Pending'),
            'en_progreso' => __('In Progress'),
            'completado' => __('Completed')
        ];
        
        $this->set(compact('autos', 'search', 'estado', 'estados'));
    }
    
    public function add()
    {
        $auto = $this->Autos->newEmptyEntity();
        
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['user_id'] = $this->request->getAttribute('identity')->id;
            
            $auto = $this->Autos->patchEntity($auto, $data);
            
            if ($this->Autos->save($auto)) {
                $this->Flash->success(__('Car saved successfully'));
                return $this->redirect(['action' => 'index']);
            }
            
            $this->Flash->error(__('Error saving car'));
        }
        
        $tiposCombustible = ['Gasolina', 'Diésel', 'Eléctrico', 'Híbrido', 'GNC'];
        $estados = ['pendiente', 'en_progreso', 'completado'];
        
        $this->set(compact('auto', 'tiposCombustible', 'estados'));
    }
    
    public function edit($id = null)
    {
        $userId = $this->request->getAttribute('identity')->id;
        $auto = $this->Autos->find()
            ->where(['id' => $id, 'user_id' => $userId])
            ->firstOrFail();
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $auto = $this->Autos->patchEntity($auto, $this->request->getData());
            
            if ($this->Autos->save($auto)) {
                $this->Flash->success(__('Car saved successfully'));
                return $this->redirect(['action' => 'index']);
            }
            
            $this->Flash->error(__('Error saving car'));
        }
        
        $tiposCombustible = ['Gasolina', 'Diésel', 'Eléctrico', 'Híbrido', 'GNC'];
        $estados = ['pendiente', 'en_progreso', 'completado'];
        
        $this->set(compact('auto', 'tiposCombustible', 'estados'));
    }
    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        
        $userId = $this->request->getAttribute('identity')->id;
        $auto = $this->Autos->find()
            ->where(['id' => $id, 'user_id' => $userId])
            ->firstOrFail();
        
        if ($this->Autos->delete($auto)) {
            $this->Flash->success(__('Car deleted successfully'));
        } else {
            $this->Flash->error(__('Error deleting car'));
        }
        
        return $this->redirect(['action' => 'index']);
    }
}
