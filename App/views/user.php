<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header with Logo on Left</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
    .calendar-bg{
            background-image: url('../images/Screenshot\ 2024-09-13\ 064330.png');
            background-size: cover;
            background-position: center;
            background-color: aliceblue;
    }
    .logo{
        height: 80px;
    }
    .text-lg {
    margin-left: 16px; 
    font-size: 1.125rem;
    font-weight: 600; 
}
</style>
<body class="bg-gray-100">
    <header class="bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <!-- Logo on Left -->
            <a href="#" class="flex items-center">
                <img src="../images/Screenshot 2024-09-13 065403.png" alt="Logo" class="logo w-auto">
                <div class="ml-4 text-lg font-semibold">
                    Province of Camarines Sur <br>
                    Municipality of Nabua
                </div>
            </a>
            

            <!-- Right Side - Links, Search Bar, Event Notification, and Account Dropdown -->
            <div class="flex items-center space-x-6">
                <!-- Links -->
                <nav class="flex space-x-6 ">
                    
                    <a href="#" class="text-gray-600 hover:text-blue-500">Home</a>
                    
                    <!-- Services Dropdown -->
                    <div class="relative group">
                        <button class="text-gray-600 hover:text-blue-500 focus:outline-none">
                            Services
                        </button>
                        <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-md mt-2 w-40">
                            <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Service 1</a>
                            <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Service 2</a>
                            <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Service 3</a>
                        </div>
                    </div>
                </nav>

                <!-- Event Notification -->
                <a href="#" class="relative text-gray-600 hover:text-blue-500">
                    Event Notifications
                </a>

                <!-- Search Bar -->
                <div>
                    <input 
                        type="text" 
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300" 
                        placeholder="Search...">
                </div>

                <!-- Account Dropdown -->
                <div class="relative group">
                    <button class="text-gray-600 hover:text-blue-500 focus:outline-none">
                        Account
                    </button>
                    <div class="absolute right-0 hidden group-hover:block bg-white shadow-lg rounded-md mt-2 w-40">
                        <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Profile</a>
                        <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Settings</a>
                        <a href="logout.php" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto p-4">
        <!-- Header with Generate Report Button -->
        <div class="flex justify-end">
            <button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                Generate Report
            </button>
        </div>

        <div class="grid grid-cols-2 gap-6 mt-4">
            <!-- Calendar Section -->
            <div class="bg-white p-4 rounded-lg shadow-md calendar-bg">
                <h2 class="text-xl font-semibold text-center mb-4">October 2023</h2>
                <div class="grid grid-cols-7 gap-2">
                    <!-- Calendar Header (Sun to Sat) -->
                    <div class="text-center font-bold">Sun</div>
                    <div class="text-center font-bold">Mon</div>
                    <div class="text-center font-bold">Tue</div>
                    <div class="text-center font-bold">Wed</div>
                    <div class="text-center font-bold">Thu</div>
                    <div class="text-center font-bold">Fri</div>
                    <div class="text-center font-bold">Sat</div>
                    
                    <!-- Calendar Days -->
                    <!-- Fill with dates, adjust as per month -->
                    <div class="text-center font-bold">1</div>
                    <div class="text-center font-bold">2</div>
                    <div class="text-center font-bold">3</div>
                    <div class="text-center font-bold">4</div>
                    <div class="text-center font-bold">5</div>
                    <div class="text-center font-bold">6</div>
                    <div class="text-center font-bold">7</div>
                    <div class="text-center font-bold ">8</div>
                    <div class="text-center">9</div>
                    <div class="text-center">10</div>
                    <div class="text-center">11</div>
                    <div class="text-center">12</div>
                    <div class="text-center">13</div>
                    <div class="text-center">14</div>
                    <div class="text-center">15</div>
                    <div class="text-center">16</div>
                    <div class="text-center">17</div>
                    <div class="text-center">18</div>
                    <div class="text-center">19</div>
                    <div class="text-center">20</div>

                 
                </div>
            </div>

            <!-- Today's Logs Section -->
            <div class="bg-cyan-400 p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-center">Today's Logs</h2>
                <table class="w-full table-auto bg-gray-100">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2 text-left">Activity</th>
                            <th class="border px-4 py-2 text-left">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border px-4 py-2">Admin has Log in</td>
                            <td class="border px-4 py-2">9:00 am</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Activities Section -->
        <div class="bg-cyan-400 p-4 mt-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4 text-center">Activities</h2>
            <table class="w-full table-auto bg-gray-100">
                <thead>
                    <tr>
                        <th class="border px-4 py-2 text-left">Activity</th>
                        <th class="border px-4 py-2 text-left">Date</th>
                        <th class="border px-4 py-2 text-left">Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">Brgy. Election Voting</td>
                        <td class="border px-4 py-2">10/30/23</td>
                        <td class="border px-4 py-2">9:00 am - 4:00 pm</td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
