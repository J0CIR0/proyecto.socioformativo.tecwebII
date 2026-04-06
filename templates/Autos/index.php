<h1><?= __('My Cars') ?></h1>

<div class="filters">
    <?= $this->Form->create(null, ['type' => 'get']) ?>
    <div class="row">
        <div class="column column-50">
            <?= $this->Form->control('search', ['label' => __('Search'), 'value' => $search]) ?>
        </div>
        <div class="column column-30">
            <?= $this->Form->control('estado', [
                'label' => __('Filter by Status'),
                'options' => ['' => __('All')] + $estados,
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

<?php if (empty($autos)): ?>
    <p><?= __('No cars registered yet. Add your first car.') ?></p>
<?php else: ?>
    <table class="table">
        <thead>
            <tr>
                <?php if ($this->request->getAttribute('identity')->rol === 'admin'): ?>
                    <th><?= __('User') ?></th>
                <?php endif; ?>
                <th><?= __('Brand') ?></th>
                <th><?= __('Model') ?></th>
                <th><?= __('Fuel Type') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Due Date') ?></th>
                <th><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($autos as $auto): ?>
            <tr>
                <?php if ($this->request->getAttribute('identity')->rol === 'admin'): ?>
                    <td><?= h($auto->user->correo ?? __('N/A')) ?></td>
                <?php endif; ?>
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
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $auto->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $auto->id], ['confirm' => __('Delete this car?')]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator"><?= $this->Paginator->numbers() ?></div>
<?php endif; ?>

    <h2><?= $saludo ?? 'Bienvenido' ?>, <?= $identity->name ?? 'Usuario' ?>!</h2>

    <style>
        .table tbody tr:nth-child(odd) { background-color: #f9f9f9; }
        .table tbody tr:hover { background-color: #f5f5f5; }
    </style>
