<?php
session_start();
include '../config/config.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT username, password FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode($user); // Return user data as JSON
    } else {
        echo json_encode(['username' => '', 'password' => '']); // No user found
    }
} else {
    echo json_encode(['username' => '', 'password' => '']); // No session
}
?>
