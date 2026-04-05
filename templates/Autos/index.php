<h1><?= __('My Cars') ?></h1>

<div class="filters">
    <?= $this->Form->create(null, ['type' => 'get']) ?>
    <div class="row">
        <div class="column column-50">
            <?= $this->Form->control('search', [
                'label' => __('Search'),
                'value' => $search,
                'placeholder' => 'Buscar por marca o modelo...'
            ]) ?>
        </div>
        <div class="column column-30">
            <?= $this->Form->control('estado', [
                'label' => __('Filter by Status'),
                'options' => ['' => 'Todos'] + $estados,
                'value' => $estado
            ]) ?>
        </div>
        <div class="column column-20">
            <label>&nbsp;</label>
            <?= $this->Form->button(__('Search'), ['class' => 'button']) ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>

<p><?= $this->Html->link('+ ' . __('Add Car'), ['action' => 'add'], ['class' => 'button']) ?></p>

<table>
    <thead>
        <tr><th>Marca</th><th>Modelo</th><th>Combustible</th><th>Estado</th><th>Acciones</th></tr>
    </thead>
    <tbody>
    <?php foreach ($autos as $auto): ?>
        <tr><td><?= h($auto->marca) ?></td>
            <td><?= h($auto->modelo) ?></td>
            <td><?= h($auto->tipo_combustible) ?></td>
            <td><?= h($estados[$auto->estado] ?? $auto->estado) ?></td>
            <td>
                <?= $this->Html->link('Editar', ['action' => 'edit', $auto->id]) ?>
                <?= $this->Form->postLink('Eliminar', ['action' => 'delete', $auto->id], ['confirm' => '¿Eliminar?']) ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div><?= $this->Paginator->numbers() ?></div>
