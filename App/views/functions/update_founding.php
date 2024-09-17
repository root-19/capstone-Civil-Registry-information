<?php
include "../../config/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure 'id' is set
    if (!isset($_POST['id'])) {
        echo "ID is missing.";
        exit();
    }

    $id = $_POST['id'];

   

    // Get and sanitize form data
    $registry_no = mysqli_real_escape_string($conn, $_POST['registry_no']);
    $contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);
    $date_time = date('Y-m-d H:i:s'); // Current datetime

    $founder_last_name = mysqli_real_escape_string($conn, $_POST['founder_last_name']);
    $founder_first_name = mysqli_real_escape_string($conn, $_POST['founder_first_name']);
    $founder_middle_name = mysqli_real_escape_string($conn, $_POST['founder_middle_name']);
    $founder_occupation = mysqli_real_escape_string($conn, $_POST['founder_occupation']);
    $founder_street = mysqli_real_escape_string($conn, $_POST['founder_street']);
    $founder_province = mysqli_real_escape_string($conn, $_POST['founder_province']);
    $founder_barangay = mysqli_real_escape_string($conn, $_POST['founder_barangay']);
    $founder_zipcode = mysqli_real_escape_string($conn, $_POST['founder_zipcode']);

    $informant_last_name = mysqli_real_escape_string($conn, $_POST['informant_last_name']);
    $informant_first_name = mysqli_real_escape_string($conn, $_POST['informant_first_name']);
    $informant_middle_name = mysqli_real_escape_string($conn, $_POST['informant_middle_name']);
    $informant_occupation = mysqli_real_escape_string($conn, $_POST['informant_occupation']);
    $relationship_to_founder = mysqli_real_escape_string($conn, $_POST['relationship_to_founder']);
    $informant_address = mysqli_real_escape_string($conn, $_POST['informant_address']);
    $informant_contact = mysqli_real_escape_string($conn, $_POST['informant_contact']);

    // Update the database
    $query = "UPDATE live_births SET 
        registry_no='$registry_no',
        contact_no='$contact_no',
        date_time='$date_time',
        founder_last_name='$founder_last_name',
        founder_first_name='$founder_first_name',
        founder_middle_name='$founder_middle_name',
        founder_occupation='$founder_occupation',
        founder_street='$founder_street',
        founder_province='$founder_province',
        founder_barangay='$founder_barangay',
        founder_zipcode='$founder_zipcode',
        informant_last_name='$informant_last_name',
        informant_first_name='$informant_first_name',
        informant_middle_name='$informant_middle_name',
        informant_occupation='$informant_occupation',
        informant_address='$informant_address',
        informant_contact='$informant_contact'
        WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        header("Location: ../founding.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
