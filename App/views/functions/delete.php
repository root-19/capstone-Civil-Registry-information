<?php 
include "../../config/config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    

    $id = mysqli_real_escape_string($conn, $id); 
    $query = "DELETE FROM birth_registration WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        header("Location: ../register-birth.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

}


