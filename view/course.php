<p><a href="<?= url('courses') ?>">← <?= e(t('Kõik kursused', 'Все курсы')) ?></a></p>
<article class="card detail">
    <?php
    $courseImages = ['A' => 'images/course-motorcycle.jpg', 'B' => 'images/hero-car.jpg', 'C' => 'images/course-truck.jpg'];
    $category = strtoupper(substr($course['category'] ?? 'B', 0, 1));
    ?>
    <img
        src="<?= url($courseImages[$category] ?? $courseImages['B']) ?>"
        alt="<?= e($course['title']) ?>"
        class="course-image"
    >
    <span class="tag"><?= e($course['category']) ?></span>
    <h1><?= e($course['title']) ?></h1>
    <p><?= nl2br(e($course['description'])) ?></p>
    <table class="table">
        <tr><th><?= e(t('Kestus', 'Продолжительность')) ?></th><td><?= e(sprintf(t('%s nädalat', '%s недель'), (int)$course['duration_weeks'])) ?></td></tr>
        <tr><th><?= e(t('Teooria', 'Теория')) ?></th><td><?= e(sprintf(t('%s tundi', '%s часов'), (int)$course['theory_hours'])) ?></td></tr>
        <tr><th><?= e(t('Sõidutunnid', 'Занятия вождением')) ?></th><td><?= e(sprintf(t('%s tundi', '%s часов'), (int)$course['driving_hours'])) ?></td></tr>
        <tr><th><?= e(t('Hind', 'Цена')) ?></th><td class="price"><?= money($course['price']) ?></td></tr>
    </table>
    <a class="btn" href="<?= url('bookingForm') ?>?course=<?= (int)$course['id'] ?>"><?= e(t('Registreeru sellele kursusele', 'Записаться на этот курс')) ?></a>
</article>
