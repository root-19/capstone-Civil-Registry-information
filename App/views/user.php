<?php include "../model/header.php" ; ?>
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
