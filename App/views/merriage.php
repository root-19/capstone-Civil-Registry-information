<?php
include "../config/config.php";

// Fetch existing data for the table
$sql = "SELECT * FROM marriage_registrations";
$result = mysqli_query($conn, $sql);

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape all form inputs to prevent SQL injection
    $registry_no = mysqli_real_escape_string($conn, $_POST['registry_no'] ?? '');
    $date_of_marriage = mysqli_real_escape_string($conn, $_POST['date_of_marriage'] ?? '');
    $place_of_marriage = mysqli_real_escape_string($conn, $_POST['place_of_marriage'] ?? '');
    $founder_last_name = mysqli_real_escape_string($conn, $_POST['founder_last_name'] ?? '');
    $citizenship = mysqli_real_escape_string($conn, $_POST['citizenship'] ?? '');
    $contact_no = mysqli_real_escape_string($conn, $_POST['contact_no'] ?? '');
    $husband_birth_ref_no = mysqli_real_escape_string($conn, $_POST['husband_birth_ref_no'] ?? '');
    $husband_tin = mysqli_real_escape_string($conn, $_POST['husband_tin'] ?? '');
    $wife_birth_ref_no = mysqli_real_escape_string($conn, $_POST['wife_birth_ref_no'] ?? '');
    $wife_tin = mysqli_real_escape_string($conn, $_POST['wife_tin'] ?? '');

    // Proper SQL query
    $sql = "INSERT INTO marriage_registrations (
        registry_no, date_of_marriage, place_of_marriage, founder_last_name, citizenship, contact_no, 
        husband_birth_ref_no, husband_tin, wife_birth_ref_no, wife_tin
    ) VALUES (
        '$registry_no', '$date_of_marriage', '$place_of_marriage', '$founder_last_name', '$citizenship', '$contact_no', 
        '$husband_birth_ref_no', '$husband_tin', '$wife_birth_ref_no', '$wife_tin'
    )";

    if (mysqli_query($conn, $sql)) {
        // Success message or redirect
        echo "<script>alert('Marriage registration successful!'); window.location.href='merriage.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<?php include "../model/header.php"; ?>

<h2 class="text-2xl font-bold mb-4">Register Marriage</h2>

<!-- Add button that triggers the pop-up -->
<a href="#" class="add-button bg-blue-500 text-white py-2 px-4 rounded font-bold" onclick="openPopup()">Add +</a>

<!-- Table displaying registered marriages -->
<table class="min-w-full bg-white border border-gray-200 mt-4">
    <thead>
        <tr>
            <th class="border px-4 py-2">Registry No</th>
            <th class="border px-4 py-2">Family Name</th>
            <th class="border px-4 py-2">Date of Marriage</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) {
            $id = isset($row['id']) ? htmlspecialchars($row['id']) : 'N/A';
        ?>
        <tr>
            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['registry_no']); ?></td>
            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['founder_last_name']); ?></td>
            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['date_of_marriage']); ?></td>
            <td class="border px-4 py-2">
                <a href="./edit-death.php?id=<?php echo $id; ?>" class="bg-yellow-500 text-white py-1 px-2 rounded">Edit</a>
                <a href="./functions/delete.php?id=<?php echo $id; ?>" class="bg-red-500 text-white py-1 px-2 rounded">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Popup Form for adding marriages -->
<div id="popupForm" class="fixed inset-0 flex items-center justify-center hidden z-50">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-3xl max-h-screen overflow-y-auto relative">
        <h2 class="text-2xl font-semibold mb-4">Register Marriage</h2>
        <form class="p-6" method="POST" action="">
            <!-- Registry No -->
            <div class="mb-4">
                <label for="registry_no" class="block text-gray-700 font-semibold">Registry No.:</label>
                <input type="text" id="registry_no" name="registry_no" class="border rounded p-2 w-full" required>
            </div>

            <!-- Date of Marriage and Place of Marriage -->
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label for="date_of_marriage" class="block text-gray-700 font-semibold">Date of Marriage:</label>
                    <input type="date" id="date_of_marriage" name="date_of_marriage" class="border rounded p-2 w-full" required>
                </div>
                <div>
                    <label for="place_of_marriage" class="block text-gray-700 font-semibold">Place of Marriage:</label>
                    <input type="text" id="place_of_marriage" name="place_of_marriage" class="border rounded p-2 w-full" required>
                </div>

                <div>
                    <label for="founder_last_name" class="block text-gray-700 font-semibold">Family Name:</label>
                    <input type="text" id="founder_last_name" name="founder_last_name" class="border rounded p-2 w-full" required>
                </div>
            </div>

            <!-- Citizenship and Contact No -->
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label for="citizenship" class="block text-gray-700 font-semibold">Citizenship:</label>
                    <input type="text" id="citizenship" name="citizenship" class="border rounded p-2 w-full" required>
                </div>
                <div>
                    <label for="contact_no" class="block text-gray-700 font-semibold">Contact No.:</label>
                    <input type="text" id="contact_no" name="contact_no" class="border rounded p-2 w-full" required>
                </div>
            </div>

            <!-- Husband Section -->
            <div class="border-2 border-cyan-500 rounded p-4 mb-4">
                <h3 class="text-lg font-semibold mb-2">Husband</h3>
                <div class="mb-4">
                    <label for="husband_birth_ref_no" class="block text-gray-700 font-semibold">Birth Reference No.:</label>
                    <input type="text" id="husband_birth_ref_no" name="husband_birth_ref_no" class="border rounded p-2 w-full" required>
                </div>
                <div>
                    <label for="husband_tin" class="block text-gray-700 font-semibold">Tax Identification No.:</label>
                    <input type="text" id="husband_tin" name="husband_tin" class="border rounded p-2 w-full" required>
                </div>
            </div>

            <!-- Wife Section -->
            <div class="border-2 border-cyan-500 rounded p-4 mb-4">
                <h3 class="text-lg font-semibold mb-2">Wife</h3>
                <div class="mb-4">
                    <label for="wife_birth_ref_no" class="block text-gray-700 font-semibold">Birth Reference No.:</label>
                    <input type="text" id="wife_birth_ref_no" name="wife_birth_ref_no" class="border rounded p-2 w-full" required>
                </div>
                <div>
                    <label for="wife_tin" class="block text-gray-700 font-semibold">Tax Identification No.:</label>
                    <input type="text" id="wife_tin" name="wife_tin" class="border rounded p-2 w-full" required>
                </div>
            </div>

            <!-- Submit button -->
            <div class="text-right">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Register</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openPopup() {
        document.getElementById("popupForm").classList.remove("hidden");
    }
</script>

<!-- JavaScript to handle pop-up open/close -->
<script>
    document.querySelector('.close-popup')?.addEventListener('click', function () {
        document.getElementById('popupForm').style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target == document.getElementById('popupForm')) {
            document.getElementById('popupForm').style.display = 'none';
        }
    });
</script>