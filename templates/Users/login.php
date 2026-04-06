<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="users form content">
    <?= $this->Form->create(null, ['url' => ['action' => 'login']]) ?>
    <fieldset>
        <legend><?= __('Please enter your email and password') ?></legend>

        <?= $this->Form->control('correo', [
            'required' => true
        ]) ?>

        <?= $this->Form->control('password', [
            'required' => true
        ]) ?>

    </fieldset>

    <?= $this->Form->button(__('Sign in')) ?>
    <?= $this->Form->end() ?>
</div>
