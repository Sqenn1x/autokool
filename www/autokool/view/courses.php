<h1>Kursused</h1>
<div class="filters">
    <a class="chip <?= !$current ? 'active' : '' ?>" href="<?= url('courses') ?>">Kõik</a>
    <?php foreach ($categories as $cat): ?>
        <a class="chip <?= $current === $cat ? 'active' : '' ?>" href="<?= url('courses') ?>?category=<?= urlencode($cat) ?>"><?= e($cat) ?></a>
    <?php endforeach; ?>
</div>

<?php if (!$courses): ?>
    <p>Selles kategoorias kursusi ei leitud.</p>
<?php endif; ?>

<div class="grid">
    <?php foreach ($courses as $c): ?>
        <article class="card">
            <span class="tag"><?= e($c['category']) ?></span>
            <h3><?= e($c['title']) ?></h3>
            <p><?= e(mb_strimwidth($c['description'], 0, 120, '…')) ?></p>
            <p class="muted"><?= (int)$c['duration_weeks'] ?> nädalat · teooria <?= (int)$c['theory_hours'] ?> h · sõit <?= (int)$c['driving_hours'] ?> h</p>
            <p class="price"><?= money($c['price']) ?></p>
            <a class="btn btn-small" href="<?= url('course') . '?id=' . (int)$c['id'] ?>">Loe lähemalt</a>
            <a class="btn btn-small btn-outline" href="<?= url('bookingForm') ?>?course=<?= (int)$c['id'] ?>">Registreeru</a>
        </article>
    <?php endforeach; ?>
</div>
