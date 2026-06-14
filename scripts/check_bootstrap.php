<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
echo is_object($app) ? 'APP_OK' : 'APP_FAIL';
