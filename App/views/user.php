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
        <h2 id="calendarMonthYear" class="text-xl font-semibold text-center mb-4"></h2>
        <div class="grid grid-cols-7 gap-1">
            <!-- Calendar Header (Sun to Sat) -->
            <div class="text-center font-bold">Sun</div>
            <div class="text-center font-bold">Mon</div>
            <div class="text-center font-bold">Tue</div>
            <div class="text-center font-bold">Wed</div>
            <div class="text-center font-bold">Thu</div>
            <div class="text-center font-bold">Fri</div>
            <div class="text-center font-bold">Sat</div>
            
            <!-- Calendar Days -->
            <div id="calendarDays" class="grid grid-cols-7 gap-x-20 gap-y-6 text-center font-bold ml-12"></div>
        
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
    <script>
    // Get current date info
    const currentDate = new Date();
    const currentMonth = currentDate.getMonth(); // 0-indexed (0 = January)
    const currentYear = currentDate.getFullYear();

    // Array of month names
    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    // Number of days in each month
    const daysInMonth = (month, year) => new Date(year, month + 1, 0).getDate();

    // First day of the current month
    const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay(); // 0 = Sunday

    // Get total days in the current month
    const totalDays = daysInMonth(currentMonth, currentYear);

    // Update the month and year in the header
    document.getElementById('calendarMonthYear').innerText = `${monthNames[currentMonth]} ${currentYear}`;

    // Generate calendar days
    const calendarDaysContainer = document.getElementById('calendarDays');
    calendarDaysContainer.innerHTML = '';

    // Add empty slots for days before the first day of the month
    for (let i = 0; i < firstDayOfMonth; i++) {
        const emptySlot = document.createElement('div');
        emptySlot.classList.add('text-center');
        calendarDaysContainer.appendChild(emptySlot);
    }

    // Add the actual days of the month
    for (let day = 1; day <= totalDays; day++) {
        const dayElement = document.createElement('div');
        dayElement.classList.add('text-center', 'font-bold');
        dayElement.innerText = day;
        calendarDaysContainer.appendChild(dayElement);
    }

    // Fill remaining empty slots to complete the last week row
    const totalSlots = firstDayOfMonth + totalDays;
    const remainingSlots = 7 - (totalSlots % 7);
    if (remainingSlots < 7) {
        for (let i = 0; i < remainingSlots; i++) {
            const emptySlot = document.createElement('div');
            emptySlot.classList.add('text-center');
            calendarDaysContainer.appendChild(emptySlot);
        }
    }
</script>