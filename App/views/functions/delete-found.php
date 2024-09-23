<?php
include "../../config/config.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Sanitize input to prevent SQL Injection
    $id = mysqli_real_escape_string($conn, $id);

    $query = "DELETE FROM live_births WHERE id = $id";

    if(mysqli_query($conn, $query)) {
       
        header("Location: ../founding.php");
        exit();
    } else {
        echo "ERROR: " . $query . "<br>" . mysqli_error($conn);
    } 
}
?>
