<?php
function db(): PDO
{
    static $pdo = null;
    if ($pdo) {
        return $pdo;
    }
    $c = $GLOBALS['config'];
    $opts = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    $dsn = sprintf('mysql:host=%s;port=%d;charset=%s', $c['host'], $c['port'], $c['charset']);
    $pdo = new PDO($dsn, $c['user'], $c['pass'], $opts);
    $pdo->exec(sprintf('CREATE DATABASE IF NOT EXISTS `%s` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci', $c['dbname']));
    $pdo->exec(sprintf('USE `%s`', $c['dbname']));
    install_schema($pdo);
    return $pdo;
}

function install_schema(PDO $pdo): void
{
    $pdo->exec('CREATE TABLE IF NOT EXISTS `courses` (
        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `category` VARCHAR(20) NOT NULL,
        `title` VARCHAR(150) NOT NULL,
        `description` TEXT NOT NULL,
        `price` DECIMAL(8,2) NOT NULL,
        `duration_weeks` INT NOT NULL DEFAULT 8,
        `theory_hours` INT NOT NULL DEFAULT 0,
        `driving_hours` INT NOT NULL DEFAULT 0,
        `active` TINYINT(1) NOT NULL DEFAULT 1,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

    $pdo->exec('CREATE TABLE IF NOT EXISTS `instructors` (
        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(100) NOT NULL,
        `experience_years` INT NOT NULL DEFAULT 1,
        `car` VARCHAR(100) NOT NULL,
        `bio` TEXT NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

    $pdo->exec("CREATE TABLE IF NOT EXISTS `bookings` (
        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `course_id` INT UNSIGNED NOT NULL,
        `name` VARCHAR(100) NOT NULL,
        `email` VARCHAR(150) NOT NULL,
        `phone` VARCHAR(40) NOT NULL,
        `message` TEXT NULL,
        `status` ENUM('new','confirmed','cancelled') NOT NULL DEFAULT 'new',
        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        KEY `course_id` (`course_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    $pdo->exec('CREATE TABLE IF NOT EXISTS `users` (
        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `username` VARCHAR(100) NOT NULL,
        `email` VARCHAR(150) NOT NULL,
        `password` VARCHAR(255) NOT NULL,
        `status` VARCHAR(20) NOT NULL DEFAULT \'admin\',
        PRIMARY KEY (`id`),
        UNIQUE KEY `email` (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

    if ((int)$pdo->query('SELECT COUNT(*) FROM `users`')->fetchColumn() === 0) {
        $c = $GLOBALS['config'];
        $pdo->prepare('INSERT INTO `users` (username,email,password,status) VALUES (?,?,?,?)')
            ->execute([$c['admin_name'], strtolower($c['admin_email']), password_hash($c['admin_pass'], PASSWORD_DEFAULT), 'admin']);
    }

    if ((int)$pdo->query('SELECT COUNT(*) FROM `courses`')->fetchColumn() === 0) {
        $st = $pdo->prepare('INSERT INTO `courses` (category,title,description,price,duration_weeks,theory_hours,driving_hours) VALUES (?,?,?,?,?,?,?)');
        $rows = [
            ['B', 'B-kategooria algajale', 'Täielik kursus algajale: teooria, sõidutunnid ja ettevalmistus eksamiks. Sobib, kui sul pole varem sõidukogemust.', 590, 10, 28, 30],
            ['B', 'B-kategooria intensiivkursus', 'Kiirendatud programm tihedama graafikuga. Teooria õhtuti, sõidutunnid kokkuleppel kuni 3 korda nädalas.', 690, 5, 28, 30],
            ['B', 'B-kategooria automaatkäigukastiga', 'Õpid sõitma automaatkäigukastiga autoga, mis teeb algusest peale liikluses orienteerumise lihtsamaks.', 650, 8, 28, 30],
            ['A', 'A-kategooria mootorratas', 'Mootorrattakursus koos suletud ala harjutustega ja liikluses sõiduga. Varustus on kursuse hinna sees.', 480, 6, 18, 16],
            ['Lisa', 'Libedasõidu kursus', 'Kohustuslik libedasõidu koolitus: auto käitumine libedal teel ja ohuolukordade lahendamine.', 90, 1, 2, 4],
            ['Lisa', 'Kordussõit eksami eel', 'Lisasõidutunnid enne eksamit. Hind on kahe 45-minutilise tunni eest.', 70, 1, 0, 2],
        ];
        foreach ($rows as $r) {
            $st->execute($r);
        }
    }

    if ((int)$pdo->query('SELECT COUNT(*) FROM `instructors`')->fetchColumn() === 0) {
        $st = $pdo->prepare('INSERT INTO `instructors` (name,experience_years,car,bio) VALUES (?,?,?,?)');
        $rows = [
            ['Marko Tamm', 14, 'Volkswagen Golf (manuaal)', 'Rahulik ja kannatlik instruktor, kes aitab ka kõige närvilisematel õppijatel enesekindlust leida.'],
            ['Liis Kask', 9, 'Toyota Yaris (automaat)', 'Spetsialiseerunud automaatkäigukastiga õppele ja linnaliiklusele.'],
            ['Andres Mägi', 18, 'Skoda Octavia (manuaal)', 'Kogenud instruktor, kes valmistab õppijaid ette eksamiks ja libedasõiduks.'],
            ['Kristiina Sepp', 7, 'Yamaha MT-07 (mootorratas)', 'Mootorrattakursuste juhendaja, ohutu sõidu ja õige tehnika eestkõneleja.'],
        ];
        foreach ($rows as $r) {
            $st->execute($r);
        }
    }
}
