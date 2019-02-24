<?php

define('LARAVEL_START', microtime(true));

$app = require __DIR__.'/../bootstrap/app.php';

$app->run();
