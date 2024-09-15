<?php 
 include "../config/config.php";

 // Fetch data from the birth_registration table
$query = "SELECT * FROM birth_registration";
$result = mysqli_query($conn, $query);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from form
    $registry_no = $_POST['registry'];
    $name_last = $_POST['name_last'];
    $name_first = $_POST['name_first'];
    $name_middle = $_POST['name_middle'];
    $place_birth_city = $_POST['place_birth_city'];
    $place_birth_province = $_POST['place_birth_province'];
    $place_birth_street = $_POST['place_birth_street'];
    $place_birth_barangay = $_POST['place_birth_barangay'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $father_last = $_POST['father_last'];
    $father_first = $_POST['father_first'];
    $father_middle = $_POST['father_middle'];
    $mother_last = $_POST['mother_last'];
    $mother_first = $_POST['mother_first'];
    $mother_middle = $_POST['mother_middle'];
    $contact_no = $_POST['contact'];

    // Insert data into the birth_registration table
    $query = "INSERT INTO birth_registration (registry_no, name_last, name_first, name_middle, place_birth_city, place_birth_province, place_birth_street, place_birth_barangay, date_of_birth, gender, father_last, father_first, father_middle, mother_last, mother_first, mother_middle, contact_no) 
              VALUES ('$registry_no', '$name_last', '$name_first', '$name_middle', '$place_birth_city', '$place_birth_province', '$place_birth_street', '$place_birth_barangay', '$date_of_birth', '$gender', '$father_last', '$father_first', '$father_middle', '$mother_last', '$mother_first', '$mother_middle', '$contact_no')";

    if (mysqli_query($conn, $query)) {
        echo "Data inserted successfully";
        header("Location: register-birth.php"); // Redirect to the main page after successful insert
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
<?php  include "../model/header.php"; ?>
<h2 class="text-2xl font-bold mb-4">Registering of Live Births</h2>

<!-- Add button that triggers the pop-up -->
<a href="#" class="add-button bg-blue-500 text-white py-2 px-4 rounded font-bold" onclick="openPopup()">Add +</a>

<!-- Table displaying registered live births -->
<table class="w-full border-collapse mt-4">
    <thead>
        <tr>
            <th class="border px-4 py-2">Registry No.</th>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Address</th>
            <th class="border px-4 py-2">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td class="border px-4 py-2"><?php echo $row['registry_no']; ?></td>
            <td class="border px-4 py-2"><?php echo $row['name_first'] . " " . $row['name_middle'] . " " . $row['name_last']; ?></td>
            <td class="border px-4 py-2"><?php echo $row['place_birth_city'] . ", " . $row['place_birth_province']; ?></td>
            <td class="border px-4 py-2">
                <a href="edit.php?id=<?php echo $row['id']; ?>" class="bg-yellow-500 text-white py-1 px-2 rounded">Edit</a>
                <a href="./functions/delete.php?id=<?php echo $row['id']; ?>" class="bg-red-500 text-white py-1 px-2 rounded">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Pagination -->
<div class="pagination mt-4 flex justify-center">
    <a href="#" class="mx-1 px-3 py-1 border rounded">&laquo;</a>
    <a href="#" class="mx-1 px-3 py-1 border rounded">1</a>
    <a href="#" class="mx-1 px-3 py-1 border rounded bg-blue-500 text-white">2</a>
    <a href="#" class="mx-1 px-3 py-1 border rounded">3</a>
    <a href="#" class="mx-1 px-3 py-1 border rounded">&raquo;</a>
</div>

<!-- Overlay for dimming the background -->
<div id="overlay" class="hidden fixed inset-0 bg-black opacity-50 z-40"></div>

<!-- Pop-up form -->
<div id="popupForm" class="hidden fixed inset-0 z-50 flex items-center justify-center">
    <div class="bg-white w-full max-w-4xl mx-4 p-6 rounded-lg shadow-lg overflow-auto max-h-screen">
        <h2 class="text-2xl font-bold mb-4 text-center bg-blue-100 py-2">Live Birth Information</h2>
        <form class="space-y-4"  method="POST">
    <!-- Registry Number and Contact -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label for="registry" class="block font-medium">Registry No.</label>
            <input type="text" id="registry" name="registry" class="w-full p-2 border rounded" required>
        </div>
        <div>
            <label for="contact" class="block font-medium">Contact No.</label>
            <input type="text" id="contact" name="contact" class="w-full p-2 border rounded" required>
        </div>
    </div>
    <!-- Name Fields -->
    <div>
        <label class="block font-medium">Name:</label>
        <div class="grid grid-cols-3 gap-4">
            <input type="text" name="name_last" placeholder="Last name" class="p-2 border rounded" required>
            <input type="text" name="name_first" placeholder="First name" class="p-2 border rounded" required>
            <input type="text" name="name_middle" placeholder="Middle name" class="p-2 border rounded">
        </div>
    </div>
    <!-- Place of Birth -->
    <div>
        <label class="block font-medium">Place of Birth:</label>
        <div class="grid grid-cols-4 gap-4">
            <input type="text" name="place_birth_city" placeholder="City/Municipality" class="p-2 border rounded">
            <input type="text" name="place_birth_province" placeholder="Province" class="p-2 border rounded">
            <input type="text" name="place_birth_street" placeholder="Street" class="p-2 border rounded">
            <input type="text" name="place_birth_barangay" placeholder="Barangay" class="p-2 border rounded">
        </div>
    </div>
    <!-- Date of Birth and Gender -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label for="birthdate" class="block font-medium">Date of Birth:</label>
            <input type="date" id="birthdate" name="date_of_birth" class="w-full p-2 border rounded" required>
        </div>
        <div>
            <label class="block font-medium">Gender:</label>
            <select name="gender" class="w-full p-2 border rounded" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
    </div>
    <!-- Father's Information -->
    <div>
        <label class="block font-medium">Father:</label>
        <div class="grid grid-cols-3 gap-4">
            <input type="text" name="father_last" placeholder="Last name" class="p-2 border rounded">
            <input type="text" name="father_first" placeholder="First name" class="p-2 border rounded">
            <input type="text" name="father_middle" placeholder="Middle name" class="p-2 border rounded">
        </div>
    </div>
    <!-- Mother's Information -->
    <div>
        <label class="block font-medium">Mother:</label>
        <div class="grid grid-cols-3 gap-4">
            <input type="text" name="mother_last" placeholder="Last name" class="p-2 border rounded">
            <input type="text" name="mother_first" placeholder="First name" class="p-2 border rounded">
            <input type="text" name="mother_middle" placeholder="Middle name" class="p-2 border rounded">
        </div>
    </div>
    <!-- Action Buttons -->
    <div class="flex justify-center space-x-4 mt-4">
        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">Submit</button>
    </div>
</form>
    </div>
</div>

<!-- JavaScript for handling pop-up functionality -->
<script>
    function openPopup() {
        document.getElementById("popupForm").classList.remove("hidden");
        document.getElementById("overlay").classList.remove("hidden");
    }

    function closePopup() {
        document.getElementById("popupForm").classList.add("hidden");
        document.getElementById("overlay").classList.add("hidden");
    }

    // Close popup when clicking outside
    document.getElementById('overlay').addEventListener('click', closePopup);
</script>

<!-- Tailwind CSS Styles -->
<style>
    /* Ensure the popup is scrollable if content overflows */
    .max-h-screen {
        max-height: 90vh;
    }
</style>
