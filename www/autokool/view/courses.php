<h1><?= e(t('Kursused', 'Курсы')) ?></h1>
<div class="filters">
    <a class="chip <?= !$current ? 'active' : '' ?>" href="<?= url('courses') ?>"><?= e(t('Kõik', 'Все')) ?></a>
    <?php foreach ($categories as $cat): ?>
        <a class="chip <?= $current === $cat ? 'active' : '' ?>" href="<?= url('courses') ?>?category=<?= urlencode($cat) ?>"><?= e($cat) ?></a>
    <?php endforeach; ?>
</div>

<?php $courseImages = ['A' => 'images/course-motorcycle.jpg', 'B' => 'images/hero-car.jpg', 'C' => 'images/course-truck.jpg']; ?>
<?php if (!$courses): ?>
    <p><?= e(t('Selles kategoorias kursusi ei leitud.', 'В этой категории курсы не найдены.')) ?></p>
<?php endif; ?>

<div class="grid">
    <?php foreach ($courses as $c): ?>
        <article class="card">
            <?php $category = strtoupper(substr($c['category'] ?? 'B', 0, 1)); ?>
            <img
                src="<?= url($courseImages[$category] ?? $courseImages['B']) ?>"
                alt="<?= e($c['title']) ?>"
                class="course-image"
                loading="lazy"
            >
            <span class="tag"><?= e($c['category']) ?></span>
            <h3><?= e($c['title']) ?></h3>
            <p><?= e(mb_strimwidth($c['description'], 0, 120, '…')) ?></p>
            <p class="muted"><?= e(sprintf(t('%s nädalat · teooria %s h · sõit %s h', '%s недель · теория %s ч · вождение %s ч'), (int)$c['duration_weeks'], (int)$c['theory_hours'], (int)$c['driving_hours'])) ?></p>
            <p class="price"><?= money($c['price']) ?></p>
            <a class="btn btn-small" href="<?= url('course') . '?id=' . (int)$c['id'] ?>"><?= e(t('Loe lähemalt', 'Подробнее')) ?></a>
            <a class="btn btn-small btn-outline" href="<?= url('bookingForm') ?>?course=<?= (int)$c['id'] ?>"><?= e(t('Registreeru', 'Записаться')) ?></a>
        </article>
    <?php endforeach; ?>
</div>
