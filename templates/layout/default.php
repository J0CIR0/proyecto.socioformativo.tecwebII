<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= __('Car System') ?></title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <style>
        .top-nav-links { display: flex; align-items: center; gap: 15px; flex-wrap: wrap; }
        .lang-form { margin: 0; display: inline; }
        .lang-select { padding: 5px; border-radius: 4px; }
        .user-email { color: #fff; background: rgba(255,255,255,0.2); padding: 5px 10px; border-radius: 4px; }
        .button { background: #007bff; color: white; padding: 8px 16px; border: none; cursor: pointer; text-decoration: none; display: inline-block; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; }
        .badge-pendiente { background: #ffc107; color: #000; }
        .badge-en_progreso { background: #17a2b8; color: #fff; }
        .badge-completado { background: #28a745; color: #fff; }
        .filters { margin-bottom: 20px; background: #f5f5f5; padding: 15px; border-radius: 5px; }
    </style>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build(['controller' => 'Autos', 'action' => 'index']) ?>">
                <?= __('Car System') ?>
            </a>
        </div>
        <div class="top-nav-links">
            <?php if ($this->request->getAttribute('identity')): 
                $identity = $this->request->getAttribute('identity');
            ?>
                <?php if ($identity->rol === 'admin'): ?>
                    <?= $this->Html->link(__('Users'), ['controller' => 'Users', 'action' => 'index']) ?>
                    <?= $this->Html->link(__('Cars'), ['controller' => 'Autos', 'action' => 'index']) ?>
                <?php else: ?>
                    <?= $this->Html->link(__('My Cars'), ['controller' => 'Autos', 'action' => 'index']) ?>
                <?php endif; ?>
                
                <?= $this->Html->link(__('My Profile'), ['controller' => 'Profiles', 'action' => 'edit']) ?>
                
                <?= $this->Form->create(null, ['url' => ['controller' => 'Profiles', 'action' => 'language'], 'class' => 'lang-form']) ?>
                <?= $this->Form->select('idioma', [
                    'es_ES' => 'Espanol',
                    'en_US' => 'English'
                ], [
                    'class' => 'lang-select',
                    'onchange' => 'this.form.submit()',
                    'value' => $this->request->getSession()->read('App.locale') ?? ($identity->idioma ?? 'es_ES')
                ]) ?>
                <?= $this->Form->end() ?>
                
                <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?>
                <span class="user-email">
                    <?= h($identity->name ?? $identity->correo) ?> (<?= $identity->rol === 'admin' ? __('Administrator') : __('Customer') ?>)
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

    <style>
        @media (max-width: 768px) {
            .top-nav-links { flex-direction: column; align-items: flex-start; }
            .table { font-size: 12px; }
            .table th, .table td { padding: 5px; }
        }
    </style>

    <a href="#" id="back-to-top" style="position: fixed; bottom: 20px; right: 20px; display: none;">⬆️</a>
    <script>
        window.addEventListener('scroll', function() {
            var btn = document.getElementById('back-to-top');
            btn.style.display = window.scrollY > 300 ? 'block' : 'none';
        });
    </script>

    <div id="loading" style="display: none;">Cargando...</div>
