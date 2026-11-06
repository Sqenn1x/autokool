<?php ob_start(); ?>
<article>
    <h3>Halduspaneel</h3>
    <hr>
    <div class="stats">
        <div class="card"><div class="num"><?= (int)$counts['new'] ?></div>Uut registreerumist</div>
        <div class="card"><div class="num"><?= (int)$counts['confirmed'] ?></div>Kinnitatud</div>
        <div class="card"><div class="num"><?= (int)$counts['cancelled'] ?></div>Tühistatud</div>
    </div>
    <p>
        <a href="bookingsAdmin" class="btn">Registreerumised</a>
        <a href="courseAdmin" class="btn btn-outline">Kursused</a>
        <a href="courseAdd" class="btn btn-outline">Lisa kursus</a>
    </p>
</article>
<?php $content = ob_get_clean(); ?>
<?php include "templates/layout.php"; ?>
