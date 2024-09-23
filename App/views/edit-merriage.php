<?php
include "../model/header.php";
include "../config/config.php";



// Fetch the data of the selected record
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM  marriage_registrations WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $record = mysqli_fetch_assoc($result);
}

// Update the record when the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    // Update the data in the database
    $updateSql = "UPDATE marriage_registrations SET 
                    registry_no='$registry_no',
                    date_of_marriage='$date_of_marriage',
                    place_of_marriage='$place_of_marriage',
                    citizenship='$citizenship',
                    founder_last_name='$founder_last_name',
                   contact_no='$contact_no',
                    husband_birth_ref_no='$husband_birth_ref_no',
                    husband_tin='$husband_tin',
                    wife_birth_ref_no='$wife_birth_ref_no',
                    wife_tin='$wife_tin'
                  WHERE id='$id'";

    if (mysqli_query($conn, $updateSql)) {
        echo "<script>alert('Record updated successfully!'); window.location.href='merriage.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<h2 class="text-2xl font-bold mb-4"> Death Record</h2>
<form class="p-6" method="POST" action="">
            <!-- Registry No -->
            <div class="mb-4">
                <label for="registry_no" class="block text-gray-700 font-semibold">Registry No.:</label>
                <input type="text" id="registry_no" name="registry_no" value="<?php echo htmlspecialchars($record['registry_no']); ?>" class="border rounded p-2 w-full" required>
            </div>

            <!-- Date of Marriage and Place of Marriage -->
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label for="date_of_marriage" class="block text-gray-700 font-semibold">Date of Marriage:</label>
                    <input type="date" id="date_of_marriage" name="date_of_marriage" value="<?php echo htmlspecialchars($record['date_of_marriage']); ?>" class="border rounded p-2 w-full" required>
                </div>
                <div>
                    <label for="place_of_marriage" class="block text-gray-700 font-semibold">Place of Marriage:</label>
                    <input type="text" id="place_of_marriage" name="place_of_marriage" value="<?php echo htmlspecialchars($record['place_of_marriage']); ?>" class="border rounded p-2 w-full" required>
                </div>

                <div>
                    <label for="founder_last_name" class="block text-gray-700 font-semibold">Family Name:</label>
                    <input type="text" id="founder_last_name" name="founder_last_name"  value="<?php echo htmlspecialchars($record['founder_last_name']); ?>" class="border rounded p-2 w-full" required>
                </div>
            </div>

            <!-- Citizenship and Contact No -->
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label for="citizenship" class="block text-gray-700 font-semibold">Citizenship:</label>
                    <input type="text" id="citizenship" name="citizenship"  value="<?php echo htmlspecialchars($record['citizenship']); ?>" class="border rounded p-2 w-full" required>
                </div>
                <div>
                    <label for="contact_no" class="block text-gray-700 font-semibold">Contact No.:</label>
                    <input type="text" id="contact_no" name="contact_no"  value="<?php echo htmlspecialchars($record['contact_no']); ?>" class="border rounded p-2 w-full" required>
                </div>
            </div>

            <!-- Husband Section -->
            <div class="border-2 border-cyan-500 rounded p-4 mb-4">
                <h3 class="text-lg font-semibold mb-2">Husband</h3>
                <div class="mb-4">
                    <label for="husband_birth_ref_no" class="block text-gray-700 font-semibold">Birth Reference No.:</label>
                    <input type="text" id="husband_birth_ref_no" name="husband_birth_ref_no"  value="<?php echo htmlspecialchars($record['husband_birth_ref_no']); ?>" class="border rounded p-2 w-full" required>
                </div>
                <div>
                    <label for="husband_tin" class="block text-gray-700 font-semibold">Tax Identification No.:</label>
                    <input type="text" id="husband_tin" name="husband_tin"  value="<?php echo htmlspecialchars($record['husband_tin']); ?>" class="border rounded p-2 w-full" required>
                </div>
            </div>

            <!-- Wife Section -->
            <div class="border-2 border-cyan-500 rounded p-4 mb-4">
                <h3 class="text-lg font-semibold mb-2">Wife</h3>
                <div class="mb-4">
                    <label for="wife_birth_ref_no" class="block text-gray-700 font-semibold">Birth Reference No.:</label>
                    <input type="text" id="wife_birth_ref_no" name="wife_birth_ref_no"  value="<?php echo htmlspecialchars($record['wife_birth_ref_no']); ?>" class="border rounded p-2 w-full" required>
                </div>
                <div>
                    <label for="wife_tin" class="block text-gray-700 font-semibold">Tax Identification No.:</label>
                    <input type="text" id="wife_tin" name="wife_tin" class="border rounded p-2 w-full"  value="<?php $record['wife_tin']; ?>" required>
                </div>
            </div>

            <!-- Submit button -->

            <div class="text-right">
            <button type="button" onclick="printPage()" class="bg-green-500 text-white py-2 px-4 rounded">Print</button>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">update</button>
            </div>
        </form>

        <script>
            function printPage() {
                window.print();
            }
        </script>