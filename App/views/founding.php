<?php
include "../config/config.php";

// Fetch data from the database
$sql = "SELECT * FROM live_births";
$result = mysqli_query($conn, $sql);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $registry_no = $_POST['registry_no'];
    $contact_no = $_POST['contact_no'];
    $date_time = date('Y-m-d H:i:s'); // Current datetime

    $founder_last_name = $_POST['founder_last_name'];
    $founder_first_name = $_POST['founder_first_name'];
    $founder_middle_name = $_POST['founder_middle_name'];
    $founder_occupation = $_POST['founder_occupation'];
    $founder_street = $_POST['founder_street'];
    $founder_province = $_POST['founder_province'];
    $founder_barangay = $_POST['founder_barangay'];
    $founder_zipcode = $_POST['founder_zipcode'];

    $informant_last_name = $_POST['informant_last_name'];
    $informant_first_name = $_POST['informant_first_name'];
    $informant_middle_name = $_POST['informant_middle_name'];
    $informant_occupation = $_POST['informant_occupation'];
    $relationship_to_founder = $_POST['relationship_to_founder'];
    $informant_address = $_POST['informant_address'];
    $informant_contact = $_POST['informant_contact'];

    // SQL insert query
    $query = "INSERT INTO live_births (registry_no, contact_no, date_time, founder_last_name, founder_first_name, founder_middle_name, 
        founder_occupation, founder_street, founder_province, founder_barangay, founder_zipcode, 
        informant_last_name, informant_first_name, informant_middle_name, informant_occupation, 
        relationship_to_founder, informant_address, informant_contact)
        VALUES ('$registry_no', '$contact_no', '$date_time', '$founder_last_name', '$founder_first_name', '$founder_middle_name', 
        '$founder_occupation', '$founder_street', '$founder_province', '$founder_barangay', '$founder_zipcode', 
        '$informant_last_name', '$informant_first_name', '$informant_middle_name', '$informant_occupation', 
        '$relationship_to_founder', '$informant_address', '$informant_contact')";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo "Data inserted successfully";
        header("Location: founding.php"); // Redirect to the main page after successful insert
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
<script>
   // Show pop-up on button click
   function openPopup() {
       document.getElementById('popupForm').classList.remove('hidden');
       document.getElementById('overlay').classList.remove('hidden');
   }

   // Hide pop-up when clicking outside the form
   function closePopup() {
       document.getElementById('popupForm').classList.add('hidden');
       document.getElementById('overlay').classList.add('hidden');
   }
// Search functionality for the table
function searchProduct(value) {
    const rows = document.querySelectorAll("tbody tr");

    rows.forEach(row => {
        const registryNo = row.cells[0].textContent.toLowerCase();
        const founderName = row.cells[1].textContent.toLowerCase();
        const address = row.cells[2].textContent.toLowerCase();

        if (registryNo.includes(value.toLowerCase()) || 
            founderName.includes(value.toLowerCase()) || 
            address.includes(value.toLowerCase())) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}
</script>

<?php include "../model/header.php"; ?>

<h2 class="text-2xl font-bold mb-4">Founding</h2>

<!-- Search bar -->
<div class="max-w-lg mx-auto mt-6">
  <a href="#" class="add-button bg-blue-500 text-white py-2 px-4 rounded font-bold" onclick="openPopup()">Add +</a>

    <!-- Search Input Field -->
    <input type="text" id="productSearch" placeholder="Search" oninput="searchProduct(this.value)"
        class="w-full p-3 text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all">

    <!-- Search Results Dropdown -->
    <div id="searchResults" class="absolute w-full bg-white shadow-lg border border-gray-200 rounded-lg mt-1 max-h-56 overflow-y-auto hidden z-10"></div>
</div>

<!-- Table displaying registered live births -->
<table class="min-w-full bg-white border border-gray-200 mt-4">
    <thead>
        <tr>
            <th class="border px-4 py-2">Registry No</th>
            <th class="border px-4 py-2">Founder Name</th>
            <th class="border px-4 py-2">Address</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { 
            $id = isset($row['id']) ? htmlspecialchars($row['id']) : 'N/A';
        ?>
        <tr>
            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['registry_no']); ?></td>
            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['founder_last_name'] . ', ' . $row['founder_first_name']); ?></td>
            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['founder_street'] . ', ' . $row['founder_barangay'] . ', ' . $row['founder_province'] . ', ' . $row['founder_zipcode']); ?></td>
            <td class="border px-4 py-2">
                <a href="./edit-founding.php?id=<?php echo $id; ?>" class="bg-blue-500 text-white py-1 px-2 rounded">VIEW</a>
                <!-- <a href="./functions/delete-found.php?id=<?php echo $id; ?>" class="bg-red-500 text-white py-1 px-2 rounded">Delete</a> -->
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Popup Form for adding live births -->
<div id="popupForm" class="fixed inset-0 flex items-center justify-center hidden z-50">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-3xl max-h-screen overflow-y-auto relative">
        <h2 class="text-2xl font-semibold mb-4">Add Live Birth</h2>
        <form action="" method="POST" class="space-y-4">
            <div>
                <label for="registry_no" class="block text-gray-700 font-medium">Registry No:</label>
                <input type="text" id="registry_no" name="registry_no" required class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="contact_no" class="block text-gray-700 font-medium">Contact No:</label>
                <input type="text" id="contact_no" name="contact_no" required class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <!-- Additional form fields for Founder and Informant -->
            <h3 class="text-xl font-semibold text-gray-700 mt-6">Founder Information</h3>
            <div class="grid grid-cols-2 gap-4">
                <!-- First column -->
                <div>
                    <label for="founder_last_name" class="block text-gray-700 font-medium">Last Name:</label>
                    <input type="text" id="founder_last_name" name="founder_last_name" required class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="founder_first_name" class="block text-gray-700 font-medium">First Name:</label>
                    <input type="text" id="founder_first_name" name="founder_first_name" required class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <!-- Informant section -->
            <h3 class="text-xl font-semibold text-gray-700 mt-6">Informant Information</h3>
            <!-- Informant form fields here -->
            
            <!-- Submit button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg focus:ring-2 focus:ring-blue-500">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Overlay for pop-up -->
<div id="overlay" class="fixed inset-0 bg-black opacity-50 hidden" onclick="closePopup()"></div>


