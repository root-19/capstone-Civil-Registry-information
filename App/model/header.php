<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IfYouHackMeYourGay</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Ensure dropdowns are hidden initially */
        .dropdown-menu {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <!-- Logo on Left -->
            <a href="#" class="flex items-center">
                <img src="../assets/images/Screenshot 2024-09-13 065403.png" alt="Logo" class="logo w-auto">
                <!-- <img src="../images/Screenshot 2024-09-13 065403.png" alt="Logo" class="logo w-auto"> -->

                <div class="ml-4 text-lg font-semibold">
                    Province of Camarines Sur <br>
                    Municipality of Nabua
                </div>
            </a>

            <!-- Right Side - Links, Search Bar, Event Notification, and Account Dropdown -->
            <div class="flex items-center space-x-6">
                <!-- Links -->
                <nav class="flex space-x-6">
                    <a href="../views/user.php" class="text-gray-600 hover:text-blue-500">Home</a>
                    
                    <!-- Services Dropdown (Click Toggle) -->
                    <div class="relative">
                        <button id="servicesToggle" class="text-gray-600 hover:text-blue-500 focus:outline-none flex items-center">
                            Services
                            <i class="ml-2 fa-solid fa-chevron-down"></i>
                        </button>
                        <div id="servicesDropdown" class="dropdown-menu absolute bg-white shadow-lg rounded-md mt-2 w-80">
                            <a href="../views/register-birth.php" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 flex items-center">
                                <i class="fa-solid fa-file-circle-plus mr-2"></i>
                                Registering and issue of Live Birth Certificate
                            </a>
                            <a href="../views/founding.php" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 flex items-center">
                                <i class="fa-solid fa-baby-carriage mr-2"></i>
                                Registering Foundling
                            </a>
                            <a href="../views/death-info.php" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 flex items-center">
                                <i class="fa-solid fa-skull-crossbones mr-2"></i>
                                Registering and issue of Death Certificate
                            </a>
                            <a href="../views/merriage.php" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 flex items-center">
                                <i class="fa-solid fa-ring mr-2"></i>
                                Registering and issue of Marriage Certificate
                            </a>
                        </div>
                    </div>
                </nav>

               <!-- Event Notification -->
<div class="relative inline-block text-left">
    <a href="#" id="event-notifications" class="relative text-gray-600 hover:text-blue-500">
        Event Notifications
    </a>
    <div id="dropdown" class="hidden absolute right-0 z-10 w-48 mt-2 bg-white rounded-md shadow-lg">
        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-menu">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Event 1: Community Clean-Up</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Event 2: Monthly Meeting</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Event 3: Health Fair</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Event 4: Sports Fest</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Event 5: Cultural Festival</a>
        </div>
    </div>
</div>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('event-notifications').addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default anchor behavior
                const dropdown = document.getElementById('dropdown');
                dropdown.classList.toggle('hidden'); // Toggle the visibility of the dropdown
            });
        });
    </script>

                <!-- Search Bar -->
                <div>
                    <input 
                        type="text" 
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300" 
                        placeholder="Search...">
                </div>

                <!-- Account Dropdown (Click Toggle) -->
                <div class="relative">
                    <button id="accountToggle" class="text-gray-600 hover:text-blue-500 focus:outline-none">
                        Account
                    </button>
                    <div id="accountDropdown" class="dropdown-menu absolute right-0 bg-white shadow-lg rounded-md mt-2 w-40">
                        <a href="../views/profile.php" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Profile</a>
                        <a href="../views/settings.php" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Settings</a>
                        <a href="logout.php" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <script src="../assets/js/header.js"> 
    </script>
</body>
</html>
