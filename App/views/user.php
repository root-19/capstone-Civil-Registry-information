<?php
include "../config/config.php";

//Function to log login attempts
function logLoginAttempt($user_id, $status, $ip_address) {
    global $conn;
    $sql = "INSERT INTO login_logs (user_id, login_time, ip_address, status) VALUES (?, NOW(), ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("iss", $user_id, $ip_address, $status);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Error logging login attempt: " . $conn->error;
    }
}

// Function to fetch login logs with usernames
function fetchLoginLogs($user_id = null) {
    global $conn;
    $sql = "SELECT login_logs.*, users.username 
            FROM login_logs 
            JOIN users ON login_logs.user_id = users.id";
    
    if ($user_id) {
        $sql .= " WHERE login_logs.user_id = ?";
    }
    
    $stmt = $conn->prepare($sql);
    
    if ($user_id) {
        $stmt->bind_param("i", $user_id);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    $logs = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    
    return $logs;
}

$loginLogs = fetchLoginLogs();

// Fetch activities
$query = "SELECT * FROM activities";
$result = mysqli_query($conn, $query);

// Collect registry numbers from various tables
$tables = ['birth_registration', 'marriage_registrations', 'live_births', 'death_info'];
$options = [];
foreach ($tables as $table) {
    $query = "SELECT registry_no FROM $table";
    $result = mysqli_query($conn, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $options[] = $row['registry_no'];
        }
    } else {
        echo "Error fetching from $table: " . mysqli_error($conn);
    }
}

// Handle report generation form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['services']) && !empty($_POST['services'])) {
        $selected_service = $_POST['services'];
        echo '<script>
            Swal.fire({
                title: "Report Generated!",
                text: "The report for ' . htmlspecialchars($selected_service) . ' has been successfully generated.",
                icon: "success",
                confirmButtonText: "OK"
            });
        </script>';
    } else {
        echo '<script>
            Swal.fire({
                title: "Error!",
                text: "Please select a service before generating a report.",
                icon: "error",
                confirmButtonText: "OK"
            });
        </script>';
    }
}

?>

<?php include "../model/header.php" ; ?>
    <div class="container mx-auto p-4">
        <!-- Header with Generate Report Button -->
   
        <?php
    // Initialize an array to store table names
    $table_names = [];
    $result = $conn->query("SHOW TABLES");

    // Fetch all table names
    while ($row = $result->fetch_array()) {
        $table_names[] = $row[0]; // Store each table name in the array
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['generate_report'])) {
        $table_name = $_POST['table_name'];
        $added_date = $_POST['date_added']; // Get the submitted date
    
        // Format the date to match the database format (Y-m-d H:i:s)
        $added_date = date('Y-m-d H:i:s', strtotime($added_date)); // Convert the date to the correct format
    
        // Validate table name and added_date
        if (in_array($table_name, $table_names)) { // Check if the table name is valid
            // Prepare the SQL statement to prevent SQL injection
            $stmt = $conn->prepare("SELECT * FROM `$table_name` WHERE date_added = ?");
            $stmt->bind_param("s", $added_date); // Bind the formatted date
    
            // Execute the statement
            $stmt->execute();
    
            // Get the result
            $result = $stmt->get_result();
    
            // Check if any results were returned
            if ($result->num_rows > 0) {
                // Output the report content for printing directly in the hidden iframe
                echo "<iframe id='printFrame' style='display:none;'></iframe>";
                echo "<script>
                    var reportContent = '<table class=\"min-w-full border-collapse border border-gray-200\"><thead><tr class=\"bg-gray-100\">';";
    
                // Fetch and append the table headers
                while ($column_info = $result->fetch_field()) {
                    echo "reportContent += '<th class=\"border border-gray-300 p-2\">" . htmlspecialchars($column_info->name) . "</th>';"; 
                }
                echo "reportContent += '</tr></thead><tbody>';";
                
                // Fetch and append each row of results
                while ($row = $result->fetch_assoc()) {
                    echo "reportContent += '<tr>';";
                    foreach ($row as $column) {
                        echo "reportContent += '<td class=\"border border-gray-300 p-2\">" . htmlspecialchars($column) . "</td>';";
                    }
                    echo "reportContent += '</tr>';"; 
                }
                echo "reportContent += '</tbody></table>';";
                
                // Insert the content into the hidden iframe and trigger the print
                echo "var printFrame = document.getElementById('printFrame').contentWindow;
                    printFrame.document.open();
                    printFrame.document.write('<html><head><title>Report</title></head><body>' + reportContent + '</body></html>');
                    printFrame.document.close();
                    printFrame.focus();
                    printFrame.print();
                </script>";
    
                
    
            } else {
                echo "No records found for the specified date.";
            }
    
            // Close the statement
            $stmt->close();
        } else {
            echo "Invalid table name selected.";
        }
    }
    
    // Fetch live births
$live_births_query = "SELECT * FROM live_births";
$live_births_result = $conn->query($live_births_query);

// Fetch birth registrations
$birth_registration_query = "SELECT * FROM birth_registration";
$birth_registration_result = $conn->query($birth_registration_query);

// Fetch marriage registrations
$marriage_registrations_query = "SELECT * FROM marriage_registrations";
$marriage_registrations_result = $conn->query($marriage_registrations_query);

// Fetch death info
$death_info_query = "SELECT * FROM death_info";
$death_info_result = $conn->query($death_info_query);
    ?>

    <div class="flex justify-end">
        <button id="generateReportBtn" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
            Generate Report
        </button>
    </div>

    <!-- Modal Structure -->
    <div id="reportModal" class="relative fixed inset-0 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 w-1/3">
            <h2 class="text-lg font-semibold mb-4">Generate Report</h2>
            <form method="POST" action="">
                <div class="mb-4">
                    <label for="table_name" class="block text-gray-700">Select Table:</label>
                    <select name="table_name" id="table_name" required class="border rounded-md py-2 px-3">
                        <option value="">Select a table</option>
                        <?php foreach ($table_names as $table_name): ?>
                            <option value="<?php echo htmlspecialchars($table_name); ?>"><?php echo htmlspecialchars($table_name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="date_added" class="block text-gray-700">Enter Date (Y-m-d H:i:s):</label>
                    <input type="text" name="date_added" id="date_added" class="w-full border-gray-300 rounded-md" placeholder="2024-09-28 10:43:09" required>
                </div>
                <div class="flex justify-end">
                    <button type="submit" name="generate_report" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                        Generate Report
                    </button>
                </div>
            </form>
            <button id="closeModalBtn" class="mt-4 text-gray-600 hover:underline">Cancel</button>
        </div>
    </div>
</div>
<!-- Add JavaScript to handle the print functionality -->
<script>
    document.getElementById('printReportBtn').addEventListener('click', function() {
        // Use JavaScript's print method to print the report
        var reportContent = document.getElementById('reportContent').innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = reportContent;
        window.print();
        document.body.innerHTML = originalContent; // Restore original content after printing
        location.reload(); // Reload to restore the page state
    });
</script>

<!-- JavaScript to Handle Modal -->
<script>
    document.getElementById('generateReportBtn').onclick = function() {
        document.getElementById('reportModal').classList.remove('hidden');
    };

    document.getElementById('closeModalBtn').onclick = function() {
        document.getElementById('reportModal').classList.add('hidden');
    };
    
    // Close the modal when clicking outside of it
    window.onclick = function(event) {
        const modal = document.getElementById('reportModal');
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    };
</script>

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
           <!-- Today's Logs Section -->
<div class="bg-cyan-400 p-4 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4 text-center">Today's Logs</h2>
    <table class="w-full table-auto bg-gray-100">
        <thead>
            <tr>
                <th class="border px-4 py-2 text-left">Activity</th>
                <th class="border px-4 py-2 text-left">Date</th>
              
            </tr>
        </thead>
        <tbody>
        <?php if (count($loginLogs) > 0) : ?>
            <?php foreach ($loginLogs as $row) : ?>
                <tr>
                    <td class="border px-4 py-2"><?= htmlspecialchars($row['username']) ?></td> <!-- Display Username -->
                    <td class="border px-4 py-2"><?= date('h:i A', strtotime($row['login_time'])) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="4" class="border px-4 py-2 text-center">No activities found</td>
            </tr>
        <?php endif; ?>
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
            <?php
            // Display Live Births
            if ($live_births_result->num_rows > 0) {
                while ($row = $live_births_result->fetch_assoc()) {
                    echo "<tr>
                        <td>Live Births</td>
                        <td>{$row['date_time']}</td> <!-- Use the appropriate date column -->
                        <td>" . date('H:i:s') . "</td> <!-- Current time -->
                    </tr>";
                }
            }

            // Display Birth Registrations
            if ($birth_registration_result->num_rows > 0) {
                while ($row = $birth_registration_result->fetch_assoc()) {
                    echo "<tr>
                        <td>Birth Registration</td>
                        <td>{$row['date_of_birth']}</td> <!-- Adjust to the actual date column -->
                        <td>" . date('H:i:s') . "</td> <!-- Current time -->
                    </tr>";
                }
            }

            // Display Marriage Registrations
            if ($marriage_registrations_result->num_rows > 0) {
                while ($row = $marriage_registrations_result->fetch_assoc()) {
                    echo "<tr>
                        <td>Marriage Registration</td>
                        <td>{$row['date_of_marriage']}</td> <!-- Use the appropriate date column -->
                        <td>" . date('H:i:s') . "</td> <!-- Current time -->
                    </tr>";
                }
            }

            // Display Death Info
            if ($death_info_result->num_rows > 0) {
                while ($row = $death_info_result->fetch_assoc()) {
                    echo "<tr>
                        <td>Death Info</td>
                        <td>{$row['date_of_death']}</td> <!-- Use the appropriate date column -->
                        <td>" . date('H:i:s') . "</td> <!-- Current time -->
                    </tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>

            <!-- Card 1 -->
  <div class="border border-gray-300 p-5 mb-6 bg-white flex items-start">
    <img src="../assets/images/advisory.png" alt="Advisory" class="w-1/5 h-auto object-cover mr-4">
    <div>
      <h3 class="text-xl font-bold mb-2 text-blue-500">ADVISORY</h3>
      <p class="text-gray-600">24-HOUR LOCAL WEATHER FORECAST</p>
      <p class="text-sm text-gray-500">Issued at: 5:00 PM, 15 November 2023</p>
      <p class="text-sm text-gray-500">Valid until: 5:00 PM Tomorrow</p>
    </div>
  </div>

  <!-- Card 2 -->
  <div class="border border-gray-300 p-5 mb-6 bg-white flex items-start">
    <img src="../assets/images/christmass.png" alt="Christmas in Nabua" class="w-1/5 h-auto object-cover mr-4">
    <div>
      <h3 class="text-xl font-bold text-blue-600 mb-2 text-blue-500">CHRISTMAS IN NABUA 2023</h3>
      <p class="text-gray-600">Dear Nabua people, let’s color again the joyful Easter celebration in our town. This time, it’s going to be a WHITE CHRISTMAS because of new stories. Watch this Christmas! Abangan...</p>
    </div>
  </div>

  <!-- Card 3 -->
  <div class="border border-gray-300 p-5 mb-6 bg-white flex items-start">
    <img src="../assets/images/fff.png" alt="Pandayan Bookshop" class="w-1/5 h-auto object-cover mr-4">
    <div>
      <h3 class="text-xl font-bold mb-2 text-blue-500">OPENING OF PANDAYAN BOOKSHOP</h3>
      <p class="text-gray-600">Welcome to a New Chapter! The Pandayan Bookshop is now open on the 2nd Floor of the Market Building, Nabua. Let’s empower our education community by shopping here for school supplies! Together, we’re building brighter futures.</p>
    </div>
  </div>
  <br>
  <!-- Card 4 -->
  <div class="border border-gray-300 p-5 mb-6 bg-white flex items-start">
    <img src="../assets/images/mmdr.png" alt="MDRRMO" class="w-1/5 h-auto object-cover mr-4">
    <div>
      <h3 class="text-xl font-bold mb-2 text-blue-500">MDRRMO</h3>
      <p class="text-gray-600">NATIONWIDE EMERGENCY HOTLINE: 911</p>
      <p class="text-gray-600">Tel: (054) 288 1023</p>
      <p class="text-gray-600">Mobile: 09471819217 / 09150262265</p>
    </div>
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