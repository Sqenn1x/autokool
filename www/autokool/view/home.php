<section class="hero">
    <div class="hero-text">
        <h1>Juhiluba kiirelt ja turvaliselt</h1>
        <p>Kogenud instruktorid, kaasaegsed autod ja paindlik graafik. Alusta oma teed juhiloani juba sel nädalal.</p>
        <a class="btn" href="<?= url('bookingForm') ?>">Registreeru kursusele</a>
        <a class="btn btn-outline" href="<?= url('courses') ?>">Vaata kursusi</a>
    </div>
    <img class="hero-img" src="<?= url('images/hero.svg') ?>" alt="Autokooli õppeauto teel">
</section>

<section class="features">
    <div class="card"><h3>🚗 Kaasaegsed autod</h3><p>Manuaal- ja automaatkäigukastiga õppeautod.</p></div>
    <div class="card"><h3>📅 Paindlik graafik</h3><p>Sõidutunnid sulle sobival ajal, ka õhtuti ja nädalavahetustel.</p></div>
    <div class="card"><h3>✅ Kõrge läbimus</h3><p>Süstemaatiline eksamiettevalmistus aitab sooritada eksami esimese korraga.</p></div>
</section>

<section>
    <h2>Populaarsed kursused</h2>
    <div class="grid">
        <?php foreach ($courses as $c): ?>
            <article class="card">
                <span class="tag"><?= e($c['category']) ?></span>
                <h3><?= e($c['title']) ?></h3>
                <p><?= e(mb_strimwidth($c['description'], 0, 110, '…')) ?></p>
                <p class="price"><?= money($c['price']) ?></p>
                <a class="btn btn-small" href="<?= url('course') . '?id=' . (int)$c['id'] ?>">Loe lähemalt</a>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section>
    <h2>Meie instruktorid</h2>
    <div class="grid">
        <?php foreach ($instructors as $i): ?>
            <article class="card">
                <h3><?= e($i['name']) ?></h3>
                <p class="muted"><?= (int)$i['experience_years'] ?> aastat kogemust · <?= e($i['car']) ?></p>
                <p><?= e($i['bio']) ?></p>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section>
    <h2>Kuidas see käib?</h2>
    <ol class="steps">
        <li><strong>Registreeru</strong> kursusele veebis.</li>
        <li><strong>Teooria</strong> õppimine klassis ja e-õppes.</li>
        <li><strong>Sõidutunnid</strong> instruktoriga.</li>
        <li><strong>Eksam</strong> ja juhiluba.</li>
    </ol>
</section>
