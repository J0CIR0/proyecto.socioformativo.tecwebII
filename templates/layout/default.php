<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Autos Multilingüe</title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <style>
        .top-nav-links a { margin: 0 10px; }
        .lang-selector { display: inline-block; margin-left: 20px; }
        .user-info { color: white; margin-left: 20px; }
    </style>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>">🚗 <span>Sistema de Autos</span></a>
        </div>
        <div class="top-nav-links">
            <?php if ($this->request->getAttribute('identity')): ?>
                <?= $this->Html->link(__('Dashboard'), ['controller' => 'Autos', 'action' => 'index']) ?>
                <?= $this->Html->link(__('My Cars'), ['controller' => 'Autos', 'action' => 'index']) ?>
                <?= $this->Html->link(__('Add Car'), ['controller' => 'Autos', 'action' => 'add']) ?>
                <?= $this->Html->link(__('Profile'), ['controller' => 'Profiles', 'action' => 'edit']) ?>
                
                <!-- Selector de idioma -->
                <div class="lang-selector">
                    <?= $this->Form->create(null, ['url' => ['controller' => 'Profiles', 'action' => 'language'], 'style' => 'display: inline;']) ?>
                    <?= $this->Form->select('idioma', [
                        'es_ES' => '🇪🇸 Español',
                        'en_US' => '🇺🇸 English'
                    ], [
                        'onchange' => 'this.form.submit()',
                        'value' => $this->request->getAttribute('identity')->profile->idioma ?? 'es_ES'
                    ]) ?>
                    <?= $this->Form->end() ?>
                </div>
                
                <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?>
                <span class="user-info">
                    👤 <?= h($this->request->getAttribute('identity')->correo) ?>
                </span>
            <?php else: ?>
                <?= $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'login']) ?>
                <?= $this->Html->link(__('Register'), ['controller' => 'Users', 'action' => 'add']) ?>
            <?php endif; ?>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
</body>
</html>
