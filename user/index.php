<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home Page</title>

  <?php include 'header.php'; ?>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap');

    :root {
      --primary: #007bff;
      --secondary: #ff4f81;
      --highlight: #ff9800;
      --light-bg: #f1f1f1;
      --white: #ffffff;
      --card-shadow: rgba(0, 0, 0, 0.1);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    form{
        position: relative;
    }
    #category{
        position: absolute;
        right: 0;
        top: -55px;
    }

    body {
      background-color: var(--light-bg);
      font-family: 'Quicksand', sans-serif;
      
     
      background: linear-gradient(to bottom, #ff4f81, #0b296bff);
      
    }

    .container {
      margin-top: 80px; /* Prevent overlap with fixed header */
    }

    h1 {
      text-align: center;
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 30px;
      color: var(--highlight);
    }

    .card {
      background: var(--white);
      border-radius: 16px;
      box-shadow: 0 4px 12px var(--card-shadow);
      overflow: hidden;
      transition: all 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 123, 255, 0.2);
    }

    .product-img {
      height: 220px;
      object-fit: cover;
      width: 100%;
      border-bottom: 1px solid #ddd;
    }

    .card-title {
      font-size: 1.3rem;
      font-weight: 700;
      color: var(--secondary);
    }

    .card-text {
      font-size: 1.1rem;
      color: var(--primary);
      font-weight: 600;
    }

    input[type="number"] {
      width: 80%;
      padding: 8px;
      border-radius: 8px;
      border: 1px solid #ccc;
      margin-top: 10px;
      outline: none;
      background: #fff;
      color: #333;
    }

    .btn-danger {
      background-color: var(--secondary);
      color: #fff;
      border: none;
      padding: 10px 0;
      font-weight: bold;
      border-radius: 8px;
      transition: 0.3s ease;
    }

    .btn-danger:hover {
      background-color: #e63c6f;
      transform: scale(1.02);
    }

    .category-filter {
      margin-bottom: 30px;
      text-align: center;
    }

    .category-filter select {
      padding: 10px 15px;
      border-radius: 8px;
      font-size: 1rem;
      border: 1px solid #ccc;
      background: #fff;
      color: #333;
      font-weight: 600;
    }
  </style>
</head>

<body>

  <div class="container">
    <h1 class="text-white">🛍️ Explore Our Products</h1>

    <!-- Category Filter -->
    <div class="category-filter">
      <form method="get">
        <!-- <label class="text-black" for="category" style="margin-right: 10px;">Filter by Category:</label> -->
        <select name="category" id="category" onchange="this.form.submit()">
          <option value="">All</option>
          <option value="Mobile" <?= (isset($_GET['category']) && $_GET['category'] == 'Mobile') ? 'selected' : '' ?>>Mobile</option>
          <option value="Laptop" <?= (isset($_GET['category']) && $_GET['category'] == 'Laptop') ? 'selected' : '' ?>>Laptop</option>
          <option value="Home" <?= (isset($_GET['category']) && $_GET['category'] == 'Home') ? 'selected' : '' ?>>Home</option>
          <option value="Bag" <?= (isset($_GET['category']) && $_GET['category'] == 'Bag') ? 'selected' : '' ?>>Bag</option>
        </select>
      </form>
    </div>

    <!-- Product Grid -->
    <div class="row g-4">
      <?php
      include 'Config.php';
      $filter = isset($_GET['category']) ? $_GET['category'] : '';

      $sql = "SELECT * FROM tblproduct";
      if (!empty($filter)) {
        $sql .= " WHERE PCategory = '$filter'";
      }

      $Result = mysqli_query($con, $sql);

      while ($row = mysqli_fetch_array($Result)) {
        echo "
          <div class='col-sm-6 col-md-4 col-lg-3'>
            <form action='Insertcart.php' method='post'>
              <div class='card h-100'>
                <img src='../admin/product/$row[PImage]' class='product-img' alt='$row[PName]'>
                <div class='card-body text-center'>
                  <h5 class='card-title'>$row[PName]</h5>
                  <p class='card-text'>₹ $row[PPrice]</p>
                  <input type='hidden' name='PName' value='$row[PName]' />
                  <input type='hidden' name='PPrice' value='$row[PPrice]' />
                  <input type='number' name='PQuantity' min='1' max='20' placeholder='Quantity' required>
                  <input type='submit' name='addCart' class='btn btn-danger mt-3 w-75 mx-auto d-block' value='Add to Cart'>
                </div>
              </div>
            </form>
          </div>";
      }
      ?>
    </div>
  </div>

  <?php include 'footer.php'; ?>
</body>

</html>
