<h1><?= e(t('Kontakt', 'Контакты')) ?></h1>
<div class="grid">
    <div class="card">
        <h3><?= e(t('Aadress', 'Адрес')) ?></h3>
        <p>Pärnu mnt 100, Tallinn</p>
        <h3><?= e(t('Ühendus', 'Связь')) ?></h3>
        <p><?= e(t('Tel.', 'Тел.')) ?>: +372 5555 1234<br><?= e(t('E-post', 'Эл. почта')) ?>: info@kiirtee.example</p>
    </div>
    <div class="card">
        <h3><?= e(t('Lahtiolekuajad', 'Часы работы')) ?></h3>
        <table class="table">
            <tr><th><?= e(t('E–R', 'Пн–Пт')) ?></th><td>9:00–18:00</td></tr>
            <tr><th><?= e(t('L', 'Сб')) ?></th><td>10:00–14:00</td></tr>
            <tr><th><?= e(t('P', 'Вс')) ?></th><td><?= e(t('Suletud', 'Закрыто')) ?></td></tr>
        </table>
        <a class="btn" href="<?= url('bookingForm') ?>"><?= e(t('Registreeru kursusele', 'Записаться на курс')) ?></a>
    </div>
</div>
