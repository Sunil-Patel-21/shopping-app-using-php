<?php
// Start the session to access session variables
session_start();

// Destroy all session data (logs out the user/admin)
session_destroy();

// Redirect to the login page after logout
header("location:login.php");
?>
