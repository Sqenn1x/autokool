<?php
$courseImages = ['A' => 'images/course-motorcycle.jpg', 'B' => 'images/hero-car.jpg', 'C' => 'images/course-truck.jpg'];
$category = strtoupper(substr($course['category'] ?? 'B', 0, 1));
$durationWeeks = (int)($course['duration_weeks'] ?? 0);
$theoryHours = (int)($course['theory_hours'] ?? 0);
$drivingHours = (int)($course['driving_hours'] ?? 0);
$categoryDetails = [
    'A' => t('Ohutu mootorrattasõidu põhioskused ja liiklusolukordade harjutamine.', 'Основы безопасного управления мотоциклом и практика в дорожных ситуациях.'),
    'B' => t('Sõiduki käsitsemine, manöövrid ja liiklemine linnas.', 'Управление автомобилем, манёвры и движение в городе.'),
    'C' => t('Täiendõpe vastavalt kursuse kirjeldusele ja õppe-eesmärkidele.', 'Дополнительное обучение по описанию курса и его учебным целям.'),
];
$categoryDetail = $categoryDetails[$category] ?? $categoryDetails['B'];
$included = [
    t('Instruktori juhendamine ja tagasiside õppe käigus.', 'Инструктор сопровождает обучение и даёт обратную связь.'),
    $categoryDetail,
    t('Ettevalmistus kursuse eesmärkide saavutamiseks.', 'Подготовка к достижению целей курса.'),
];
?>

<section class="course-detail">
    <a class="course-back-link" href="<?= url('courses') ?>">← <?= e(t('Kõik kursused', 'Все курсы')) ?></a>

    <div class="course-detail-hero">
        <div class="course-detail-image">
            <img
                src="<?= url($courseImages[$category] ?? $courseImages['B']) ?>"
                alt="<?= e($course['title']) ?>"
            >
            <span class="course-detail-image-label"><?= e(t('KATEGOORIA', 'КАТЕГОРИЯ')) ?> <?= e($course['category']) ?></span>
        </div>

        <div class="course-detail-intro">
            <span class="sub-caption"><?= e(t('SINU JÄRGMINE SAMM', 'ТВОЙ СЛЕДУЮЩИЙ ШАГ')) ?></span>
            <h1><?= e($course['title']) ?></h1>
            <p class="course-description"><?= nl2br(e($course['description'] ?? '')) ?></p>
            <div class="course-facts">
                <div class="course-fact">
                    <span><?= e(t('Kestus', 'Длительность')) ?></span>
                    <strong><?= $durationWeeks > 0 ? e(sprintf(t('%s nädalat', '%s недель'), $durationWeeks)) : '—' ?></strong>
                </div>
                <div class="course-fact">
                    <span><?= e(t('Teooria', 'Теория')) ?></span>
                    <strong><?= $theoryHours > 0 ? e(sprintf(t('%s tundi', '%s часов'), $theoryHours)) : '—' ?></strong>
                </div>
                <div class="course-fact">
                    <span><?= e(t('Sõidutunnid', 'Вождение')) ?></span>
                    <strong><?= $drivingHours > 0 ? e(sprintf(t('%s tundi', '%s часов'), $drivingHours)) : '—' ?></strong>
                </div>
            </div>
        </div>

        <aside class="course-price-card">
            <span><?= e(t('Kursuse hind', 'Стоимость курса')) ?></span>
            <strong class="course-detail-price"><?= money($course['price']) ?></strong>
            <p><?= e(t('Küsi enne registreerumist üle, kas sinu valitud kursusega kaasneb lisatasusid.', 'Перед записью уточните, предусмотрены ли дополнительные платежи для выбранного курса.')) ?></p>
            <a class="btn btn-full" href="<?= url('bookingForm') ?>?course=<?= (int)$course['id'] ?>">
                <?= e(t('Registreeru kursusele', 'Записаться на курс')) ?> ↗
            </a>
        </aside>
    </div>

    <div class="course-detail-content">
        <section class="course-info-card">
            <span class="sub-caption"><?= e(t('KURSUSEST LÄHEMALT', 'ПОДРОБНЕЕ О КУРСЕ')) ?></span>
            <h2><?= e(t('Mida kursus sisaldab?', 'Что входит в обучение?')) ?></h2>
            <ul class="course-included-list">
                <?php foreach ($included as $item): ?>
                    <li><?= e($item) ?></li>
                <?php endforeach; ?>
            </ul>
            <p class="course-price-note"><?= e(t('Õppematerjalide ja võimalike riigilõivude või muude lisatasude sisaldus ei ole kursuse kirjelduses täpsustatud. Küsi täpne info enne registreerumist.', 'Описание курса не уточняет, включены ли учебные материалы, государственные пошлины и другие возможные доплаты. Уточните точный состав стоимости перед записью.')) ?></p>
        </section>

        <aside class="course-info-card course-description-card">
            <span class="course-info-icon" aria-hidden="true">✓</span>
            <h2><?= e(t('Selge plaan õppimiseks', 'Понятный план обучения')) ?></h2>
            <p><?= e(t('Kursuse maht ja kestus on siin eraldi välja toodud. Instruktor aitab õpitut praktikas rakendada ja annab tagasisidet kogu õppe vältel.', 'Объём и длительность курса указаны отдельно. Инструктор поможет применить знания на практике и будет давать обратную связь в процессе обучения.')) ?></p>
            <a class="btn btn-outline btn-full" href="<?= url('contact') ?>"><?= e(t('Küsi kursuse kohta', 'Задать вопрос о курсе')) ?></a>
        </aside>
    </div>
</section>
