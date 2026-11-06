<?php
session_start();

// Подключаем конфигурационный файл (убедитесь, что переменные хоста настроены на 'db')
$GLOBALS['config'] = require __DIR__ . '/config.php';

require_once __DIR__ . '/inc/database.php';

// Подключение моделей
include_once __DIR__ . '/model/Course.php';
include_once __DIR__ . '/model/Instructor.php';
include_once __DIR__ . '/model/Booking.php';

// Подключение главного контроллера
include_once __DIR__ . '/controller/Controller.php';

// Подключение роутера, который формирует переменную $response
include __DIR__ . '/route/routing.php';

// Выводим результат работы роутера (рендеринг страницы)
echo $response ?? '';