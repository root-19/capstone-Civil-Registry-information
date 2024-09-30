<?php
include "../model/header.php";
$table_names = [];
$result = $conn->query("SHOW TABLES");

// Fetch all table names
while ($row = $result->fetch_array()) {
    $table_names[] = $row[0]; // Store each table name in the array
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['generate_report'])) {
    $table_name = $_POST['table_name'];
    $added_date = $_POST['date_added']; // Get the submitted date

    // Format the date to match the database format (Y-m-d H:i:s)
    $added_date = date('Y-m-d H:i:s', strtotime($added_date)); // Convert the date to the correct format

    // Validate table name and added_date
    if (in_array($table_name, $table_names)) { // Check if the table name is valid
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM $table_name WHERE date_added = ?");
        $stmt->bind_param("s", $added_date); // Bind the formatted date

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if any results were returned
        if ($result->num_rows > 0) {
            echo "<table class='min-w-full border-collapse border border-gray-200'>";
            echo "<thead><tr class='bg-gray-100'>";

            // Display table headers
            while ($column_info = $result->fetch_field()) {
                echo "<th class='border border-gray-300 p-2'>" . htmlspecialchars($column_info->name) . "</th>";
            }
            echo "</tr></thead><tbody>";

            // Display each row of results
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $column) {
                    echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($column) . "</td>";
                }
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "No records found for the specified date.";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Invalid table name selected.";
    }
}
?>