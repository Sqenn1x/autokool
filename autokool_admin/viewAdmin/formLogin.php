<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Haldus – sisselogimine</title>
    <link href="../public/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <form class="form card detail" action="login" method="POST" style="margin-top:60px">
            <h3>Sisesta oma andmed</h3>
            <?= csrf_field() ?>
            <label>E-post <input type="email" name="email" placeholder="E-post" autofocus required></label>
            <label>Parool <input type="password" name="password" placeholder="Parool" required></label>
            <button class="btn" type="submit" name="btnLogin">Sisene</button>

            <p style="padding-top:10px;">
                <?php
                if (isset($_SESSION['errorString'])) {
                    echo '<span style="color:#c0392b">' . e($_SESSION['errorString']) . '</span>';
                    unset($_SESSION['errorString']);
                }
                ?>
            </p>
            <p><a href="../">Veebileht</a></p>
        </form>
    </div> <!-- /container -->
</body>
</html>
