<?php

header('Access-Control-Allow-Origin: *');

ini_set("display_errors", 1);

require_once 'func.php';

require_once __DIR__ . '/autoload.php';

$main = require './config/main.php';
$db = require './config/db.php';
$mailer  = require './config/mailer.php';

$config = array_merge($main, $db, $mailer);

// Запустить приложение
\base\App::create($config)->run();
