<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Shopping Cart Admin</title>

  <!-- bootstrap cdn  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <!-- awesome cdn  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"/>

  <style>
    body {
      /* Updated background image with format parameters for reliability */
      background: url("https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80") no-repeat center center/cover;
      min-height: 100vh;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      color: white;
      position: relative;
    }

    /* dark overlay */
    body::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      z-index: 0;
    }

    .navbar,
    .dashboard,
    h2 {
      position: relative;
      z-index: 1;
    }

    .navbar {
      box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.4);
      animation: slideDown 0.8s ease-in-out;
    }

    @keyframes slideDown {
      from { transform: translateY(-100%); }
      to   { transform: translateY(0); }
    }

    h2 {
      margin-top: 30px;
      font-weight: bold;
      letter-spacing: 1px;
      animation: fadeIn 1.2s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; } to { opacity: 1; }
    }

    .dashboard {
      margin-top: 50px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
      padding: 20px;
    }

    .card {
      background: rgba(255,255,255,0.08);
      border: none;
      border-radius: 15px;
      overflow: hidden;
      backdrop-filter: blur(6px);
      transition: all 0.3s ease-in-out;
    }

    .card:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 20px rgba(0,0,0,0.5);
    }

    .card img {
      height: 160px;
      object-fit: cover;
      width: 100%;
      display:block;
    }

    /* ===== Button Styling ===== */
    .btn-custom {
      background: linear-gradient(135deg, #e74c3c, #c0392b);
      color: white;
      font-weight: bold;
      font-size: 16px;
      padding: 12px 28px;
      border-radius: 50px;
      transition: all 0.3s ease-in-out;
      border: none;
      position: relative;
      overflow: hidden;
      z-index: 1;
    }

    /* Button Glow + Hover */
    .btn-custom:hover {
      background: linear-gradient(135deg, #ff6f61, #d63031);
      transform: translateY(-4px) scale(1.03);
      box-shadow: 0px 6px 18px rgba(255,99,71,0.5);
    }

    /* Ripple Effect */
    .btn-custom::after {
      content: "";
      position: absolute;
      width: 300%;
      height: 300%;
      top: 50%;
      left: 50%;
      transform: translate(-50%,-50%) scale(0);
      background: rgba(255,255,255,0.28);
      border-radius: 50%;
      z-index: 0;
      transition: transform 0.6s ease-out;
    }

    .btn-custom:active::after {
      transform: translate(-50%,-50%) scale(1);
      transition: 0s;
    }

    .btn-custom i { margin-right: 8px; }
  </style>
</head>

<!-- session -->
<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("location:form/login.php");
}
?>

<body>
  <!-- navbar -->
  <nav class="navbar navbar-dark bg-dark px-4">
    <div class="container-fluid text-white d-flex justify-content-between align-items-center">
      <a class="navbar-brand d-flex align-items-center gap-2">
        <i class="fa-solid fa-cart-shopping"></i>
        <span class="fs-5">Swift Cart</span>
      </a>

      <div class="fw-bold">
        <i class="fa-solid fa-user-tie"></i>
        Hello, <?php echo $_SESSION['admin']; ?> |
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        <a href="form/logout.php" class="text-white text-decoration-none">Logout</a> |
        <a href="" class="text-white text-decoration-none">UserPanel</a>
      </div>
    </div>
  </nav>

  <!-- dashboard heading -->
  <div>
    <h2 class="text-center">Dashboard</h2>
  </div>

  <!-- dashboard cards -->
  <div class="dashboard container">
    <!-- Add Post (updated Unsplash URL + fallback) -->
    <div class="card text-center text-white">
      <img
        src="https://tse3.mm.bing.net/th/id/OIP.scDgqBLkwRgJaIpjrq4qXwHaD5?pid=Api&h=220&P=0"
        alt="Add Post"
        loading="lazy"
        onerror="this.onerror=null;this.src='https://picsum.photos/800/460?random=21';"
      />
      
      <div class="card-body">
        <h5 class="card-title fw-bold">Add Post</h5>
        <p class="card-text">Create and manage new product posts for your shopping cart.</p>
        <a href="product/index.php" class="btn btn-custom">
          <i class="fa-solid fa-plus"></i> Add Post
        </a>
      </div>
    </div>

    <!-- Users (updated Unsplash URL + fallback) -->
    <div class="card text-center text-white">
      <img
        src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?ixlib=rb-4.0.3&auto=format&fit=crop&w=1400&q=80"
        alt="Users"
        loading="lazy"
       
      />
      <div class="card-body">
        <h5 class="card-title fw-bold">Users</h5>
        <p class="card-text">View and manage registered users of your shopping cart.</p>
        <a href="user.php" class="btn btn-custom">
          <i class="fa-solid fa-users"></i> Manage Users
        </a>
      </div>
    </div>
  </div>

  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
