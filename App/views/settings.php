<?php
session_start(); // Start the session at the top of the file
include "../model/header.php"; 
include "../config/config.php"; 
?>

<div class="container mx-auto p-4">
    <h2 class="text-xl font-semibold mb-4">Edit User Credentials</h2>
    <?php
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo "You must be logged in to view this page.";
        exit; // Exit if the user is not logged in
    }

    $user_id = $_SESSION['user_id']; // Retrieve the user ID from the session

    // Fetch current user data
    $stmt = $conn->prepare("SELECT username FROM users WHERE id = ?"); // Don't fetch the password for security
    $stmt->bind_param("i", $user_id); // Assuming user ID is an integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $current_username = $user['username'];
    } else {
        echo "User not found.";
        exit;
    }

    // Handle form submission for updating username and password
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $new_username = $_POST['username'];
        $new_password = $_POST['password'];

        // Update the user credentials with hashed password
        $new_password_hashed = password_hash($new_password, PASSWORD_BCRYPT);
        $update_stmt = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
        $update_stmt->bind_param("ssi", $new_username, $new_password_hashed, $user_id);
        
        if ($update_stmt->execute()) {
            echo "<div class='text-green-500'>Credentials updated successfully!</div>";
        } else {
            echo "<div class='text-red-500'>Error updating credentials. Please try again.</div>";
        }
        $update_stmt->close();
    }
    ?>

    <!-- Form for updating username and password -->
    <form method="POST" action="">
        <div class="mb-4">
            <label for="username" class="block text-gray-700">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($current_username); ?>" required class="border rounded-md py-2 px-3">
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700">New Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter new password" required class="border rounded-md py-2 px-3">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                Update Credentials
            </button>
        </div>
    </form>
</div>
