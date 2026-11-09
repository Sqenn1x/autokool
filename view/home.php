<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-text">
        <span class="sub-caption">■ <?= e(t('SINU TEE JUHILOANI', 'ТВОЙ ПУТЬ К ВОДИТЕЛЬСКИМ ПРАВАМ')) ?></span>
        <h1><?= e(t('Juhiluba kiirelt ja turvaliselt.', 'Получите права быстро и безопасно.')) ?></h1>
        <p><?= e(t('Kogenud instruktorid, kaasaegsed autod ja paindlik graafik. Alusta oma teed juhiloani juba sel nädalal.', 'Опытные инструкторы, современные автомобили и гибкий график. Начните путь к водительским правам уже на этой неделе.')) ?></p>
        <div class="hero-btns">
            <a href="<?= url('bookingForm') ?>" class="btn"><?= e(t('Registreeru kursusele', 'Записаться на курс')) ?> ↗</a>
            <a href="<?= url('courses') ?>" class="btn btn-outline"><?= e(t('Vaata kursusi', 'Посмотреть курсы')) ?></a>
        </div>
        <div class="hero-meta">
            <span><?= e(t('A- ja B-kategooria', 'Категории A и B')) ?></span> • <span><?= e(t('Manuaal ja automaat', 'Механика и автомат')) ?></span>
        </div>
    </div>
    <div class="hero-img-wrap">
        <span class="badge-top">⚡ <?= e(t('ÕPIME LIIKUMA.', 'УЧИМСЯ ДВИГАТЬСЯ.')) ?></span>
        <img src="<?= url('images/hero-car.jpg') ?>" alt="<?= e(t('Autokool Tallinn', 'Автошкола в Таллине')) ?>" class="hero-img">
        <div class="badge-bottom">
            <span class="icon">🚘</span>
            <div>
                <strong><?= e(t('Kindlus igal kilomeetril.', 'Уверенность на каждом километре.')) ?></strong>
                <small><?= e(t('Esimesest sõidutunnist iseseisva sõiduni', 'От первого урока вождения до самостоятельной поездки')) ?></small>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="features">
    <div class="feature-card">
        <div class="feature-icon">🚘</div>
        <h3><?= e(t('Kaasaegsed autod', 'Современные автомобили')) ?></h3>
        <p><?= e(t('Manuaal- ja automaatkäigukastiga õppeautod.', 'Учебные автомобили с механической и автоматической коробкой передач.')) ?></p>
    </div>
    <div class="feature-card">
        <div class="feature-icon">📅</div>
        <h3><?= e(t('Paindlik graafik', 'Гибкий график')) ?></h3>
        <p><?= e(t('Sõidutunnid sulle sobival ajal, ka õhtuti ja nädalavahetustel.', 'Занятия в удобное время, в том числе по вечерам и выходным.')) ?></p>
    </div>
    <div class="feature-card">
        <div class="feature-icon">🛡️</div>
        <h3><?= e(t('Põhjalik eksamiettevalmistus', 'Тщательная подготовка к экзамену')) ?></h3>
        <p><?= e(t('Süstemaatiline ettevalmistus aitab sul eksamile minna kindlama tundega.', 'Систематическая подготовка поможет увереннее сдать экзамен.')) ?></p>
    </div>
</section>

<!-- COURSES GRID -->
<section class="courses-section">
    <div class="section-header">
        <div>
            <span class="sub-caption">■ <?= e(t('KURSUSED JA HINNAD', 'КУРСЫ И ЦЕНЫ')) ?></span>
            <h2><?= t('Sinu eesmärk.<br>Sulle sobiv kursus.', 'Твоя цель.<br>Подходящий курс.') ?></h2>
        </div>
        <p class="section-desc"><?= e(t('Esimene juhiluba või uus kategooria? Võrdle võimalusi ja vali, millega oma teekonda alustada.', 'Первые права или новая категория? Сравните варианты и выберите, с чего начать.')) ?></p>
    </div>

    <?php $courseImages = ['A' => 'images/course-motorcycle.jpg', 'B' => 'images/hero-car.jpg', 'C' => 'images/course-truck.jpg']; ?>
    <div class="grid">
        <?php foreach ($courses as $index => $c): ?>
            <?php $isFeatured = ($index === 1); ?>
            <article class="card <?= $isFeatured ? 'featured' : '' ?>">
                <?php $category = strtoupper(substr($c['category'] ?? 'B', 0, 1)); ?>
                <img
                    src="<?= url($courseImages[$category] ?? $courseImages['B']) ?>"
                    alt="<?= e($c['title']) ?>"
                    class="course-image"
                    loading="lazy"
                >
                <div class="card-head">
                    <span class="category-letter"><?= e(substr($c['category'] ?? 'B', 0, 1)) ?></span>
                    <span class="badge-sm <?= $isFeatured ? 'badge-white' : '' ?>">
                        <?= e($isFeatured ? t('ALUSTA SIIT', 'НАЧНИТЕ ЗДЕСЬ') : t('JUHIKOOLITUS', 'ОБУЧЕНИЕ ВОЖДЕНИЮ')) ?>
                    </span>
                </div>
                <h3><?= e($c['title']) ?></h3>
                <p><?= e(mb_strimwidth($c['description'] ?? '', 0, 110, '…')) ?></p>
                <ul class="course-features">
                    <li><?= e(t('Teooriaõpe', 'Теоретические занятия')) ?> (<?= (int)($c['theory_hours'] ?? 28) ?>h)</li>
                    <li><?= e(t('Praktilised sõidutunnid', 'Практические занятия')) ?> (<?= (int)($c['driving_hours'] ?? 30) ?>h)</li>
                    <li><?= e(t('Ettevalmistus eksamiks', 'Подготовка к экзамену')) ?></li>
                </ul>
                <div class="price"><?= money($c['price']) ?> <small>/ <?= e(t('kursus', 'курс')) ?></small></div>
                <a href="<?= url('bookingForm') ?>?course=<?= (int)$c['id'] ?>" class="btn <?= $isFeatured ? 'btn-white' : 'btn-outline' ?> btn-full">
                    <?= e(t('Loe lähemalt', 'Подробнее')) ?> ↗
                </a>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<!-- BLUE STEPS BANNER -->
<section class="blue-steps-banner">
    <div class="steps-content">
        <span class="sub-caption text-white">■ <?= e(t('SAMM-SAMMULT JUHILOANI', 'ШАГ ЗА ШАГОМ К ПРАВАМ')) ?></span>
        <h2><?= t('Hea juht ei sünni.<br>Ta õpib.', 'Хорошим водителем не рождаются.<br>Им становятся.') ?></h2>
        <div class="steps-list">
            <div class="step-item">
                <span class="step-num">01</span>
                <div>
                    <h4><?= e(t('Vali kursus ja registreeru', 'Выберите курс и запишитесь')) ?></h4>
                    <p><?= e(t('Leia sobiv kategooria ning saada oma registreerimissoov.', 'Выберите подходящую категорию и отправьте заявку.')) ?></p>
                </div>
            </div>
            <div class="step-item">
                <span class="step-num">02</span>
                <div>
                    <h4><?= e(t('Õpi teooriat, harjuta sõitu', 'Изучайте теорию и практикуйтесь')) ?></h4>
                    <p><?= e(t('Liiklusreeglid ja praktilised sõidutunnid toetavad teineteist.', 'Изучение правил дорожного движения дополняет практические занятия.')) ?></p>
                </div>
            </div>
            <div class="step-item">
                <span class="step-num">03</span>
                <div>
                    <h4><?= e(t('Valmistu eksamiks', 'Подготовьтесь к экзамену')) ?></h4>
                    <p><?= e(t('Harjuta koos instruktoriga, et liikluses kindlamalt otsustada.', 'Практикуйтесь с инструктором, чтобы увереннее принимать решения на дороге.')) ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="steps-img-wrap">
        <img src="<?= url('images/inside-car.jpg') ?>" alt="<?= e(t('Õppesõit', 'Учебное вождение')) ?>" class="steps-img">
        <div class="yellow-badge">
            <span class="icon">🧭</span>
            <strong><?= e(t('Iga sõidutund viib sind edasi.', 'Каждое занятие приближает тебя к цели.')) ?></strong>
        </div>
    </div>
</section>

<!-- INSTRUCTORS -->
<section class="instructors-section">
    <div class="section-header">
        <div>
            <span class="sub-caption">■ <?= e(t('INIMESED SINU KÕRVAL', 'ТЕ, КТО РЯДОМ')) ?></span>
            <h2><?= t('Kogemus roolis.<br>Rahu sinu kõrval.', 'Опыт за рулём.<br>Спокойствие рядом.') ?></h2>
        </div>
        <p class="section-desc"><?= e(t('Tutvu meie instruktoritega ja leia oma kursuse ning õppeautoga sobiv juhendaja.', 'Познакомьтесь с инструкторами и выберите наставника для своего курса и учебного автомобиля.')) ?></p>
    </div>
    <div class="grid instructors-grid">
        <?php $instructorPhotos = ['images/instructor-1.jpg', 'images/instructor-2.jpg']; ?>
        <?php foreach ($instructors as $index => $inst): ?>
            <article class="instructor-card">
                <div class="instructor-img-wrap">
                    <span class="badge-tag"><?= e($inst['category_specialty'] ?? 'B - MANUAAL') ?></span>
                    <img src="<?= url(!empty($inst['photo_url']) ? $inst['photo_url'] : $instructorPhotos[$index % count($instructorPhotos)]) ?>" alt="<?= e($inst['name']) ?>" class="instructor-img" loading="lazy">
                </div>
                <div class="instructor-content">
                    <div class="inst-head">
                        <h3><?= e($inst['name']) ?></h3>
                        <span class="arrow-icon">↗</span>
                    </div>
                    <span class="exp-badge"><?= e(sprintf(t('%s aastat kogemust', '%s лет опыта'), $inst['experience_years'] ?? '10')) ?></span>
                    <p><?= e($inst['bio'] ?? t('Kogenud instruktor, kes valmistab õppijaid ette eksamiks.', 'Опытный инструктор, который подготовит учеников к экзамену.')) ?></p>
                    <small class="car-info">🚘 <?= e($inst['car_model'] ?? t('Õppeauto', 'Учебный автомобиль')) ?></small>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<!-- FAQ SECTION -->
<section class="faq-section">
    <div class="faq-grid">
        <div class="faq-intro">
            <span class="sub-caption">■ <?= e(t('HEA TEADA', 'ПОЛЕЗНО ЗНАТЬ')) ?></span>
            <h2><?= t('Küsimus?<br>Leiame vastuse.', 'Есть вопросы?<br>Мы поможем.') ?></h2>
            <p><?= e(t('Siit leiad vastused levinud küsimustele. Kui vajad abi valimisel, kirjuta meile.', 'Здесь собраны ответы на частые вопросы. Если нужна помощь с выбором, напишите нам.')) ?></p>
            <a href="<?= url('contact') ?>" class="btn-link"><?= e(t('Küsi meilt nõu', 'Получить консультацию')) ?> ↗</a>
        </div>
        <div class="faq-accordion">
            <details class="faq-item" open>
                <summary><?= e(t('Kas sõidutunde saab teha ka õhtuti?', 'Можно ли заниматься вождением по вечерам?')) ?> <span class="toggle-icon">−</span></summary>
                <p><?= e(t('Jah. Sõidutunnid toimuvad sulle sobival ajal, ka õhtuti ja nädalavahetustel. Sobiva sõiduaja saad kokku leppida oma instruktoriga.', 'Да. Занятия проходят в удобное время, в том числе по вечерам и выходным. Подходящее время можно согласовать с инструктором.')) ?></p>
            </details>
            <details class="faq-item">
                <summary><?= e(t('Kas mootorrattavarustus on hinna sees?', 'Включена ли экипировка для мотоцикла в стоимость?')) ?> <span class="toggle-icon">+</span></summary>
                <p><?= e(t('Jah, A-kategooria koolituse puhul on vajalik kaitsevarustus kursuse hinna sees.', 'Да, необходимая защитная экипировка входит в стоимость курса категории A.')) ?></p>
            </details>
            <details class="faq-item">
                <summary><?= e(t('Kas saan õppida automaatkäigukastiga autoga?', 'Можно ли учиться на автомобиле с автоматической коробкой передач?')) ?> <span class="toggle-icon">+</span></summary>
                <p><?= e(t('Jah, meil on eraldi B-automati kursus ning kaasaegsed automaatkäigukastiga õppeautod.', 'Да, у нас есть отдельный курс категории B на современных учебных автомобилях с автоматической коробкой передач.')) ?></p>
            </details>
            <details class="faq-item">
                <summary><?= e(t('Kuidas kursusele registreeruda?', 'Как записаться на курс?')) ?> <span class="toggle-icon">+</span></summary>
                <p><?= e(t('Vali sobiv kursus, täida registreerimisvorm või võta meiega ühendust e-posti teel.', 'Выберите курс, заполните форму записи или свяжитесь с нами по электронной почте.')) ?></p>
            </details>
        </div>
    </div>
</section>

<!-- BLUE CONTACT FORM BANNER -->
<section class="contact-banner">
    <div class="contact-banner-grid">
        <div class="contact-banner-text">
            <span class="sub-caption text-white">■ <?= e(t('SINU JÄRGMINE SAMM', 'ТВОЙ СЛЕДУЮЩИЙ ШАГ')) ?></span>
            <h2><?= e(t('Võta suund juhiloa poole.', 'Сделай шаг к водительским правам.')) ?></h2>
            <p><?= e(t('Vali kursus ja jäta oma kontakt. Kui sa veel ei tea, milline kursus sulle sobiks, aitame sul otsustada.', 'Выберите курс и оставьте контакты. Если пока не знаете, какой курс подойдёт, мы поможем определиться.')) ?></p>
            <div class="contact-tip">
                <span>💬</span> <?= e(t('Võid saata ka lihtsalt küsimuse.', 'Можно просто задать вопрос.')) ?>
            </div>
        </div>
        <div class="contact-form-card">
            <h3><?= e(t('Alustame sinu teekonda', 'Начнём твой путь')) ?></h3>
            <form action="<?= url('bookingForm') ?>" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label><?= e(t('Sinu nimi', 'Ваше имя')) ?> *</label>
                        <input type="text" name="name" placeholder="<?= e(t('Ees- ja perekonnanimi', 'Имя и фамилия')) ?>" required>
                    </div>
                    <div class="form-group">
                        <label><?= e(t('E-post', 'Электронная почта')) ?> *</label>
                        <input type="email" name="email" placeholder="nimi@epost.ee" required>
                    </div>
                </div>
                <div class="form-group">
                    <label><?= e(t('Milline kursus sind huvitab?', 'Какой курс вас интересует?')) ?></label>
                    <select name="course_id">
                        <option value=""><?= e(t('Vali kursus', 'Выберите курс')) ?></option>
                        <?php foreach ($courses as $c): ?>
                            <option value="<?= (int)$c['id'] ?>"><?= e($c['title']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label><?= e(t('Sinu küsimus või soov', 'Ваш вопрос или пожелание')) ?></label>
                    <textarea name="message" rows="3" placeholder="<?= e(t('Kirjuta meile...', 'Напишите нам...')) ?>"></textarea>
                </div>
                <div class="form-checkbox">
                    <input type="checkbox" id="agree" required>
                    <label for="agree"><?= e(t('Nõustun oma andmete kasutamisega päringule vastamiseks.', 'Я согласен на обработку данных для ответа на запрос.')) ?></label>
                </div>
                <button type="submit" class="btn btn-full"><?= e(t('Saada soov', 'Отправить заявку')) ?> ↗</button>
            </form>
        </div>
    </div>
</section>