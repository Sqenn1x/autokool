<?php ob_start(); ?>

<h2>Kursuse muutmine</h2>
<?php
if (isset($test)) {
    if ($test == true) {
        ?>
        <div class="alert alert-ok"><strong>Kursus muudetud. </strong><a href="courseAdmin">Kursuste loend</a></div>
        <?php
    } else {
        ?>
        <div class="alert alert-err"><strong>Muutmine ebaõnnestus!</strong> Kontrollige väljad. <a href="courseAdmin">Kursuste loend</a></div>
        <?php
    }
} else {
    ?>
    <form method="POST" action="courseEditResult?id=<?= (int)$id ?>">
        <?= csrf_field() ?>
        <table class="table">
            <tr><td>Kategooria</td><td><input type="text" name="category" maxlength="20" value="<?= e($detail['category']) ?>" required></td></tr>
            <tr><td>Pealkiri</td><td><input type="text" name="title" maxlength="150" value="<?= e($detail['title']) ?>" required></td></tr>
            <tr><td>Kirjeldus</td><td><textarea rows="5" name="description" required><?= e($detail['description']) ?></textarea></td></tr>
            <tr><td>Hind (€)</td><td><input type="number" name="price" step="0.01" min="0.01" value="<?= e($detail['price']) ?>" required></td></tr>
            <tr><td>Kestus (nädalat)</td><td><input type="number" name="duration_weeks" min="1" value="<?= (int)$detail['duration_weeks'] ?>"></td></tr>
            <tr><td>Teooria tunde</td><td><input type="number" name="theory_hours" min="0" value="<?= (int)$detail['theory_hours'] ?>"></td></tr>
            <tr><td>Sõidutunde</td><td><input type="number" name="driving_hours" min="0" value="<?= (int)$detail['driving_hours'] ?>"></td></tr>
            <tr><td>Aktiivne</td><td><input type="checkbox" name="active" value="1" <?= $detail['active'] ? 'checked' : '' ?> style="width:auto"> nähtav saidil</td></tr>
            <tr>
                <td colspan="2">
                    <button type="submit" class="btn" name="save">Muuda</button>
                    <a href="courseAdmin" class="btn btn-outline">Tagasi loendisse</a>
                </td>
            </tr>
        </table>
    </form>
    <?php
}
?>
<?php $content = ob_get_clean(); ?>
<?php include "templates/layout.php"; ?>
