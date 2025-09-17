<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Product Page</title>

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">

  <style>
    /* Background with dark overlay */
    body {
      background: url("https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80") no-repeat center center/cover;
      min-height: 100vh;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      color: white;
      position: relative;
    }

    body::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      z-index: 0;
    }

    .container {
      position: relative;
      z-index: 1;
    }

    /* Form styling */
    form {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(6px);
      padding: 25px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
      margin-top: 30px;
    }

    form p {
      margin-bottom: 20px;
    }

    input,
    select {
      border-radius: 50px;
      padding: 10px 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
      border: none;
      outline: none;
    }

    /* Upload button */
    button {
      background: linear-gradient(135deg, #e74c3c, #c0392b);
      color: white;
      border-radius: 50px;
      padding: 10px 20px;
      font-weight: bold;
      border: none;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    button:hover {
      transform: translateY(-3px) scale(1.03);
      box-shadow: 0 6px 14px rgba(255, 99, 71, 0.5);
      background: linear-gradient(135deg, #ff6f61, #d63031);
    }

    button::after {
      content: "";
      position: absolute;
      width: 300%;
      height: 300%;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) scale(0);
      background: rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      transition: transform 0.6s ease-out;
      z-index: 0;
    }

    button:active::after {
      transform: translate(-50%, -50%) scale(1);
      transition: 0s;
    }

    /* Table styling */
    table {
      width: 100%;
      background: rgba(128, 128, 128, 0.2); /* gray glass effect */
      backdrop-filter: blur(6px);
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
    }

    thead {
      background: rgba(100, 100, 100, 0.4);
      color: #fff;
    }

    tbody tr {
      transition: all 0.3s ease;
    }

    tbody tr:hover {
      background: rgba(150, 150, 150, 0.25);
      transform: scale(1.01);
    }

    th,
    td {
      vertical-align: middle !important;
      color: #fff;
    }

    /* Action buttons */
    .btn-danger,
    .btn-warning {
      border-radius: 30px;
      transition: all 0.3s ease-in-out;
      position: relative;
      overflow: hidden;
      border: none;
      color: #fff;
    }

    .btn-danger {
      background: linear-gradient(135deg, #e74c3c, #c0392b);
    }

    .btn-danger:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 14px rgba(255, 99, 71, 0.5);
      background: linear-gradient(135deg, #ff6f61, #d63031);
    }

    .btn-warning {
      background: linear-gradient(135deg, #f1c40f, #d4ac0d);
    }

    .btn-warning:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 14px rgba(241, 196, 15, 0.5);
      background: linear-gradient(135deg, #f7dc6f, #d4ac0d);
    }

    img {
      border-radius: 10px;
      object-fit: cover;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 m-auto">
        <form action="insert.php" method="post" enctype="multipart/form-data">
          <p class="text-center fw-bold fs-3 text-warning">Product Details</p>

          <div class="mb-3">
            <label class="form-label">Product Name:</label>
            <input name="Pname" placeholder="Enter product name" type="text" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">Product Price:</label>
            <input name="Pprice" placeholder="Enter product price" type="number" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">Add Product Image:</label>
            <input type="file" name="Pimage" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">Select Page Category:</label>
            <select class="form-select" name="Pages">
              <option value="Home">Home</option>
              <option value="Laptop">Laptop</option>
              <option value="Bag">Bag</option>
              <option value="Mobile">Mobile</option>
            </select>
          </div>

          <button name="submit">Upload</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Product Table -->
  <div class="container">
    <div class="row">
      <div class="col-md-10 m-auto">
        <table class="table table-bordered table-hover text-center my-5">
          <thead>
            <tr>
              <th>Sr.No</th>
              <th>Product Name</th>
              <th>Product Price</th>
              <th>Product Image</th>
              <th>Product Category</th>
              <th>Delete</th>
              <th>Update</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include "Config.php";
            $Record = mysqli_query($con, "SELECT * FROM `tblproduct`");
            $count = 1;
            while ($row = mysqli_fetch_array($Record)) {
              echo "
              <tr>
                <td>$count</td>
                <td>$row[PName]</td>
                <td>$row[PPrice]</td>
                <td><img src='$row[PImage]' height='90px' width='90px'></td>
                <td>$row[PCategory]</td>
                <td><a href='delete.php?ID=$row[id]' class='btn btn-danger'><i class='fa fa-trash'></i></a></td>
                <td><a href='update.php?ID=$row[id]' class='btn btn-warning'><i class='fa fa-edit'></i></a></td>
              </tr>
              ";
              $count++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
