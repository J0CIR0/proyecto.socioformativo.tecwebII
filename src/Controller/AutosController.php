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
        if ($identity && isset($identity->idioma)) {
            I18n::setLocale($identity->idioma);
        } else {
            I18n::setLocale('es_ES');
        }
    }
    
    public function index()
    {
        $identity = $this->request->getAttribute('identity');
        $search = $this->request->getQuery('search');
        $estado = $this->request->getQuery('estado');
        
        $autosTable = $this->getTableLocator()->get('Autos');
        $query = $autosTable->find();
        
        if ($identity->rol === 'admin') {
            $query->contain(['Users']);
        } else {
            $query->where(['Autos.user_id' => $identity->id]);
        }
        
        if (!empty($search)) {
            $query->where(['OR' => [
                'marca LIKE' => '%' . $search . '%',
                'modelo LIKE' => '%' . $search . '%'
            ]]);
        }
        
        if (!empty($estado)) {
            $query->where(['estado' => $estado]);
        }
        
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
        $identity = $this->request->getAttribute('identity');
        $autosTable = $this->getTableLocator()->get('Autos');
        $auto = $autosTable->newEmptyEntity();
        
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['user_id'] = $identity->id;
            
            $auto = $autosTable->patchEntity($auto, $data);
            
            if ($autosTable->save($auto)) {
                $this->Flash->success(__('Car saved successfully'));
                return $this->redirect(['action' => 'index']);
            }
            
            $this->Flash->error(__('Error saving car'));
        }
        
        $tiposCombustible = [
            'Gasolina' => __('Gasoline'),
            'Diesel' => __('Diesel'),
            'Electrico' => __('Electric'),
            'Hibrido' => __('Hybrid'),
            'GNC' => __('CNG'),
        ];
        $estados = [
            'pendiente' => __('Pending'),
            'en_progreso' => __('In Progress'),
            'completado' => __('Completed'),
        ];
        
        $this->set(compact('auto', 'tiposCombustible', 'estados'));
    }
    
    public function edit($id = null)
    {
        $identity = $this->request->getAttribute('identity');
        $autosTable = $this->getTableLocator()->get('Autos');
        
        if ($identity->rol === 'admin') {
            $auto = $autosTable->get($id);
        } else {
            $auto = $autosTable->find()
                ->where(['id' => $id, 'user_id' => $identity->id])
                ->first();
        }
        
        if (!$auto) {
            $this->Flash->error(__('Car not found'));
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $auto = $autosTable->patchEntity($auto, $this->request->getData());
            
            if ($autosTable->save($auto)) {
                $this->Flash->success(__('Car updated successfully'));
                return $this->redirect(['action' => 'index']);
            }
            
            $this->Flash->error(__('Error updating car'));
        }
        
        $tiposCombustible = [
            'Gasolina' => __('Gasoline'),
            'Diesel' => __('Diesel'),
            'Electrico' => __('Electric'),
            'Hibrido' => __('Hybrid'),
            'GNC' => __('CNG'),
        ];
        $estados = [
            'pendiente' => __('Pending'),
            'en_progreso' => __('In Progress'),
            'completado' => __('Completed'),
        ];
        
        $this->set(compact('auto', 'tiposCombustible', 'estados'));
    }
    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        
        $identity = $this->request->getAttribute('identity');
        $autosTable = $this->getTableLocator()->get('Autos');
        
        if ($identity->rol === 'admin') {
            $auto = $autosTable->get($id);
        } else {
            $auto = $autosTable->find()
                ->where(['id' => $id, 'user_id' => $identity->id])
                ->first();
        }
        
        if ($auto && $autosTable->delete($auto)) {
            $this->Flash->success(__('Car deleted successfully'));
        } else {
            $this->Flash->error(__('Error deleting car'));
        }
        
        return $this->redirect(['action' => 'index']);
    }
}

    // En index, agregar saludo
    $hora = date('H');
    $saludo = $hora < 12 ? 'Buenos dias' : ($hora < 18 ? 'Buenas tardes' : 'Buenas noches');
    $this->set(compact('saludo'));

    use Cake\Log\Log;
    // En add, edit, delete
    Log::write('info', 'Usuario ' . $identity->id . ' modificó auto ' . $auto->id);

    $autos = $this->paginate($query->contain(['Users']));

    use Cake\Log\Log;
    // En add, edit, delete
    Log::write('info', 'Usuario ' . $identity->id . ' modificó auto ' . $auto->id);
