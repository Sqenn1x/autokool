<?php
session_start();
$GLOBALS['config'] = require __DIR__ . '/../config.php';
require_once __DIR__ . '/../inc/helpers.php';
require_once __DIR__ . '/../inc/database.php';

include_once __DIR__ . '/modelAdmin/modelAdmin.php';
include_once __DIR__ . '/modelAdmin/modelAdminBooking.php';
include_once __DIR__ . '/modelAdmin/modelAdminCourse.php';

include_once __DIR__ . '/controllerAdmin/controllerAdmin.php';
include_once __DIR__ . '/controllerAdmin/controllerAdminBooking.php';
include_once __DIR__ . '/controllerAdmin/controllerAdminCourse.php';

include __DIR__ . '/routeAdmin/routingAdmin.php'; //!!!!
