<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Page</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
</head>

<body>

<?php
if (!isset($_GET['ID']) || !is_numeric($_GET['ID'])) {
    die("Invalid or missing ID.");
}

$id = $_GET['ID'];
include "Config.php";

// Fetch existing product
$record = mysqli_query($con, "SELECT * FROM tblproduct WHERE Id=$id");

if (!$record) {
    die("Query failed: " . mysqli_error($con));
}

$data = mysqli_fetch_array($record);
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 m-auto border border-primary mt-3 p-4 rounded">
            <form action="update.php?ID=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <p class="text-center fw-bold fs-3 text-info">Product Update Page</p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Name:</label>
                    <input name="Pname" value="<?php echo htmlspecialchars($data['PName']); ?>" type="text" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Price:</label>
                    <input name="Pprice" value="<?php echo htmlspecialchars($data['PPrice']); ?>" type="number" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Add Product Image:</label>
                    <input type="file" name="Pimage" class="form-control" onchange="previewImage(event)"><br>

                    <label class="form-label">Current Image:</label><br>
                    <img id="currentImage" src="<?php echo htmlspecialchars($data['PImage']); ?>" alt="Current Image" height="100" width="100" class="mb-2"><br>

                    <label class="form-label">Preview New Image:</label><br>
                    <img id="preview" src="#" alt="New Preview" height="100" width="100" style="display:none;" />
                </div>

                <div class="mb-3">
                    <label class="form-label">Select Page Category:</label>
                    <select class="form-select" name="Pages">
                        <option value="Home" <?php if ($data['PCategory'] == 'Home') echo 'selected'; ?>>Home</option>
                        <option value="Laptop" <?php if ($data['PCategory'] == 'Laptop') echo 'selected'; ?>>Laptop</option>
                        <option value="Bag" <?php if ($data['PCategory'] == 'Bag') echo 'selected'; ?>>Bag</option>
                        <option value="Mobile" <?php if ($data['PCategory'] == 'Mobile') echo 'selected'; ?>>Mobile</option>
                    </select>
                </div>

                <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />

                <button name="update" class="bg-danger fs-4 fw-bold my-3 form-control text-white border-0">Update</button>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $product_name = $_POST["Pname"];
    $product_price = $_POST["Pprice"];
    $product_category = $_POST["Pages"];

    if (!empty($_FILES["Pimage"]["name"])) {
        $image_loc = $_FILES["Pimage"]["tmp_name"];
        $image_name = $_FILES["Pimage"]["name"];
        $img_des = "Uploadimage/" . $image_name;
        move_uploaded_file($image_loc, $img_des);
    } else {
        $img_des = $data['PImage'];
    }

    include "Config.php";
    $update = mysqli_query($con, "UPDATE `tblproduct` SET 
        `PName`='$product_name',
        `PPrice`='$product_price',
        `PImage`='$img_des',
        `PCategory`='$product_category'
        WHERE Id=$id");

    if ($update) {
        header("Location: index.php");
        exit();
    } else {
        echo "<div class='text-center text-danger fw-bold'>Update Failed: " . mysqli_error($con) . "</div>";
    }
}
?>

<!-- JS: Hide current image and show preview -->
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview');
        const currentImage = document.getElementById('currentImage');

        if (file) {
            const imageUrl = URL.createObjectURL(file);
            preview.src = imageUrl;
            preview.style.display = 'inline-block';
            currentImage.style.display = 'none';
        } else {
            preview.src = "#";
            preview.style.display = 'none';
            currentImage.style.display = 'inline-block';
        }
    }
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>

</body>
</html>
