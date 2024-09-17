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

<h2 class="text-2xl font-bold mb-4">Edit Death Record</h2>

<form action="" method="POST" class="bg-white p-6 rounded-lg shadow-md">
    <label class="block mb-2">Registry No:</label>
    <input type="text" name="registry_no" value="<?php echo htmlspecialchars($record['registry_no']); ?>" class="border rounded p-2 w-full mb-4" required>

    <label class="block mb-2">Date of Death:</label>
    <input type="date" name="date_of_death" value="<?php echo htmlspecialchars($record['date_of_death']); ?>" class="border rounded p-2 w-full mb-4" required>

    <label class="block mb-2">Last Name:</label>
    <input type="text" name="founder_last_name" value="<?php echo htmlspecialchars($record['founder_last_name']); ?>" class="border rounded p-2 w-full mb-4" required>

    <label class="block mb-2">First Name:</label>
    <input type="text" name="founder_first_name" value="<?php echo htmlspecialchars($record['founder_first_name']); ?>" class="border rounded p-2 w-full mb-4" required>

    <label class="block mb-2">Middle Name:</label>
    <input type="text" name="founder_middle_name" value="<?php echo htmlspecialchars($record['founder_middle_name']); ?>" class="border rounded p-2 w-full mb-4" required>

    <label class="block mb-2">Gender:</label>
    <select name="gender" class="border rounded p-2 w-full mb-4" required>
        <option value="Male" <?php echo $record['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
        <option value="Female" <?php echo $record['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
    </select>

    <label class="block mb-2">Street:</label>
    <input type="text" name="founder_street" value="<?php echo htmlspecialchars($record['founder_street']); ?>" class="border rounded p-2 w-full mb-4" required>

    <label class="block mb-2">Province:</label>
    <input type="text" name="founder_province" value="<?php echo htmlspecialchars($record['founder_province']); ?>" class="border rounded p-2 w-full mb-4" required>

    <label class="block mb-2">Occupation:</label>
    <input type="text" name="Occupation" value="<?php echo htmlspecialchars($record['occupation']); ?>" class="border rounded p-2 w-full mb-4" required>

    <label class="block mb-2">Civil Status:</label>
    <input type="text" name="civil_status" value="<?php echo htmlspecialchars($record['civil_status']); ?>" class="border rounded p-2 w-full mb-4" required>

    <label class="block mb-2">Cause of Death:</label>
    <input type="text" name="cause_of_death" value="<?php echo htmlspecialchars($record['cause_of_death']); ?>" class="border rounded p-2 w-full mb-4" required>

    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded font-bold">Update</button>
</form>
