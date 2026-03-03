<?php
require_once __DIR__ . '/env.php';
loadEnv();

// temporary debug - remove after fixing
var_dump([
    'DB_HOST' => getenv('DB_HOST'),
    'DB_USER' => getenv('DB_USER'),
    'DB_NAME' => getenv('DB_NAME'),
]);
die();