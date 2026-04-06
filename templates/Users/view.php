<h1><?= __('User Detail') ?></h1>

<div class="row">
    <div class="column column-50">
        <h3><?= __('Personal Information') ?></h3>
        <table class="table">
            <tr><th>ID</th><td><?= $user->id ?></td></tr>
            <tr><th><?= __('Name') ?></th><td><?= h($user->name) ?></td></tr>
            <tr><th><?= __('Last Name') ?></th><td><?= h($user->last_name) ?></td></tr>
            <tr><th><?= __('Email') ?></th><td><?= h($user->correo) ?></td></tr>
            <tr><th><?= __('Phone') ?></th><td><?= h($user->phone) ?></td></tr>
            <tr><th><?= __('Role') ?></th><td><?= $user->rol === 'admin' ? __('Administrator') : __('Customer') ?></td></tr>
            <tr><th><?= __('Created') ?></th><td><?= $user->created->format('d/m/Y H:i:s') ?></td></tr>
            <tr><th><?= __('Modified') ?></th><td><?= $user->modified->format('d/m/Y H:i:s') ?></td></tr>
        </table>
    </div>
    
    <div class="column column-50">
        <h3><?= __('Profile') ?></h3>
        <table class="table">
            <tr><th><?= __('Profile Name') ?></th><td><?= h($user->profile->nombre ?? __('N/A')) ?></td></tr>
            <tr><th><?= __('Profile Last Name') ?></th><td><?= h($user->profile->apellido ?? __('N/A')) ?></td></tr>
            <tr><th><?= __('Language') ?></th><td><?= h($user->profile->idioma ?? 'es_ES') ?></td></tr>
        </table>
    </div>
</div>

<h3><?= __('User Cars') ?></h3>
<?php if (empty($user->autos)): ?>
    <p><?= __('This user has no cars registered.') ?></p>
<?php else: ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th><?= __('Brand') ?></th>
                <th><?= __('Model') ?></th>
                <th><?= __('Fuel Type') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Due Date') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user->autos as $auto): ?>
            <tr>
                <td><?= $auto->id ?></td>
                <td><?= h($auto->marca) ?></td>
                <td><?= h($auto->modelo) ?></td>
                <td><?= h($auto->tipo_combustible) ?></td>
                <td><?= h($auto->estado) ?></td>
                <td><?= $auto->fecha_limite ? $auto->fecha_limite->format('d/m/Y') : '-' ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<p><?= $this->Html->link(__('Back to Users'), ['action' => 'index'], ['class' => 'button']) ?></p>

<style>
    .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    .table th, .table td { padding: 8px; border-bottom: 1px solid #ddd; text-align: left; }
    .button { background: #007bff; color: white; padding: 8px 16px; text-decoration: none; display: inline-block; }
</style>
