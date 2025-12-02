<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8"> <!-- Set character encoding -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive layout -->
  <title>Mobile Page</title>

  <?php include 'header.php'; ?> <!-- Include Header (Navbar + CSS) -->

  <style>
    /* Import Google Font */
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap');

    /* CSS Variables */
    :root {
      --primary: #007bff;
      --secondary: #ff4f81;
      --highlight: #ff9800;
      --white: #ffffff;
      --card-shadow: rgba(0, 0, 0, 0.1);
    }

    /* Reset all elements */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Background with animation */
    body {
      font-family: 'Quicksand', sans-serif;
      background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
        url('https://images.unsplash.com/photo-1523413651479-597eb2da0ad6?auto=format&fit=crop&w=1950&q=80') 
        no-repeat center center/cover;
      animation: bgAnimation 60s linear infinite;
    }

    /* Background sliding animation */
    @keyframes bgAnimation {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .container {
      margin-top: 80px; /* Space from navbar */
    }

    /* Page heading style */
    h1 {
      text-align: center;
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 30px;
      color: var(--highlight);
      text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
      opacity: 0;
      animation: fadeInDown 1s ease forwards; /* Fade slide animation */
    }

    @keyframes fadeInDown {
      0% { transform: translateY(-30px); opacity: 0; }
      100% { transform: translateY(0); opacity: 1; }
    }

    /* Product card design */
    .card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(5px);
      border-radius: 16px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
      opacity: 0;
      animation: fadeInUp 0.8s ease forwards; /* Fade-up animation */
    }

    /* Hover effect */
    .card:hover {
      transform: translateY(-10px) scale(1.03);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.25);
    }

    /* Animation for card reveal */
    @keyframes fadeInUp {
      0% { transform: translateY(30px); opacity: 0; }
      100% { transform: translateY(0); opacity: 1; }
    }

    /* Product image style */
    .product-img {
      height: 220px;
      width: 100%;
      object-fit: cover;
      border-bottom: 1px solid #ddd;
      transition: transform 0.5s ease; /* Zoom animation */
    }

    /* Zoom on hover */
    .card:hover .product-img {
      transform: scale(1.1);
    }

    /* Card title (product name) */
    .card-title {
      font-size: 1.3rem;
      font-weight: 700;
      color: var(--secondary);
    }

    /* Card text (product price) */
    .card-text {
      font-size: 1.1rem;
      color: var(--primary);
      font-weight: 600;
    }

    /* Quantity Input */
    input[type="number"] {
      width: 80%;
      padding: 8px;
      border-radius: 8px;
      border: 1px solid #ccc;
      margin-top: 10px;
      outline: none;
    }

    /* Add to Cart button */
    .btn-danger {
      background-color: var(--secondary);
      color: #fff;
      border: none;
      padding: 10px 0;
      font-weight: bold;
      border-radius: 8px;
      transition: 0.3s ease;
    }

    /* Button hover */
    .btn-danger:hover {
      background-color: #e63c6f;
      transform: scale(1.05);
      box-shadow: 0 0 15px rgba(255, 79, 129, 0.7);
    }

    /* Delay animation for each card */
    .row > div {
      animation: fadeInUp 0.8s ease forwards;
    }
  </style>
</head>

<body>

  <div class="container">
    <!-- Main heading -->
    <h1 class="text-white m-5">🛍️ Explore Our Mobile Section</h1>

    <div class="row g-4">
      <?php
      include 'Config.php'; // Include database connection file

      $Result = mysqli_query($con, "SELECT * FROM tblproduct"); // Fetch all products
      $delay = 0; // Delay for animation

      // Loop through products
      while ($row = mysqli_fetch_array($Result)) {

        // Display only products where category is Mobile
        if ($row['PCategory'] === 'Mobile') {

          // Display product card HTML
          echo "
            <div class='col-md-6 col-lg-3' style='animation-delay: {$delay}s'>
              
              <!-- Add to Cart form -->
              <form action='Insertcart.php' method='post'>
                
                <div class='card h-100'>

                  <!-- Product image -->
                  <img src='../admin/product/$row[PImage]' class='card-img-top product-img' alt='$row[PName]'>

                  <div class='card-body text-center'>

                    <!-- Product name -->
                    <h5 class='card-title'>$row[PName]</h5>

                    <!-- Product price -->
                    <p class='card-text'>₹ $row[PPrice]</p>

                    <!-- Hidden inputs for product name & price -->
                    <input type='hidden' name='PName' value='$row[PName]' />
                    <input type='hidden' name='PPrice' value='$row[PPrice]' />

                    <!-- Quantity -->
                    <input type='number' name='PQuantity' class='form-control mx-auto' min='1' max='20' placeholder='Quantity'>

                    <!-- Add to Cart button -->
                    <input type='submit' name='addCart' class='btn btn-danger mt-3 w-75 mx-auto d-block' value='Add to Cart'>
                  </div>

                </div>

              </form>
            </div>";

          $delay += 0.2; // Increase delay for next card
        }
      }
      ?>
    </div>
  </div>

  <?php include 'footer.php'; ?> <!-- Include Footer -->

</body>

</html>
