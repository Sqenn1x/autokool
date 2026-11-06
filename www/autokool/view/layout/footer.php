</main>
<footer class="site-footer">
    <div class="container footer-row">
        <div>
            <strong><?= e(cfg('site_name')) ?></strong><br>
            Pärnu mnt 100, Tallinn<br>
            Tel: +372 5555 1234 · info@kiirtee.example
        </div>
        <div>E–R 9:00–18:00<br>L 10:00–14:00</div>
        <div><a href="<?= url('autokool_admin/') ?>">Haldus</a></div>
    </div>
    <div class="container copy">© <?= date('Y') ?> <?= e(cfg('site_name')) ?>. Õppeprojekt, kõik andmed on näidisandmed.</div>
</footer>
<script src="<?= url('js/main.js') ?>"></script>
</body>
</html>
