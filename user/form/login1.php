<?php 
$Name = $_POST["name"];
$Password = $_POST["password"];

$con = mysqli_connect("localhost","root","","ecommerce");
$result = mysqli_query($con,"SELECT * FROM `tbluser` WHERE (UserName='$Name' OR Email='$Name') AND Password='$Password'");

session_start();

if (mysqli_num_rows($result) > 0) {
    $_SESSION['user'] = $Name;
    echo "
        <script>
        alert('Login Successfully');
        window.location.href='../index.php';
        </script>
        ";
        exit;
}else{
    echo "
        <script>
        alert('Invalid Username or Password');
        window.location.href='login.php';
        </script>
        ";
        exit;
}
?>