<?php
$servername = getenv("DB_HOST") ?: $_ENV['DB_HOST'] ?? '';
$username   = getenv("DB_USER") ?: $_ENV['DB_USER'] ?? '';
$password   = getenv("DB_PASS") ?: $_ENV['DB_PASS'] ?? '';
$database   = getenv("DB_NAME") ?: $_ENV['DB_NAME'] ?? '';
$port       = (int)(getenv("DB_PORT") ?: $_ENV['DB_PORT'] ?? 3306);

$conn = mysqli_connect($servername, $username, $password, $database, $port);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error() . " Error code: " . mysqli_connect_errno());
}
?>