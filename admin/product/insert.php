<?php
// isset will check if the form is submitted with the post method
if (isset($_POST["submit"])) {

    include"Config.php";
    $product_name = $_POST["Pname"];
    $product_price = $_POST["Pprice"];
    $product_image = $_FILES["Pimage"];
    $image_loc = $_FILES["Pimage"]["tmp_name"]; // temporary location
    $image_name = $_FILES["Pimage"]["name"]; // actual name
  
    $img_des = "Uploadimage/".$image_name; // destination of the image
    move_uploaded_file($image_loc, to: "Uploadimage/".$image_name); // uploading image to the folder
    $product_category = $_POST["Pages"];

    // insert_product 
    mysqli_query($con,"INSERT INTO `tblproduct`( `PName`, `PPrice`, `PImage`, `PCategory`) 
    VALUES ('$product_name','$product_price','$img_des','$product_category')");

    header("location:index.php"); // used to redirect the page to index.php
   


}
?>
