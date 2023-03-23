<?php

header('Access-Control-Allow-Origin: *');

ini_set("display_errors", 1);

require_once 'func.php';

require __DIR__ . '/autoload.php';

use base\App;

$db = require './config/db.php';
$mailer  = require './config/mailer.php';

$config = array_merge($db, $mailer);

// Запустить приложение
App::create($config)->run();