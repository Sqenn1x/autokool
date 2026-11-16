</main>
<footer class="site-footer">
    <div class="container footer-row">
        <div>
            <strong><?= e(cfg('site_name')) ?></strong><br>
            Pärnu mnt 100, Tallinn<br>
            <?= e(t('Tel', 'Тел.')) ?>: +372 5555 1234 · info@kiirtee.example
        </div>
        <div><?= e(t('E–R', 'Пн–Пт')) ?> 9:00–18:00<br><?= e(t('L', 'Сб')) ?> 10:00–14:00</div>
        <div><a href="<?= url('autokool_admin/') ?>"><?= e(t('Haldus', 'Администрирование')) ?></a></div>
    </div>
    <div class="container copy">© <?= date('Y') ?> <?= e(cfg('site_name')) ?>. <?= e(t('Õppeprojekt, kõik andmed on näidisandmed.', 'Учебный проект, все данные являются демонстрационными.')) ?></div>
</footer>
<script src="<?= url('js/main.js') ?>"></script>
</body>
</html>
