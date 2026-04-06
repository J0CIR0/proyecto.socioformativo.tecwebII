<h1><?= __('My Profile') ?></h1>

<?= $this->Form->create($user) ?>
<div class="row">
    <div class="column column-50">
        <?= $this->Form->control('name', ['label' => __('Name'), 'class' => 'form-control']) ?>
        <?= $this->Form->control('last_name', ['label' => __('Last Name'), 'class' => 'form-control']) ?>
        <?= $this->Form->control('telefono', ['label' => __('Phone'), 'class' => 'form-control']) ?>
        <?= $this->Form->control('idioma', [
            'label' => __('Language'),
            'options' => $idiomas,
            'class' => 'form-control'
        ]) ?>
    </div>
    <div class="column column-50">
        <?= $this->Form->control('correo', ['label' => 'Email', 'class' => 'form-control', 'disabled' => true]) ?>
        <?= $this->Form->control('rol', ['label' => __('Role'), 'class' => 'form-control', 'disabled' => true]) ?>

        <h4><?= __('Change Password') ?></h4>
        <?= $this->Form->control('current_password', ['label' => __('Current Password'), 'type' => 'password', 'required' => false, 'class' => 'form-control']) ?>
        <?= $this->Form->control('new_password', ['label' => __('New Password'), 'type' => 'password', 'required' => false, 'class' => 'form-control']) ?>
        <?= $this->Form->control('confirm_password', ['label' => __('Confirm Password'), 'type' => 'password', 'required' => false, 'class' => 'form-control']) ?>
    </div>
</div>

    <?= $this->Form->button(__('Save Profile'), ['class' => 'button']) ?>
<?= $this->Form->end() ?>

<style>
    .form-control { width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; }
    .button { background: #007bff; color: white; padding: 8px 16px; border: none; cursor: pointer; }
</style>
