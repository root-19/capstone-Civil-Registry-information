<?php 
include "../config/config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch the existing data
    $query = "SELECT * FROM birth_registration WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
}
?>

<?php include "../model/header.php"; ?>

<h2 class="text-2xl font-bold mb-4"> Live Birth Information</h2>

<!-- Pop-up form -->
<div id="popupForm" class="fixed inset-0 z-50 flex items-center justify-center">
    <div class="bg-white w-full max-w-4xl mx-4 p-6 rounded-lg shadow-lg overflow-auto max-h-screen">
        <h2 class="text-2xl font-bold mb-4 text-center bg-blue-100 py-2">Live Birth Information</h2>
        <form class="space-y-4" method="POST" action="./functions/update-record.php">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <!-- Registry Number and Contact -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="registry" class="block font-medium">Registry No.</label>
                    <input type="text" id="registry" name="registry" value="<?php echo $data['registry_no']; ?>" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label for="contact" class="block font-medium">Contact No.</label>
                    <input type="text" id="contact" name="contact" value="<?php echo $data['contact_no']; ?>" class="w-full p-2 border rounded" required>
                </div>
            </div>
            <!-- Name Fields -->
            <div>
                <label class="block font-medium">Name:</label>
                <div class="grid grid-cols-3 gap-4">
                    <input type="text" name="name_last" placeholder="Last name" value="<?php echo $data['name_last']; ?>" class="p-2 border rounded" required>
                    <input type="text" name="name_first" placeholder="First name" value="<?php echo $data['name_first']; ?>" class="p-2 border rounded" required>
                    <input type="text" name="name_middle" placeholder="Middle name" value="<?php echo $data['name_middle']; ?>" class="p-2 border rounded">
                </div>
            </div>
            <!-- Place of Birth -->
            <div>
                <label class="block font-medium">Place of Birth:</label>
                <div class="grid grid-cols-4 gap-4">
                    <input type="text" name="place_birth_city" placeholder="City/Municipality" value="<?php echo $data['place_birth_city']; ?>" class="p-2 border rounded">
                    <input type="text" name="place_birth_province" placeholder="Province" value="<?php echo $data['place_birth_province']; ?>" class="p-2 border rounded">
                    <input type="text" name="place_birth_street" placeholder="Street" value="<?php echo $data['place_birth_street']; ?>" class="p-2 border rounded">
                    <input type="text" name="place_birth_barangay" placeholder="Barangay" value="<?php echo $data['place_birth_barangay']; ?>" class="p-2 border rounded">
                </div>
            </div>
            <!-- Date of Birth and Gender -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="birthdate" class="block font-medium">Date of Birth:</label>
                    <input type="date" id="birthdate" name="date_of_birth" value="<?php echo $data['date_of_birth']; ?>" class="w-full p-2 border rounded" required>
                </div>
                <div>
                    <label class="block font-medium">Gender:</label>
                    <select name="gender" class="w-full p-2 border rounded" required>
                        <option value="Male" <?php echo ($data['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($data['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                    </select>
                </div>
            </div>
            <!-- Father's Information -->
            <div>
                <label class="block font-medium">Father:</label>
                <div class="grid grid-cols-3 gap-4">
                    <input type="text" name="father_last" placeholder="Last name" value="<?php echo $data['father_last']; ?>" class="p-2 border rounded">
                    <input type="text" name="father_first" placeholder="First name" value="<?php echo $data['father_first']; ?>" class="p-2 border rounded">
                    <input type="text" name="father_middle" placeholder="Middle name" value="<?php echo $data['father_middle']; ?>" class="p-2 border rounded">
                </div>
            </div>
            <!-- Mother's Information -->
            <div>
                <label class="block font-medium">Mother:</label>
                <div class="grid grid-cols-3 gap-4">
                    <input type="text" name="mother_last" placeholder="Last name" value="<?php echo $data['mother_last']; ?>" class="p-2 border rounded">
                    <input type="text" name="mother_first" placeholder="First name" value="<?php echo $data['mother_first']; ?>" class="p-2 border rounded">
                    <input type="text" name="mother_middle" placeholder="Middle name" value="<?php echo $data['mother_middle']; ?>" class="p-2 border rounded">
                </div>
            </div>
            <!-- Action Buttons -->
            <div class="flex justify-center space-x-4 mt-4">
            <button type="button" onclick="printPage()" class="bg-green-500 text-white py-2 px-4 rounded">Print</button>
                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">Update</button>
                <a href="register-birth.php" class="bg-gray-500 text-white py-2 px-4 rounded">Cancel</a>
            </div>
        </form>
    </div><script>
function printPage() {
    window.print();
}
</script>

</div>
