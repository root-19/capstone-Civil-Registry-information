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

    /* Grid layout for compact form fields */
    .grid-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .grid-container {
            grid-template-columns: 1fr;
        }
    }

    /* Print Styling */
    @media print {
        body * {
            visibility: hidden;
        }
        #popupForm, #popupForm * {
            visibility: visible;
        }
        #popupForm {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .no-print {
            display: none;
        }
    }
</style>

<?php include "../model/header.php"; ?>

<h2 class="page-title"> Founding Information</h2>

<script>
function closePopup() {
    
    window.location.href = 'founding.php';
}

function printPage(){
    window.print();
}
</script>

<div id="popupForm" class="fixed inset-0 flex items-center justify-center z-40 bg-gray-900 bg-opacity-50">
    <div class="popup-container bg-white p-6 rounded-lg shadow-lg max-w-3xl w-full overflow-y-auto">
        <h2 class="text-2xl font-semibold mb-4">Live Birth Information</h2>
        <form class="space-y-4" method="POST" action="./functions/update_founding.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">

            <!-- Registry Number and Contact -->
            <fieldset class="space-y-4">
                <legend class="text-lg font-medium mb-2">Registry Information</legend>
                <div class="grid-container">
                    <div>
                        <label for="registry_no" class="block text-sm font-medium mb-1">Registry No:</label>
                        <input type="text" id="registry_no" name="registry_no" value="<?php echo htmlspecialchars($data['registry_no']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="contact_no" class="block text-sm font-medium mb-1">Contact No:</label>
                        <input type="text" id="contact_no" name="informant_contact" value="<?php echo htmlspecialchars($data['contact_no']); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                    </div>
                </div>
                <div>
                    <label for="date_time" class="block text-sm font-medium mb-1">Date and Time:</label>
                    <input type="datetime-local" id="date_time" name="date_time" value="<?php echo htmlspecialchars(date('Y-m-d\TH:i', strtotime($data['date_time']))); ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                </div>
            </fieldset>

            <!-- Founder Information -->
            <fieldset class="space-y-4">
                <legend class="text-lg font-medium mb-2">Founder Information</legend>
                <div class="grid-container">
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
                </div>
                <div class="grid-container">
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
                </div>
            </fieldset>

            <!-- Informant Information -->
            <fieldset class="space-y-4">
                <legend class="text-lg font-medium mb-2">Informant Information</legend>
                <div class="grid-container">
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
                </div>
            </fieldset>

            <!-- Form Buttons -->
            <div class="flex justify-between items-center mt-4">
            <button type="button" onclick="printPage()" class="bg-green-500 text-white py-2 px-4 rounded">Print</button>
                <button type="button" onclick="closePopup()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded no-print">Cancel</button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
            </div>
        </form>
    </div>
</div>
