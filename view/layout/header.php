<!DOCTYPE html>
<html lang="<?= e(current_language()) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e(($title ?? '') ? $title . ' | ' : '') ?><?= e(cfg('site_name')) ?></title>
    <link rel="icon" type="image/svg+xml" href="<?= url('images/logo.svg') ?>">
    <link rel="stylesheet" href="<?= url('public/css/style.css') ?>">
</head>
<body>

<header class="site-header">
    <div class="container header-row">
        <a class="brand" href="<?= url('/') ?>">
            <span class="logo-icon">⊗</span>
            <span>autokool.</span>
        </a>
        <button class="nav-toggle" aria-label="<?= e(t('Menüü', 'Меню')) ?>" aria-expanded="false">☰</button>
        <nav class="main-nav">
            <a href="<?= url('/') ?>"><?= e(t('Avaleht', 'Главная')) ?></a>
            <a href="<?= url('courses') ?>"><?= e(t('Kursused', 'Курсы')) ?></a>
            <a href="<?= url('instructors') ?>"><?= e(t('Instruktorid', 'Инструкторы')) ?></a>
            <a href="<?= url('contact') ?>"><?= e(t('Kontakt', 'Контакты')) ?></a>
            <a class="btn btn-header" href="<?= url('bookingForm') ?>"><?= e(t('Registreeru', 'Записаться')) ?> ↗</a>
        </nav>
    </div>
</header>
<details class="language-switch">
    <summary aria-label="<?= e(t('Vali keel', 'Выбрать язык')) ?>">
        <span aria-hidden="true">🌐</span> <?= current_language() === 'ru' ? 'RU' : 'ET' ?> <span class="language-chevron">⌄</span>
    </summary>
    <div class="language-options">
        <a href="<?= e(language_url('et')) ?>" lang="et" class="<?= current_language() === 'et' ? 'active' : '' ?>">🇪🇪 Eesti</a>
        <a href="<?= e(language_url('ru')) ?>" lang="ru" class="<?= current_language() === 'ru' ? 'active' : '' ?>">🇷🇺 Русский</a>
    </div>
</details>

<main class="container">
<?php if ($m = flash()): ?>
    <div class="alert alert-ok"><?= e($m) ?></div>
<?php endif; ?>