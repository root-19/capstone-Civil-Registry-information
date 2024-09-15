<?php
require_once(__DIR__ . '../config/config.php');
require_once(__DIR__ . '../controller/authentication.php');
session_start();

// If user already has an account
if (isset($_SESSION['user_id'])) {
    header("Location: ../views/user.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['username'];
    $password = $_POST['password'];
    
    $user = ValidateLogin($email, $password);
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['username'];
        
        // Redirect directly to the admin page
        header("Location: ../views/user.php");
        exit();
    } else {
        header("location: ../views/error/404.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
      .bg-custom {
        /* background-image: url('../App/'); */
        background-image: url('/assets/images/Screenshot_2024-09-13_064330.png');

        background-size: cover;
        background-position: center;
        background-color: aliceblue;
      } 
    </style>
</head>
<body class="bg-custom flex flex-col h-screen">
    <main class="flex-grow flex items-center justify-center">
        <div class="w-full max-w-sm bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-center mb-6">Civil Registry Information</h2>
            <form action="" method="post">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your Username"
                           class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your Password"
                           class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="flex items-center justify-center">
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
