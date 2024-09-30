<?php
if (!isset($_SESSION['id'])) {
   
}
function ValidateLogin($username, $password) {
    global $conn;

    // Validate user credentials
    $sql = "SELECT id, username FROM users WHERE username = ? AND password = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        // If user is found, log the login time
        if ($user) {
            $user_id = $user['id'];
            LogLoginTime($user_id);
        }

        return $user;
    } else {
        return null;
    }
}

// Function to log the login time
function LogLoginTime($user_id) {
    global $conn;

    $sql = "INSERT INTO login_logs (user_id) VALUES (?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();
    }
}

?>
