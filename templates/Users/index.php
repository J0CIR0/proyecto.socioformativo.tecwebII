<h1><?= __('Users Management') ?></h1>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th><?= __('Name') ?></th>
            <th><?= __('Last Name') ?></th>
            <th><?= __('Email') ?></th>
            <th><?= __('Phone') ?></th>
            <th><?= __('Language') ?></th>
            <th><?= __('Role') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= h($user->name) ?></td>
            <td><?= h($user->last_name) ?></td>
            <td><?= h($user->correo) ?></td>
            <td><?= h($user->telefono) ?></td>
            <td><?= h($user->idioma) ?></td>
            <td>
                <span class="badge badge-<?= $user->rol ?>">
                    <?= $user->rol === 'admin' ? __('Administrator') : __('Customer') ?>
                </span>
            </span>
            <td><?= $user->created->format('d/m/Y H:i') ?></td>
            <td>
                <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Delete this user?')]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<style>
    .badge-admin { background: #dc3545; color: white; padding: 4px 8px; border-radius: 4px; }
    .badge-user { background: #28a745; color: white; padding: 4px 8px; border-radius: 4px; }
    .table { width: 100%; border-collapse: collapse; }
    .table th, .table td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
</style>
