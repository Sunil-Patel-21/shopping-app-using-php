<?php 

if(isset($_POST['submit'])){
    $con = mysqli_connect("localhost","root","","ecommerce");

    $Name = $_POST["name"];
    $Email = $_POST["email"];
    $Number = $_POST["number"];
    $Password = $_POST["password"];

    



    $Dup_Email =mysqli_query($con,"SELECT * FROM `tbluser` WHERE Email='$Email'");
    $Dup_username =mysqli_query($con,"SELECT * FROM `tbluser` WHERE UserName='$Name'");

    if (mysqli_num_rows($Dup_Email) > 0) {
        echo "
            <script>
            alert('Email already exist');
            window.location.href='register.php';
            </script>
            ";
            exit;
    }
    if (mysqli_num_rows($Dup_username) > 0) {
        echo "
            <script>
            alert('Username already exist');
            window.location.href='register.php';
            </script>
            ";
            exit;
    }

    $result = mysqli_query($con,"INSERT INTO `tbluser`( `UserName`, `Email`, `Number`, `Password`) 
    VALUES ('$Name','$Email','$Number','$Password')");

     echo "
            <script>
            alert('User register successfully');
            window.location.href='login.php';
            </script>
            ";



}
?>