<h1><?= __('My Cars') ?></h1>

<!-- Formulario de búsqueda y filtro -->
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
            <?= $this->Form->button('🔍 ' . __('Search'), ['class' => 'button']) ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>

<p>
    <?= $this->Html->link('➕ ' . __('Add Car'), ['action' => 'add'], ['class' => 'button']) ?>
</p>

<?php if (empty($autos)): ?>
    <div class="message info">
        No hay autos registrados. ¡Agrega tu primer auto!
    </div>
<?php else: ?>
    <table class="table">
        <thead>
            <tr>
                <th><?= __('Brand') ?></th>
                <th><?= __('Model') ?></th>
                <th><?= __('Fuel Type') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Due Date') ?></th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($autos as $auto): ?>
            <tr>
                <td><?= h($auto->marca) ?></td>
                <td><?= h($auto->modelo) ?></td>
                <td><?= h($auto->tipo_combustible) ?></td>
                <td>
                    <span class="badge badge-<?= $auto->estado ?>">
                        <?= h($estados[$auto->estado] ?? $auto->estado) ?>
                    </span>
                </td>
                <td><?= $auto->fecha_limite ? $auto->fecha_limite->format('d/m/Y') : '-' ?></td>
                <td>
                    <?= $this->Html->link('✏️ Editar', ['action' => 'edit', $auto->id]) ?>
                    <?= $this->Form->postLink('🗑️ Eliminar', ['action' => 'delete', $auto->id], ['confirm' => '¿Eliminar este auto?']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
    </div>
<?php endif; ?>

<style>
    .filters { margin-bottom: 20px; background: #f5f5f5; padding: 15px; border-radius: 5px; }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
    .button { background: #007bff; color: white; padding: 8px 16px; border: none; cursor: pointer; text-decoration: none; display: inline-block; }
    .badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; }
    .badge-pendiente { background: #ffc107; color: #000; }
    .badge-en_progreso { background: #17a2b8; color: #fff; }
    .badge-completado { background: #28a745; color: #fff; }
    .message.info { background: #d1ecf1; color: #0c5460; padding: 10px; border-radius: 4px; }
    .paginator { margin-top: 20px; }
    .pagination { list-style: none; padding: 0; }
    .pagination li { display: inline; margin-right: 5px; }
</style>
