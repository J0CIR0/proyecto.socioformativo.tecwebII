<h1><?= __('Add Car') ?></h1>

<?= $this->Form->create($auto) ?>
<div class="row">
    <div class="column column-50">
        <?= $this->Form->control('marca', ['label' => __('Brand'), 'required' => true]) ?>
        <?= $this->Form->control('modelo', ['label' => __('Model'), 'required' => true]) ?>
        <?= $this->Form->control('tipo_combustible', [
            'label' => __('Fuel Type'),
            'options' => $tiposCombustible,
            'empty' => 'Seleccione...',
            'required' => true
        ]) ?>
    </div>
    <div class="column column-50">
        <?= $this->Form->control('estado', [
            'label' => __('Status'),
            'options' => array_combine($estados, $estados),
            'required' => true
        ]) ?>
        <?= $this->Form->control('fecha_limite', ['label' => __('Due Date'), 'type' => 'date']) ?>
    </div>
</div>

<?= $this->Form->control('descripcion_es', ['label' => 'Descripción (Español)', 'type' => 'textarea', 'rows' => 3]) ?>
<?= $this->Form->control('descripcion_en', ['label' => 'Description (English)', 'type' => 'textarea', 'rows' => 3]) ?>

<div class="row">
    <div class="column">
        <?= $this->Form->button(__('Save Car'), ['class' => 'button']) ?>
        <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'button']) ?>
    </div>
</div>
<?= $this->Form->end() ?>

<style>
    .button { background: #007bff; color: white; padding: 8px 16px; border: none; cursor: pointer; margin-right: 10px; }
    form { margin-top: 20px; }
    label { font-weight: bold; }
    input, select, textarea { width: 100%; padding: 8px; margin-bottom: 15px; }
</style>
