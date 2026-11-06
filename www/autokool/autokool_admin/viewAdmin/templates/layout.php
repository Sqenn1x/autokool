<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Haldus – <?= e(cfg('site_name')) ?></title>
    <link href="../public/css/style.css" rel="stylesheet">
</head>
<body>
<?php if (isset($_SESSION['userId']) && isset($_SESSION['sessionId'])): ?>
    <div class="admin-bar">
        <div class="container">
            <strong>Haldus</strong>
            <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 'admin'): ?>
                <a href="../" target="_blank">VEEBILEHT</a> &#187;
                <a href="bookingsAdmin">Registreerumised</a> &#187;
                <a href="courseAdmin">Kursused</a>
            <?php else: ?>
                <span>Sul puuduvad õigused!</span>
            <?php endif; ?>
            <span class="spacer"></span>
            <span><?= e($_SESSION['name']) ?></span>
            <a href="logout">Välju</a>
        </div>
    </div>
<?php endif; ?>

<main class="container" id="content">
    <?php if ($m = flash()): ?>
        <div class="alert alert-ok"><?= e($m) ?></div>
    <?php endif; ?>
    <?php echo $content; ?>
</main>

<footer class="site-footer">
    <div class="container copy">&copy; <?= date('Y') ?> <?= e(cfg('site_name')) ?> – haldus</div>
</footer>
<script>
document.addEventListener('submit', function (e) {
    var msg = e.target.getAttribute('data-confirm');
    if (msg && !window.confirm(msg)) { e.preventDefault(); }
});
</script>
</body>
</html>
