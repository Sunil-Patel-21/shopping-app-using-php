<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Product</title>

<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">

<style>
    body {
        background: url("https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80") no-repeat center center/cover;
        min-height: 100vh;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        color: #fff;
        position: relative;
    }

    body::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.75);
        z-index: 0;
    }

    .container {
        position: relative;
        z-index: 1;
        margin-top: 50px;
    }

    .card-update {
        background: #1e1e1e;
        border-radius: 15px;
        padding: 30px;
    }

    .card-update p {
        text-align: center;
        font-size: 2rem;
        font-weight: 700;
        color: #ff6f61;
        margin-bottom: 25px;
    }

    label {
        font-weight: 600;
        color: #fff;
    }

    input, select {
        border-radius: 50px;
        padding: 12px 20px;
        background: #2b2b2b;
        color: #fff;
        border: 1px solid #444;
        width: 100%;
    }

    input:focus, select:focus {
        outline: none;
        border-color: #ff6f61;
        background: #3a3a3a;
    }

    .btn-update {
        background: linear-gradient(135deg, #ff6f61, #e74c3c);
        color: #fff;
        font-weight: bold;
        border-radius: 50px;
        padding: 12px 25px;
        border: none;
        width: 100%;
        font-size: 1.2rem;
        cursor: pointer;
    }

    .btn-update:hover {
        background: linear-gradient(135deg, #ff8a75, #ff4f3f);
    }

    .img-preview {
        border-radius: 12px;
        object-fit: cover;
        display: block;
        margin-top: 10px;
        height: 100px;
        width: 100px;
    }
</style>
</head>

<body>
<?php
if (!isset($_GET['ID']) || !is_numeric($_GET['ID'])) {
    die("Invalid or missing ID.");
}
$id = $_GET['ID'];
include "Config.php";
$record = mysqli_query($con, "SELECT * FROM tblproduct WHERE Id=$id");
if (!$record) { die("Query failed: " . mysqli_error($con)); }
$data = mysqli_fetch_array($record);
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="card-update">
                <form action="update.php?ID=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                    <p>Update Product</p>

                    <div class="mb-3">
                        <label>Product Name:</label>
                        <input name="Pname" value="<?php echo htmlspecialchars($data['PName']); ?>" type="text" required>
                    </div>

                    <div class="mb-3">
                        <label>Product Price:</label>
                        <input name="Pprice" value="<?php echo htmlspecialchars($data['PPrice']); ?>" type="number" required>
                    </div>

                    <div class="mb-3">
                        <label>Add Product Image:</label>
                        <input type="file" name="Pimage" accept="image/*" onchange="previewImage(event)">
                        <div class="mt-2">
                            <label>Current Image:</label><br>
                            <img id="currentImage" src="<?php echo htmlspecialchars($data['PImage']); ?>" class="img-preview">
                        </div>
                        <div class="mt-2">
                            <label>Preview New Image:</label><br>
                            <img id="preview" src="#" class="img-preview" style="display:none;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Select Page Category:</label>
                        <select name="Pages">
                            <option value="Home" <?php if ($data['PCategory'] == 'Home') echo 'selected'; ?>>Home</option>
                            <option value="Laptop" <?php if ($data['PCategory'] == 'Laptop') echo 'selected'; ?>>Laptop</option>
                            <option value="Bag" <?php if ($data['PCategory'] == 'Bag') echo 'selected'; ?>>Bag</option>
                            <option value="Mobile" <?php if ($data['PCategory'] == 'Mobile') echo 'selected'; ?>>Mobile</option>
                        </select>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
                    <button name="update" class="btn-update">Update</button>
                </form>
            </div>
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
        echo "<div class='text-center text-danger fw-bold mt-3'>Update Failed: " . mysqli_error($con) . "</div>";
    }
}
?>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('preview');
    const current = document.getElementById('currentImage');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'inline-block';
            current.style.display = 'none';
        }
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
        current.style.display = 'inline-block';
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
