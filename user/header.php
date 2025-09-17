<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shopping Cart Header</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" />

  <style>
    :root {
      --bg-dark: #1e1e2f;
      --primary: #ff4c60;
      --light: #f9f9f9;
      --muted: #b0b0b0;
    }

    body {
      background-color: var(--bg-dark);
      color: var(--light);
      font-family: 'Segoe UI', sans-serif;
    }

    .navbar {
      background-color: var(--bg-dark);
      padding: 1rem 2rem;
      border-bottom: 1px solid #333;
    }

    .navbar-brand {
      color: var(--primary);
      font-weight: bold;
      font-size: 1.8rem;
    }
 

    .navbar a,
    .navbar span {
      color: var(--light);
      font-weight: 500;
      margin-right: 1rem;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .navbar a:hover {
      color: var(--primary);
    }

    .navbar .fa {
      margin-right: 6px;
    }

    .user-info {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap: 0.7rem;
    }

    .category-nav {
      background-color: #2a2a3d;
      text-align: center;
      padding: 0.8rem 0;
    }

    .category-nav a {
      display: inline-block;
      margin: 0 1rem;
      padding: 0.6rem 1.2rem;
      font-size: 1.1rem;
      font-weight: 600;
      color: var(--light);
      border: 2px solid transparent;
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    .category-nav a:hover {
      color: var(--primary);
      background-color: #1a1a2b;
      border-color: var(--primary);
      text-decoration: none;
    }

    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        text-align: center;
      }

      .user-info {
        justify-content: center;
      }

      .category-nav a {
        display: block;
        margin: 0.5rem auto;
        width: 80%;
      }
    }
  </style>
</head>

<body>

  <?php
  session_start();
  $count = 0;
  if (isset($_SESSION['cart'])) {
    $count = count($_SESSION['cart']);
  }
  ?>

  <!-- Top Navbar -->
  <nav class="navbar d-flex justify-content-between align-items-center">
    <a class="navbar-brand" href="index.php">🛒 Swift Cart</a>

    <div class="user-info">
      <a href="index.php" ><i class="fa-solid fa-house"></i> Home</a>
      <a href="viewCart.php"><i class="fa-solid fa-cart-shopping"></i> Cart (<?php echo $count ?>)</a>

      <?php if (isset($_SESSION['user'])) : ?>
        <span><i class="fa-solid fa-user"></i> Hello, <?php echo $_SESSION['user']; ?></span>
        <a href="form/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
      <?php else : ?>
        <a href="form/login.php"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
      <?php endif; ?>

      <a href="../admin/myStore.php"><i class="fa-solid fa-user-gear"></i> Admin</a>
    </div>
  </nav>

  <!-- Category Navigation -->
  <div class="category-nav">
    <a href="index.php">HOME</a>
    <a href="Laptop.php">LAPTOPS</a>
    <a href="Mobile.php">MOBILES</a>
    <a href="Bag.php">BAGS</a>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>