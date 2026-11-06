<?php ob_start() ?>

<h2>Kursused</h2>

<div style="margin:20px 0;">
    <a class="btn" href="courseAdd" role="button">Lisa kursus</a>
</div>

<div class="scroll-x">
    <table class="table">
        <tr>
            <th width="8%">ID</th>
            <th width="60%">Kursus</th>
            <th width="12%">Aktiivne</th>
            <th width="20%"></th>
        </tr>
        <?php foreach ($arr as $row): ?>
            <tr>
                <td><?= (int)$row['id'] ?></td>
                <td>
                    <b>Pealkiri:</b> <?= e($row['title']) ?><br>
                    <b>Kategooria:</b> <i><?= e($row['category']) ?></i> ·
                    <b>Hind:</b> <?= money($row['price']) ?>
                </td>
                <td><?= $row['active'] ? 'Jah' : 'Ei' ?></td>
                <td>
                    <a href="courseEdit?id=<?= (int)$row['id'] ?>">Muuda</a>
                    <a href="courseDel?id=<?= (int)$row['id'] ?>">Kustuta</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php $content = ob_get_clean(); ?>

<?php include "templates/layout.php"; ?>
