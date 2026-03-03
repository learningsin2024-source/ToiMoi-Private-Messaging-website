<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

session_start();
require 'dbconnect.php';
require 'encryption.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit;
}

$user_id = $_SESSION['user_id'];
$toi_id = isset($_GET['toi_id']) ? (int)$_GET['toi_id'] : 0;

$sql = "SELECT * FROM messages 
        WHERE (sender_id=? AND receiver_id=?) OR (sender_id=? AND receiver_id=?) 
        ORDER BY created_at ASC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "iiii", $user_id, $toi_id, $toi_id, $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$messages = [];
while ($row = mysqli_fetch_assoc($result)) {
    $row['message'] = decrypt_message($row['message']);
    $messages[] = $row;
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
echo json_encode($messages);
?>
