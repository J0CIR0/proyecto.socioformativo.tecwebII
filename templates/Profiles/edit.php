<h1><?= __('Profile') ?></h1>

<?= $this->Form->create($profile) ?>
<div class="row">
    <div class="column column-50">
        <?= $this->Form->control('nombre', ['label' => __('Name')]) ?>
        <?= $this->Form->control('apellido', ['label' => __('Last Name')]) ?>
        <?= $this->Form->control('idioma', [
            'label' => __('Language'),
            'options' => $idiomas,
            'empty' => 'Seleccione...'
        ]) ?>
    </div>
</div>
<div class="row">
    <div class="column">
        <?= $this->Form->button(__('Save Profile'), ['class' => 'button']) ?>
    </div>
</div>
<?= $this->Form->end() ?>

<style>
    .button { background: #28a745; color: white; padding: 8px 16px; border: none; cursor: pointer; }
    form { margin-top: 20px; }
    label { font-weight: bold; }
    input, select { width: 100%; padding: 8px; margin-bottom: 15px; }
</style>
