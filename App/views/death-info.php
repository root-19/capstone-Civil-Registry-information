<?php
include "../config/config.php";

// Fetch data from the database
$sql = "SELECT * FROM live_births";
$result = mysqli_query($conn, $sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch form data
    $registry_no = mysqli_real_escape_string($conn, $_POST['registry_no']);
    $date_of_death = mysqli_real_escape_string($conn, $_POST['date_of_death']);
    $founder_last_name = mysqli_real_escape_string($conn, $_POST['founder_last_name']);
    $founder_first_name = mysqli_real_escape_string($conn, $_POST['founder_first_name']);
    $founder_middle_name = mysqli_real_escape_string($conn, $_POST['founder_middle_name']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $founder_street = mysqli_real_escape_string($conn, $_POST['founder_street']);
    $founder_province = mysqli_real_escape_string($conn, $_POST['founder_province']);
    $occupation = mysqli_real_escape_string($conn, $_POST['Occupation']);
    $civil_status = mysqli_real_escape_string($conn, $_POST['civil_status']);
    $cause_of_death = mysqli_real_escape_string($conn, $_POST['cause_of_death']);

    // Insert data into the database
    $sql = "INSERT INTO death_info (registry_no, date_of_death, founder_last_name, founder_first_name, 
            founder_middle_name, gender, founder_street, founder_province, Occupation, civil_status, cause_of_death) 
            VALUES ('$registry_no', '$date_of_death', '$founder_last_name', '$founder_first_name', '$founder_middle_name', 
                    '$gender', '$founder_street', '$founder_province', '$occupation', '$civil_status', '$cause_of_death')";

    if (mysqli_query($conn, $sql)) {
        // Success message or redirect
        echo "<script>alert('Death registration successful!'); window.location.href='death-info.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch data from the database
$sql = "SELECT * FROM death_info";
$result = mysqli_query($conn, $sql);
?>

<?php include "../model/header.php"; ?>

<h2 class="text-2xl font-bold mb-4">Register Death</h2>

<!-- Add button that triggers the pop-up -->
<a href="#" class="add-button bg-blue-500 text-white py-2 px-4 rounded font-bold" onclick="openPopup()">Add +</a>

<!-- Table displaying registered live births -->
<table class="min-w-full bg-white border border-gray-200 mt-4">
    <thead>
        <tr>
            <th class="border px-4 py-2">Registry No</th>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Date of Death</th>
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
            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['date_of_death']); ?></td>
            <td class="border px-4 py-2">
                <a href="./edit-death.php?id=<?php echo $id; ?>" class="bg-yellow-500 text-white py-1 px-2 rounded">Edit</a>
                <a href="./functions/delete.php?id=<?php echo $id; ?>" class="bg-red-500 text-white py-1 px-2 rounded">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Popup Form for adding live births -->
<div id="popupForm" class="fixed inset-0 flex items-center justify-center hidden z-50">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-3xl max-h-screen overflow-y-auto relative">
        <h2 class="text-2xl font-semibold mb-4">Register Death</h2>
        <form action="" method="POST" class="space-y-4">
            <div>
                <label for="registry_no" class="block text-gray-700 font-medium">Registry No:</label>
                <input type="text" id="registry_no" name="registry_no" required class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="date-of-death" class="block text-gray-700 font-medium">Date of Death:</label>
                <input type="date" id="date-of-death" name="" required class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="founder_last_name" class="block text-gray-700 font-medium">Last Name:</label>
                <input type="text" id="founder_last_name" name="founder_last_name" required class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="founder_first_name" class="block text-gray-700 font-medium">First Name:</label>
                <input type="text" id="founder_first_name" name="founder_first_name" required class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="founder_middle_name" class="block text-gray-700 font-medium">Middle Name:</label>
                <input type="text" id="founder_middle_name" name="founder_middle_name" class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium">Gender:</label>
                <select name="gender" class="w-full p-2 border rounded" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="founder_street" class="block text-gray-700 font-medium">Street:</label>
                    <input type="text" id="founder_street" name="founder_street" class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="founder_province" class="block text-gray-700 font-medium">Province:</label>
                    <input type="text" id="founder_province" name="founder_province" class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="Occupation" class="block text-gray-700 font-medium">Occupation:</label>
                    <input type="text" id="Occupation" name="Occupation" class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="civil-status" class="block text-gray-700 font-medium">Civil Status:</label>
                    <input type="text" id="civil-status" name="civil-status" class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div>
                <label for="cause-of-death" class="block text-gray-700 font-medium">Cause of Death:</label>
                <textarea id="cause-of-death" name="cause-of-death" required class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded font-bold">Submit</button>
            </div>
        </form>

        <!-- Close Button -->
        <button class="close-popup absolute top-2 right-2 bg-gray-500 text-white py-1 px-2 rounded">X</button>
    </div>
</div>


<!-- JavaScript to handle pop-up open/close -->
<script>
    function openPopup() {
        document.getElementById('popupForm').style.display = 'flex';
    }

    document.querySelector('.close-popup').addEventListener('click', function () {
        document.getElementById('popupForm').style.display = 'none';
    });

    window.addEventListener('click', function (e) {
        if (e.target === document.getElementById('popupForm')) {
            document.getElementById('popupForm').style.display = 'none';
        }
    });
</script>

