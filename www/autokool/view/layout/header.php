<!DOCTYPE html>
<html lang="et">
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
            <img src="<?= url('images/logo.svg') ?>" alt="" width="36" height="36">
            <span><?= e(cfg('site_name')) ?></span>
        </a>
        <button class="nav-toggle" aria-label="Menüü" aria-expanded="false">☰</button>
        <nav class="main-nav">
            <a href="<?= url('/') ?>">Avaleht</a>
            <a href="<?= url('courses') ?>">Kursused</a>
            <a href="<?= url('instructors') ?>">Instruktorid</a>
            <a href="<?= url('contact') ?>">Kontakt</a>
            <a class="btn btn-small" href="<?= url('bookingForm') ?>">Registreeru</a>
        </nav>
    </div>
</header>
<main class="container">
<?php if ($m = flash()): ?>
    <div class="alert alert-ok"><?= e($m) ?></div>
<?php endif; ?>
