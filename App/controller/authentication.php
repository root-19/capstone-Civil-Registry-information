<?php

function ValidateLogin($username, $password) {
    global $conn;
    $sql = "SELECT id, username FROM users WHERE username = ? AND password = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user;
    } else {
        return null;
    }
}