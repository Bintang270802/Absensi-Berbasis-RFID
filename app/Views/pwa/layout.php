<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title><?= $title ?? 'Sekolah Ulil Albab' ?></title>
    <meta name="description" content="<?= $description ?? 'Aplikasi Sekolah Ulil Albab' ?>">
    
    <?= pwa_meta_tags() ?>
    
    <!-- Your existing CSS -->
    <?= $this->renderSection('styles') ?>
</head>
<body>
    <!-- Install Button -->
    <?= pwa_install_button() ?>
    
    <!-- Main Content -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>
    
    <!-- Your existing JS -->
    <?= $this->renderSection('scripts') ?>
    
    <!-- PWA Scripts -->
    <?= pwa_scripts() ?>
</body>
</html>
