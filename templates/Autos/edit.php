<h1><?= __('Edit Car') ?></h1>
<?= $this->Form->create($auto) ?>
<?= $this->Form->control('marca', ['label' => __('Brand')]) ?>
<?= $this->Form->control('modelo', ['label' => __('Model')]) ?>
<?= $this->Form->control('tipo_combustible', ['label' => __('Fuel Type'), 'options' => $tiposCombustible]) ?>
<?= $this->Form->control('estado', ['label' => __('Status'), 'options' => $estados]) ?>
<?= $this->Form->control('fecha_limite', ['label' => __('Due Date'), 'type' => 'date']) ?>
<?= $this->Form->control('descripcion_es', ['label' => 'Descripción (Español)', 'type' => 'textarea']) ?>
<?= $this->Form->control('descripcion_en', ['label' => 'Description (English)', 'type' => 'textarea']) ?>
<?= $this->Form->button(__('Save Car')) ?>
<?= $this->Html->link('Cancelar', ['action' => 'index']) ?>
<?= $this->Form->end() ?>
