<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

session_start();
require 'dbconnect.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['connected' => false]);
    exit;
}

$user_id = $_SESSION['user_id'];
$toi_id = isset($_GET['toi_id']) ? (int)$_GET['toi_id'] : 0;

$sql = "SELECT ID FROM connections 
        WHERE (user1_id=? AND user2_id=?) OR (user1_id=? AND user2_id=?) LIMIT 1";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "iiii", $user_id, $toi_id, $toi_id, $user_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

$connected = mysqli_stmt_num_rows($stmt) > 0;
mysqli_stmt_close($stmt);
mysqli_close($conn);

echo json_encode(['connected' => $connected]);
?>
