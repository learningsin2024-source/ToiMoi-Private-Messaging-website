<?php 

require 'dbconnect.php';
session_start();




if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM invitations WHERE token=? AND status='pending'");
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($inv = mysqli_fetch_assoc($result)) {
        $sender_id = $inv['sender_id'];
        $receiver_email = $inv['receiver_email'];

        $stm1 = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stm1, 's', $receiver_email);
        mysqli_stmt_execute($stm1);
        $result = mysqli_stmt_get_result($stm1);

        if ($row = mysqli_fetch_assoc($result)) {
            $receiver_id = $row['id'];

            // Create connection
            $stmt3 = mysqli_prepare($conn, "INSERT INTO connections (user1_id, user2_id) VALUES (?, ?)");
            mysqli_stmt_bind_param($stmt3, "ii", $sender_id, $receiver_id);
            mysqli_stmt_execute($stmt3);

            // Mark invitation accepted
            $stmt4 = mysqli_prepare($conn, "UPDATE invitations SET status='accepted' WHERE id=?");
            mysqli_stmt_bind_param($stmt4, "i", $inv['sender']);
            mysqli_stmt_execute($stmt4);

            
            header("Location: chat.php");
            exit;
        } else {
            // user not registered
            header("Location: signup.php?email=$receiver_email&token=$token");
            exit();
        }
    } else {
        echo "Invalid or expired token.";
    }
} else {
    echo "Missing invitation token";
}
