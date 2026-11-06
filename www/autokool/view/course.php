<p><a href="<?= url('courses') ?>">← Kõik kursused</a></p>
<article class="card detail">
    <span class="tag"><?= e($course['category']) ?></span>
    <h1><?= e($course['title']) ?></h1>
    <p><?= nl2br(e($course['description'])) ?></p>
    <table class="table">
        <tr><th>Kestus</th><td><?= (int)$course['duration_weeks'] ?> nädalat</td></tr>
        <tr><th>Teooria</th><td><?= (int)$course['theory_hours'] ?> tundi</td></tr>
        <tr><th>Sõidutunnid</th><td><?= (int)$course['driving_hours'] ?> tundi</td></tr>
        <tr><th>Hind</th><td class="price"><?= money($course['price']) ?></td></tr>
    </table>
    <a class="btn" href="<?= url('bookingForm') ?>?course=<?= (int)$course['id'] ?>">Registreeru sellele kursusele</a>
</article>
