<?php ob_start() ?>

<h2>Registreerumised</h2>

<div class="stats">
    <?php foreach ($labels as $k => $l): ?>
        <div class="card"><div class="num"><?= (int)$counts[$k] ?></div><?= e($l) ?></div>
    <?php endforeach; ?>
</div>

<div class="filters">
    <a class="chip <?= !$filter ? 'active' : '' ?>" href="bookingsAdmin">Kõik</a>
    <?php foreach ($labels as $k => $l): ?>
        <a class="chip <?= $filter === $k ? 'active' : '' ?>" href="bookingsAdmin?status=<?= e($k) ?>"><?= e($l) ?></a>
    <?php endforeach; ?>
</div>

<div class="scroll-x">
    <table class="table">
        <tr>
            <th width="5%">ID</th>
            <th width="55%">Registreerumine</th>
            <th width="12%">Staatus</th>
            <th width="28%"></th>
        </tr>
        <?php foreach ($arr as $row): ?>
            <tr>
                <td><?= (int)$row['id'] ?></td>
                <td>
                    <b>Kursus:</b> <?= e($row['course_title'] ?? '—') ?><br>
                    <b>Nimi:</b> <?= e($row['name']) ?><br>
                    <b>Kontakt:</b> <?= e($row['email']) ?>, <?= e($row['phone']) ?><br>
                    <?php if ($row['message']): ?><b>Sõnum:</b> <?= nl2br(e($row['message'])) ?><br><?php endif; ?>
                    <i class="muted"><?= e($row['created_at']) ?></i>
                </td>
                <td class="status-<?= e($row['status']) ?>"><?= e($labels[$row['status']]) ?></td>
                <td>
                    <form method="POST" action="bookingStatus?id=<?= (int)$row['id'] ?>" class="inline">
                        <?= csrf_field() ?>
                        <button class="btn btn-small" name="status" value="confirmed">Kinnita</button>
                        <button class="btn btn-small btn-outline" name="status" value="cancelled">Tühista</button>
                    </form>
                    <a href="bookingDel?id=<?= (int)$row['id'] ?>">Kustuta</a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (!$arr): ?><tr><td colspan="4">Registreerumisi pole.</td></tr><?php endif; ?>
    </table>
</div>
<?php $content = ob_get_clean(); ?>

<?php include "templates/layout.php"; ?>
