<?php
include "../model/header.php";
include "../config/config.php";



// Fetch the data of the selected record
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM death_info WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $record = mysqli_fetch_assoc($result);
}

// Update the record when the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    // Update the data in the database
    $updateSql = "UPDATE death_info SET 
                    registry_no='$registry_no',
                    date_of_death='$date_of_death',
                    founder_last_name='$founder_last_name',
                    founder_first_name='$founder_first_name',
                    founder_middle_name='$founder_middle_name',
                    gender='$gender',
                    founder_street='$founder_street',
                    founder_province='$founder_province',
                    Occupation='$occupation',
                    civil_status='$civil_status',
                    cause_of_death='$cause_of_death'
                  WHERE id='$id'";

    if (mysqli_query($conn, $updateSql)) {
        echo "<script>alert('Record updated successfully!'); window.location.href='death-info.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<h2 class="text-3xl font-bold text-gray-800 mb-6">Death Record</h2>

<form action="" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-xl mx-auto">
    <!-- Registry Number -->
    <label class="block mb-2 font-semibold">Registry No:</label>
    <input type="text" name="registry_no" value="<?php echo htmlspecialchars($record['registry_no']); ?>" class="border border-gray-300 rounded-lg p-2 w-full mb-4" required>

    <!-- Date of Death -->
    <label class="block mb-2 font-semibold">Date of Death:</label>
    <input type="date" name="date_of_death" value="<?php echo htmlspecialchars($record['date_of_death']); ?>" class="border border-gray-300 rounded-lg p-2 w-full mb-4" required>

    <!-- Full Name -->
    <div class="grid grid-cols-3 gap-4 mb-4">
        <div>
            <label class="block mb-2 font-semibold">Last Name:</label>
            <input type="text" name="founder_last_name" value="<?php echo htmlspecialchars($record['founder_last_name']); ?>" class="border border-gray-300 rounded-lg p-2 w-full" required>
        </div>
        <div>
            <label class="block mb-2 font-semibold">First Name:</label>
            <input type="text" name="founder_first_name" value="<?php echo htmlspecialchars($record['founder_first_name']); ?>" class="border border-gray-300 rounded-lg p-2 w-full" required>
        </div>
        <div>
            <label class="block mb-2 font-semibold">Middle Name:</label>
            <input type="text" name="founder_middle_name" value="<?php echo htmlspecialchars($record['founder_middle_name']); ?>" class="border border-gray-300 rounded-lg p-2 w-full" required>
        </div>
    </div>

    <!-- Gender Selection -->
    <label class="block mb-2 font-semibold">Gender:</label>
    <select name="gender" class="border border-gray-300 rounded-lg p-2 w-full mb-4" required>
        <option value="Male" <?php echo $record['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
        <option value="Female" <?php echo $record['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
    </select>

    <!-- Address & Other Information -->
    <label class="block mb-2 font-semibold">Street:</label>
    <input type="text" name="founder_street" value="<?php echo htmlspecialchars($record['founder_street']); ?>" class="border border-gray-300 rounded-lg p-2 w-full mb-4" required>

    <label class="block mb-2 font-semibold">Province:</label>
    <input type="text" name="founder_province" value="<?php echo htmlspecialchars($record['founder_province']); ?>" class="border border-gray-300 rounded-lg p-2 w-full mb-4" required>

    <label class="block mb-2 font-semibold">Occupation:</label>
    <input type="text" name="Occupation" value="<?php echo htmlspecialchars($record['occupation']); ?>" class="border border-gray-300 rounded-lg p-2 w-full mb-4" required>

    <label class="block mb-2 font-semibold">Civil Status:</label>
    <input type="text" name="civil_status" value="<?php echo htmlspecialchars($record['civil_status']); ?>" class="border border-gray-300 rounded-lg p-2 w-full mb-4" required>

    <label class="block mb-2 font-semibold">Cause of Death:</label>
    <input type="text" name="cause_of_death" value="<?php echo htmlspecialchars($record['cause_of_death']); ?>" class="border border-gray-300 rounded-lg p-2 w-full mb-4" required>

    <!-- Buttons for Print, Cancel, and Update -->
    <div class="flex justify-between mt-6">
        <button type="button" onclick="printPage()" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg">Print</button>
        <button type="button" onclick="closePopup()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">Cancel</button>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Update</button>
    </div>
</form>

<script>
    function closePopup() {
    window.location.href = 'death-info.php';
}

// Trigger the browser's print functionality
function printPage() {
    window.print();
}
</script>