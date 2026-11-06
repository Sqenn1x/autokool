<h1>Instruktorid</h1>
<div class="grid">
    <?php foreach ($instructors as $i): ?>
        <article class="card">
            <h3><?= e($i['name']) ?></h3>
            <p class="muted"><?= (int)$i['experience_years'] ?> aastat kogemust</p>
            <p><strong>Õppeauto:</strong> <?= e($i['car']) ?></p>
            <p><?= e($i['bio']) ?></p>
        </article>
    <?php endforeach; ?>
</div>
