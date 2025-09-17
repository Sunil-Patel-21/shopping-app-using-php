<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bag Page</title>

  <?php include 'header.php'; ?>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap');

    :root {
      --primary: #007bff;
      --secondary: #ff4f81;
      --highlight: #ff9800;
      --white: #ffffff;
      --card-shadow: rgba(0, 0, 0, 0.1);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

body {
  font-family: 'Quicksand', sans-serif;
background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)),
url('https://images.unsplash.com/photo-1521295121783-8a321d551ad2?auto=format&fit=crop&w=1950&q=80') no-repeat center center/cover;

  animation: bgAnimation 60s linear infinite;
}

    @keyframes bgAnimation {
      0% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }

      100% {
        background-position: 0% 50%;
      }
    }

    .container {
      margin-top: 80px;
    }

    h1 {
      text-align: center;
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 30px;
      color: var(--highlight);
      text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
      animation: fadeInDown 1s ease forwards;
      opacity: 0;
    }

    @keyframes fadeInDown {
      0% {
        transform: translateY(-30px);
        opacity: 0;
      }

      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(5px);
      border-radius: 16px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      transition: all 0.3s ease, transform 0.5s ease, box-shadow 0.3s ease;
      opacity: 0;
      animation: fadeInUp 0.8s ease forwards;
    }

    .card:hover {
      transform: translateY(-10px) scale(1.03);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.25);
    }

    @keyframes fadeInUp {
      0% {
        transform: translateY(30px);
        opacity: 0;
      }

      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .product-img {
      height: 220px;
      object-fit: cover;
      width: 100%;
      border-bottom: 1px solid #ddd;
      transition: transform 0.5s ease;
    }

    .card:hover .product-img {
      transform: scale(1.1);
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
      transition: 0.3s ease, box-shadow 0.4s ease;
    }

    .btn-danger:hover {
      background-color: #e63c6f;
      transform: scale(1.05);
      box-shadow: 0 0 15px rgba(255, 79, 129, 0.7), 0 0 25px rgba(255, 79, 129, 0.5);
    }

    .row > div {
      animation: fadeInUp 0.8s ease forwards;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1 class="text-white m-5">🛍️ Explore Our Bag Section</h1>

    <div class="row g-4">
      <?php
      include 'Config.php';

      $Result = mysqli_query($con, "SELECT * FROM tblproduct");
      $delay = 0;
      while ($row = mysqli_fetch_array($Result)) {
        if ($row['PCategory'] === 'Bag') {
          echo "
            <div class='col-md-6 col-lg-3' style='animation-delay: {$delay}s'>
              <form action='Insertcart.php' method='post'>
                <div class='card h-100'>
                  <img src='../admin/product/$row[PImage]' class='card-img-top product-img' alt='$row[PName]'>
                  <div class='card-body text-center'>
                    <h5 class='card-title'>$row[PName]</h5>
                    <p class='card-text'>₹ $row[PPrice]</p>
                    <input type='hidden'name='PName' value='$row[PName]' />
                    <input type='hidden'name='PPrice' value='$row[PPrice]' />
                    <input type='number' name='PQuantity' class='form-control mx-auto' min='1' max='20' placeholder='Quantity'>
                    <input type='submit' name='addCart' class='btn btn-danger mt-3 w-75 mx-auto d-block' value='Add to Cart'>
                  </div>
                </div>
              </form>
            </div>";
          $delay += 0.2;
        }
      }
      ?>
    </div>
  </div>

  <?php include 'footer.php'; ?>
</body>

</html>
