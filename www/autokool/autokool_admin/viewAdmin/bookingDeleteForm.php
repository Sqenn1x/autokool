<?php ob_start(); ?>

<h2>Registreerumise kustutamine</h2>
<?php
if (isset($test)) {
    if ($test == true) {
        ?>
        <div class="alert alert-ok"><strong>Kirje kustutatud. </strong><a href="bookingsAdmin">Registreerumiste loend</a></div>
        <?php
    } else {
        ?>
        <div class="alert alert-err"><strong>Kustutamine ebaõnnestus!</strong> <a href="bookingsAdmin">Registreerumiste loend</a></div>
        <?php
    }
} else {
    ?>
    <form method="POST" action="bookingDelResult?id=<?= (int)$id ?>">
        <?= csrf_field() ?>
        <table class="table">
            <tr><td>Kursus</td><td><?= e($detail['course_title'] ?? '—') ?></td></tr>
            <tr><td>Nimi</td><td><?= e($detail['name']) ?></td></tr>
            <tr><td>E-post</td><td><?= e($detail['email']) ?></td></tr>
            <tr><td>Telefon</td><td><?= e($detail['phone']) ?></td></tr>
            <tr><td>Sõnum</td><td><?= nl2br(e($detail['message'])) ?></td></tr>
            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-danger" name="save">Kustuta</button>
                    <a href="bookingsAdmin" class="btn btn-outline">Tagasi loendisse</a>
                </td>
            </tr>
        </table>
    </form>
    <?php
}
?>
<?php $content = ob_get_clean(); ?>
<?php include "templates/layout.php"; ?>
