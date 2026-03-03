<?php
$servername = getenv("DB_HOST") ?: $_ENV['DB_HOST'] ?: $_SERVER['DB_HOST'] ?? '';
$username   = getenv("DB_USER") ?: $_ENV['DB_USER'] ?: $_SERVER['DB_USER'] ?? '';
$password   = getenv("DB_PASS") ?: $_ENV['DB_PASS'] ?: $_SERVER['DB_PASS'] ?? '';
$database   = getenv("DB_NAME") ?: $_ENV['DB_NAME'] ?: $_SERVER['DB_NAME'] ?? '';

var_dump(getenv("DB_HOST"), $_ENV['DB_HOST'] ?? 'not in ENV', $_SERVER['DB_HOST'] ?? 'not in SERVER');