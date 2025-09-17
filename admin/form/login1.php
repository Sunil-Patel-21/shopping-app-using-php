<?php

$con = mysqli_connect("localhost", "root", "", "ecommerce",3307);

$A_name = $_POST["username"];
$A_password = $_POST["userpassword"];

$result = mysqli_query($con, "SELECT * FROM `admin` WHERE username='$A_name' AND userpassword='$A_password'");

session_start();

// mysql_num_rows will count table rows
if (mysqli_num_rows($result) > 0) {
    $_SESSION['admin'] = $A_name;
    echo "
    <script>
    alert('Login Successfully');
    window.location.href='../myStore.php';   // used to redirect the page
    </script>
    ";
} else {
    // header("location:login.php");
      echo "
    <script>
    alert('Invalid Username or Password');
    window.location.href='login.php';
    </script>
    ";
}

?>