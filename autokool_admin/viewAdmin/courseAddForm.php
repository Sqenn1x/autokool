<?php ob_start(); ?>

<h2>Kursuse lisamine</h2>
<?php
if (isset($test)) {
    if ($test == true) {
        ?>
        <div class="alert alert-ok"><strong>Kursus lisatud. </strong><a href="courseAdmin">Kursuste loend</a></div>
        <?php
    } else {
        ?>
        <div class="alert alert-err"><strong>Lisamine ebaõnnestus!</strong> Kontrollige väljad (hind peab olema üle 0). <a href="courseAdmin">Kursuste loend</a></div>
        <?php
    }
} else {
    ?>
    <form method="POST" action="courseAddResult">
        <?= csrf_field() ?>
        <table class="table">
            <tr><td>Kategooria</td><td><input type="text" name="category" maxlength="20" value="B" required></td></tr>
            <tr><td>Pealkiri</td><td><input type="text" name="title" maxlength="150" required></td></tr>
            <tr><td>Kirjeldus</td><td><textarea rows="5" name="description" required></textarea></td></tr>
            <tr><td>Hind (€)</td><td><input type="number" name="price" step="0.01" min="0.01" required></td></tr>
            <tr><td>Kestus (nädalat)</td><td><input type="number" name="duration_weeks" min="1" value="8"></td></tr>
            <tr><td>Teooria tunde</td><td><input type="number" name="theory_hours" min="0" value="28"></td></tr>
            <tr><td>Sõidutunde</td><td><input type="number" name="driving_hours" min="0" value="30"></td></tr>
            <tr><td>Aktiivne</td><td><input type="checkbox" name="active" value="1" checked style="width:auto"> nähtav saidil</td></tr>
            <tr>
                <td colspan="2">
                    <button type="submit" class="btn" name="save">Salvesta</button>
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
