<?php ob_start(); ?>

<h2>Kursuse kustutamine</h2>
<?php
if (isset($test)) {
    if ($test == true) {
        ?>
        <div class="alert alert-ok"><strong>Kursus kustutatud. </strong><a href="courseAdmin">Kursuste loend</a></div>
        <?php
    } else {
        ?>
        <div class="alert alert-err"><strong>Kustutamine ebaõnnestus!</strong> Kursusel võib olla registreerumisi – märkige see muutmisvormis mitteaktiivseks. <a href="courseAdmin">Kursuste loend</a></div>
        <?php
    }
} else {
    ?>
    <form method="POST" action="courseDelResult?id=<?= (int)$id ?>">
        <?= csrf_field() ?>
        <table class="table">
            <tr><td>Kategooria</td><td><?= e($detail['category']) ?></td></tr>
            <tr><td>Pealkiri</td><td><?= e($detail['title']) ?></td></tr>
            <tr><td>Kirjeldus</td><td><?= nl2br(e($detail['description'])) ?></td></tr>
            <tr><td>Hind</td><td><?= money($detail['price']) ?></td></tr>
            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-danger" name="save">Kustuta</button>
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
