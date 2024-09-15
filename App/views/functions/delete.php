<?php 
include "../../config/config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "DELETE FROM birth_registration WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        header("Location: ../register-birth.php"); // Redirect to the main page after successful deletion
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
