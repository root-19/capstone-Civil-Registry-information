<?php

session_start();
session_unset();
session_destroy();

// Add the forward slash at the beginning of the location to ensure proper redirection
header("Location: /index.php");
exit();

?>
