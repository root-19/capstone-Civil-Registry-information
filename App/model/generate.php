
    <style>
        #reportDropdown {
            display: none; /* Initially hidden */
        }
    </style>


<div class="flex justify-end">
    <button 
        id="reportButton" 
        class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
        Generate Report
    </button>

    <!-- Dropdown menu -->
    <div 
        id="reportDropdown" 
        class="absolute bg-white border border-gray-300 mt-2 p-4 rounded-md shadow-lg">
        <h3 class="text-lg font-semibold mb-2">Select Report Type</h3>
        <form id="reportForm">
            <div>
                <label for="dateFrom" class="block">Date From:</label>
                <input type="date" id="dateFrom" name="dateFrom" class="border border-gray-300 rounded-md p-2 w-full">
            </div>
            <div>
                <label for="dateTo" class="block mt-2">Date To:</label>
                <input type="date" id="dateTo" name="dateTo" class="border border-gray-300 rounded-md p-2 w-full">
            </div>
            <div class="mt-2">
                <label for="tableSelect" class="block">Select Table:</label>
                <select id="tableSelect" name="table" class="border border-gray-300 rounded-md p-2 w-full">
                    <option value="live_births">Live Births</option>
                    <option value="birth_registration">Birth Registration</option>
                    <option value="marriage_registrations">Marriage Registrations</option>
                    <option value="death_info">Death Info</option>
                </select>
            </div>
            <button 
                type="button" 
                id="showReportButton" 
                class="bg-blue-600 text-white py-2 px-4 rounded-md mt-4 hover:bg-blue-700">
                Show Report
            </button>
        </form>
        <div id="reportResults" class="mt-4"></div>
    </div>
</div>

<script>
    document.getElementById('reportButton').addEventListener('click', function() {
        const dropdown = document.getElementById('reportDropdown');
        dropdown.classList.toggle('hidden'); // Toggle visibility
    });

    document.getElementById('showReportButton').addEventListener('click', function() {
        const dateFrom = document.getElementById('dateFrom').value;
        const dateTo = document.getElementById('dateTo').value;
        const table = document.getElementById('tableSelect').value;

        // Make an AJAX request to fetch the report data
        fetch(`fetch_report.php?dateFrom=${dateFrom}&dateTo=${dateTo}&table=${table}`)
            .then(response => response.json())
            .then(data => {
                const resultsDiv = document.getElementById('reportResults');
                resultsDiv.innerHTML = ''; // Clear previous results

                if (data.length === 0) {
                    resultsDiv.innerHTML = '<p>No data found for the selected criteria.</p>';
                } else {
                    let html = '<table class="min-w-full border-collapse border border-gray-300"><thead><tr>';
                    // Add table headers based on the fetched data keys
                    Object.keys(data[0]).forEach(key => {
                        html += `<th class="border border-gray-300 p-2">${key}</th>`;
                    });
                    html += '</tr></thead><tbody>';
                    // Add table rows
                    data.forEach(row => {
                        html += '<tr>';
                        Object.values(row).forEach(value => {
                            html += `<td class="border border-gray-300 p-2">${value}</td>`;
                        });
                        html += '</tr>';
                    });
                    html += '</tbody></table>';
                    resultsDiv.innerHTML = html;
                }
            })
            .catch(error => console.error('Error fetching report:', error));
    });
</script>


<?php
// fetch_report.php - Handle the request to fetch report data
if (isset($_GET['dateFrom'], $_GET['dateTo'], $_GET['table'])) {
    $table = $_GET['table'];
    $dateFrom = $_GET['dateFrom'];
    $dateTo = $_GET['dateTo'];

    // Prepare SQL query
    $sql = "SELECT * FROM $table WHERE date_column BETWEEN '$dateFrom' AND '$dateTo'"; // Adjust 'date_column' to your actual column name
    $result = $conn->query($sql);

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($data);
    exit; // Ensure no further output
}
?>
