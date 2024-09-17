<?php 
include "../config/config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch the existing data
    $query = "SELECT * FROM live_births WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
}
?>
<!-- <link rel="stylesheet" href="../assets/css/style.css"> -->

<style> 
    /* Custom styles to prevent popup from overlapping header */
    .popup-container {
        max-height: calc(100vh - 100px); /* Adjust based on header height */
        overflow-y: auto;
    }
</style>

<?php include "../model/header.php"; ?>

<h2 class="page-title">Edit Founding</h2>

<script>
function closePopup() {
    // Redirect to founding.php when cancel is clicked
    window.location.href = 'founding.php';
}

// Add other JavaScript functionality as needed
</script>
<div id="popupForm" class="fixed inset-0 flex items-center justify-center z-40 bg-gray-900 bg-opacity-50">
    <div class="popup-container bg-white p-6 rounded-lg shadow-lg max-w-lg w-full overflow-y-auto">
        <h2 class="text-2xl font-semibold mb-4">Live Birth Information</h2>
        <form class="space-y-4" method="POST" action="./functions/update_founding.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">

<!-- Registry Number and Contact -->
<fieldset class="space-y-4">
    <legend class="text-lg font-medium mb-2">Registry Information</legend>
    <div>
        <label for="registry_no" class="block text-sm font-medium mb-1">Registry No:</label>
        <input type="text" id="registry_no" name="registry_no" value="<?php echo htmlspecialchars($data['registry_no']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500" required>
    </div>
    <div>
        <label for="contact_no" class="block text-sm font-medium mb-1">Contact No:</label>
        <input type="text" id="contact_no" name="informant_contact" value="<?php echo htmlspecialchars($data['contact_no']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500" required>
    </div>
    <div>
        <label for="date_time" class="block text-sm font-medium mb-1">Date and Time:</label>
        <input type="datetime-local" id="date_time" name="date_time" value="<?php echo htmlspecialchars(date('Y-m-d\TH:i', strtotime($data['date_time']))); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500" required>
    </div>
</fieldset>

<!-- Founder Information -->
<fieldset class="space-y-4">
    <legend class="text-lg font-medium mb-2">Founder Information</legend>
    <div>
        <label for="founder_last_name" class="block text-sm font-medium mb-1">Last Name:</label>
        <input type="text" id="founder_last_name" name="founder_last_name" value="<?php echo htmlspecialchars($data['founder_last_name']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500" required>
    </div>
    <div>
        <label for="founder_first_name" class="block text-sm font-medium mb-1">First Name:</label>
        <input type="text" id="founder_first_name" name="founder_first_name" value="<?php echo htmlspecialchars($data['founder_first_name']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500" required>
    </div>
    <div>
        <label for="founder_middle_name" class="block text-sm font-medium mb-1">Middle Name:</label>
        <input type="text" id="founder_middle_name" name="founder_middle_name" value="<?php echo htmlspecialchars($data['founder_middle_name']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
    </div>
    <div>
        <label for="founder_occupation" class="block text-sm font-medium mb-1">Occupation:</label>
        <input type="text" id="founder_occupation" name="founder_occupation" value="<?php echo htmlspecialchars($data['founder_occupation']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
    </div>
    <div>
        <label for="founder_street" class="block text-sm font-medium mb-1">Street:</label>
        <input type="text" id="founder_street" name="founder_street" value="<?php echo htmlspecialchars($data['founder_street']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
    </div>
    <div>
        <label for="founder_province" class="block text-sm font-medium mb-1">Province:</label>
        <input type="text" id="founder_province" name="founder_province" value="<?php echo htmlspecialchars($data['founder_province']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
    </div>
    <div>
        <label for="founder_barangay" class="block text-sm font-medium mb-1">Barangay:</label>
        <input type="text" id="founder_barangay" name="founder_barangay" value="<?php echo htmlspecialchars($data['founder_barangay']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
    </div>
    <div>
        <label for="founder_zipcode" class="block text-sm font-medium mb-1">Zip Code:</label>
        <input type="text" id="founder_zipcode" name="founder_zipcode" value="<?php echo htmlspecialchars($data['founder_zipcode']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
    </div>
</fieldset>

<!-- Informant Information -->
<fieldset class="space-y-4">
    <legend class="text-lg font-medium mb-2">Informant Information</legend>
    <div>
        <label for="informant_last_name" class="block text-sm font-medium mb-1">Last Name:</label>
        <input type="text" id="informant_last_name" name="informant_last_name" value="<?php echo htmlspecialchars($data['informant_last_name']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500" required>
    </div>
    <div>
        <label for="informant_first_name" class="block text-sm font-medium mb-1">First Name:</label>
        <input type="text" id="informant_first_name" name="informant_first_name" value="<?php echo htmlspecialchars($data['informant_first_name']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500" required>
    </div>
    <div>
        <label for="informant_middle_name" class="block text-sm font-medium mb-1">Middle Name:</label>
        <input type="text" id="informant_middle_name" name="informant_middle_name" value="<?php echo htmlspecialchars($data['informant_middle_name']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
    </div>
    <div>
        <label for="informant_occupation" class="block text-sm font-medium mb-1">Occupation:</label>
        <input type="text" id="informant_occupation" name="informant_occupation" value="<?php echo htmlspecialchars($data['informant_occupation']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
    </div>
    <div>
        <label for="relationship_to_founder" class="block text-sm font-medium mb-1">Relationship to Founder:</label>
        <input type="text" id="relationship_to_founder" name="relationship_to_founder" value="<?php echo htmlspecialchars($data['relationship_to_founder']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
    </div>
    <div>
        <label for="founder_street" class="block text-sm font-medium mb-1">Street:</label>
        <input type="text" id="founder_street" name="founder_street" value="<?php echo htmlspecialchars($data['founder_street']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md sm focus:outline-none focus:ring-1 focus:ring-blue-500">
    </div>
    <div>
        <label for="founder_province" class="block text-sm font-medium mb-1">Province:</label>
        <input type="text" id="founder_province" name="founder_province" value="<?php echo htmlspecialchars($data['founder_province']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
    </div>
    <div>
        <label for="founder_barangay" class="block text-sm font-medium mb-1">Barangay:</label>
        <input type="text" id="informant_barangay" name="founder_barangay" value="<?php echo htmlspecialchars($data['founder_barangay']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
    </div>
    <div>
        <label for="informant_zipcode" class="block text-sm font-medium mb-1">Zip Code:</label>
        <input type="text" id="informant_zipcode" name="founder_zipcode" value="<?php echo htmlspecialchars($data['founder_zipcode']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
    </div>
</fieldset>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closePopup()" class="px-4 py-2 bg-gray-500 text-white rounded-md">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Save</button>
            </div>
        </form>
    </div>
</div>


