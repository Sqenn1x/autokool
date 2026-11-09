<div class="instructors-page">
    <div class="container">
        <div class="section-header">
            <div>
                <span class="sub-caption">■ <?= e(t('MEIE INSTRUKTORID', 'НАШИ ИНСТРУКТОРЫ')) ?></span>
                <h2><?= t('Kogemus roolis.<br>Rahu sinu kõrval.', 'Опыт за рулём.<br>Спокойствие рядом.') ?></h2>
            </div>
            <p class="section-desc"><?= e(t('Tutvu meie kogenud instruktoritega, kes aitavad sul juhiloani jõuda rahulikult ja kindlalt.', 'Познакомьтесь с опытными инструкторами, которые помогут вам спокойно и уверенно получить водительские права.')) ?></p>
        </div>

        <?php if (empty($instructors)): ?>
            <p class="muted"><?= e(t('Hetkel instruktoreid ei leitud.', 'Инструкторы пока не найдены.')) ?></p>
        <?php else: ?>
            <?php $instructorPhotos = ['images/instructor-1.jpg', 'images/instructor-2.jpg']; ?>
            <div class="grid instructors-grid">
                <?php foreach ($instructors as $index => $i): ?>
                    <article class="instructor-card">
                        <div class="instructor-img-wrap">
                            <span class="badge-tag"><?= e($i['category'] ?? t('B-KATEGOORIA', 'КАТЕГОРИЯ B')) ?></span>
                            <img src="<?= url(!empty($i['photo_url']) ? $i['photo_url'] : $instructorPhotos[$index % count($instructorPhotos)]) ?>" alt="<?= e($i['name']) ?>" class="instructor-img" loading="lazy">
                        </div>
                        <div class="instructor-content">
                            <div class="inst-head">
                                <h3><?= e($i['name']) ?></h3>
                                <span class="arrow-icon">↗</span>
                            </div>
                            <span class="exp-badge"><?= e(sprintf(t('%s aastat kogemust', '%s лет опыта'), (int)$i['experience_years'])) ?></span>
                            <p><?= e($i['bio']) ?></p>
                            <div class="instructor-footer">
                                <span class="car-info">🚘 <?= e($i['car'] ?? t('Õppeauto', 'Учебный автомобиль')) ?></span>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>