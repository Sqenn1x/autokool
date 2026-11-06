<h1>Registreeru kursusele</h1>

<?php if ($errors): ?>
    <div class="alert alert-err">
        <ul>
            <?php foreach ($errors as $er): ?><li><?= e($er) ?></li><?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="<?= url('bookingAnswer') ?>" class="form card">
    <?= csrf_field() ?>
    <label>Kursus
        <select name="course_id" required>
            <option value="">— vali kursus —</option>
            <?php foreach ($courses as $c): ?>
                <option value="<?= (int)$c['id'] ?>" <?= (int)$old['course_id'] === (int)$c['id'] ? 'selected' : '' ?>>
                    <?= e($c['title']) ?> (<?= money($c['price']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </label>
    <label>Nimi
        <input type="text" name="name" value="<?= e($old['name']) ?>" required maxlength="100">
    </label>
    <label>E-post
        <input type="email" name="email" value="<?= e($old['email']) ?>" required maxlength="150">
    </label>
    <label>Telefon
        <input type="tel" name="phone" value="<?= e($old['phone']) ?>" required placeholder="+372 5555 1234">
    </label>
    <label>Sõnum (valikuline)
        <textarea name="message" rows="4" maxlength="1000"><?= e($old['message']) ?></textarea>
    </label>
    <button class="btn" type="submit">Saada registreerumine</button>
</form>
