<?php 
include "../../config/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
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

    $query = "UPDATE birth_registration 
              SET registry_no = '$registry_no', name_last = '$name_last', name_first = '$name_first', name_middle = '$name_middle', place_birth_city = '$place_birth_city', place_birth_province = '$place_birth_province', place_birth_street = '$place_birth_street', place_birth_barangay = '$place_birth_barangay', date_of_birth = '$date_of_birth', gender = '$gender', father_last = '$father_last', father_first = '$father_first', father_middle = '$father_middle', mother_last = '$mother_last', mother_first = '$mother_first', mother_middle = '$mother_middle', contact_no = '$contact_no' 
              WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: ../register-birth.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
