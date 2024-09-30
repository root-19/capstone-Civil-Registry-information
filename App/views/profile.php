<?php include "../model/header.php"; ?>
<?php  include "../config/config.php";?>
<div class="container mx-auto p-4">
    <h2 class="text-xl font-semibold mb-4">User Credentials</h2>
    <table class="min-w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 p-2">Username</th>
                <th class="border border-gray-300 p-2">Password</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch user data from the database
            $result = $conn->query("SELECT username, password FROM users");

            // Check if any results were returned
            if ($result->num_rows > 0) {
                // Display each row of results
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['username']) . "</td>";
                    echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['password']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2' class='border border-gray-300 p-2'>No users found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
