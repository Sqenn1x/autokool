<div class="booking-page">
    <div class="booking-container">
        <div class="section-header center-text">
            <span class="sub-caption">■ <?= e(t('REGISTREERUMINE', 'ЗАПИСЬ НА КУРС')) ?></span>
            <h1><?= e(t('Registreeru kursusele', 'Запись на курс')) ?></h1>
            <p class="section-desc-center"><?= e(t('Täida allolev vorm ja me võtame sinuga ühendust.', 'Заполните форму, и мы свяжемся с вами.')) ?></p>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-err" style="margin-bottom: 24px; padding: 16px; background: #ffeeec; border: 1px solid #f5c6cb; border-radius: 12px; color: #9f3a38;">
                <ul style="margin: 0; padding-left: 20px;">
                    <?php foreach ($errors as $er): ?>
                        <li><?= e(t($er, [
                            'Palun vali kursus.' => 'Пожалуйста, выберите курс.',
                            'Palun sisesta oma nimi.' => 'Пожалуйста, введите имя.',
                            'E-posti aadress ei ole korrektne.' => 'Некорректный адрес электронной почты.',
                            'Telefoninumber ei ole korrektne.' => 'Некорректный номер телефона.',
                            'Sõnum on liiga pikk (kuni 1000 märki).' => 'Сообщение слишком длинное (не более 1000 символов).',
                            'Registreerumine ebaõnnestus, proovi hiljem uuesti.' => 'Не удалось отправить заявку. Попробуйте позже.',
                        ][$er] ?? $er)) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="booking-card">
            <form method="post" action="<?= url('bookingAnswer') ?>">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label><?= e(t('Vali kursus', 'Выберите курс')) ?> *</label>
                    <select name="course_id" required>
                        <option value="">— <?= e(t('vali kursus', 'выберите курс')) ?> —</option>
                        <?php foreach ($courses as $c): ?>
                            <option value="<?= (int)$c['id'] ?>" <?= isset($old['course_id']) && (int)$old['course_id'] === (int)$c['id'] ? 'selected' : '' ?>>
                                <?= e($c['title']) ?> (<?= money($c['price']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label><?= e(t('Sinu nimi', 'Ваше имя')) ?> *</label>
                        <input type="text" name="name" value="<?= e($old['name'] ?? '') ?>" required maxlength="100" placeholder="<?= e(t('Ees- ja perekonnanimi', 'Имя и фамилия')) ?>">
                    </div>
                    <div class="form-group">
                        <label><?= e(t('E-post', 'Электронная почта')) ?> *</label>
                        <input type="email" name="email" value="<?= e($old['email'] ?? '') ?>" required maxlength="150" placeholder="nimi@epost.ee">
                    </div>
                </div>

                <div class="form-group">
                    <label><?= e(t('Telefon', 'Телефон')) ?> *</label>
                    <input type="tel" name="phone" value="<?= e($old['phone'] ?? '') ?>" required placeholder="+372 5555 1234">
                </div>

                <div class="form-group">
                    <label><?= e(t('Sõnum (valikuline)', 'Сообщение (необязательно)')) ?></label>
                    <textarea name="message" rows="4" maxlength="1000" placeholder="<?= e(t('Kirjuta lisainfo või küsimus...', 'Добавьте информацию или задайте вопрос...')) ?>"><?= e($old['message'] ?? '') ?></textarea>
                </div>

                <div class="form-checkbox">
                    <input type="checkbox" id="terms" required>
                    <label for="terms"><?= e(t('Nõustun isikuandmete töötlemisega kursusele registreerumiseks.', 'Я согласен на обработку персональных данных для записи на курс.')) ?></label>
                </div>

                <button class="btn btn-full" type="submit"><?= e(t('Saada registreerumine', 'Отправить заявку')) ?> ↗</button>
            </form>
        </div>
    </div>
</div>