<?php ob_start(); ?>
<h2>404 viga</h2>
<article>
    <h3>404 viga – mis see on?</h3>
    <p>Küsitud aadressil lehte ei leitud.</p>
    <a class="btn" href="./">Halduse algusesse</a>
</article>
<?php $content = ob_get_clean(); ?>

<?php include "templates/layout.php"; ?>
