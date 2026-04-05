<h1><?= __('My Cars') ?></h1>

<p><?= $this->Html->link('+ ' . __('Add Car'), ['action' => 'add'], ['class' => 'button']) ?></p>

<?php if (empty($autos)): ?>
    <p>No hay autos registrados. ¡Agrega tu primer auto!</p>
<?php else: ?>
    <table class="table">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Combustible</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($autos as $auto): ?>
            <tr>
                <td><?= h($auto->marca) ?></td>
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
    <div class="paginator"><?= $this->Paginator->numbers() ?></div>
<?php endif; ?>
