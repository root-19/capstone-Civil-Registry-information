<?php
session_start();
include '../config/config.php'; // Include your database connection file

// Get the posted data
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['username']) && isset($data['password'])) {
    $username = $data['username'];
    $password = $data['password']; // Hash the password

    // Insert the new user into the database
    $query = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'User added successfully.']);
    } else {
        echo json_encode(['message' => 'Error adding user.']);
    }
} else {
    echo json_encode(['message' => 'Invalid data.']);
}
?>
