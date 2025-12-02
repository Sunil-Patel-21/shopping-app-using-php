<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Count items in cart, default to 0
$count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shopping Cart Header</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome (stable version) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        :root {
            --bg-dark: #1e1e2f;
            --primary: #ff4c60;
            --light: #f9f9f9;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--bg-dark);
            color: var(--light);
            margin: 0;
        }

        /* Navbar Styles */
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
            margin-right: 1rem;
            text-decoration: none;
            transition: 0.3s;
        }

        .navbar a:hover {
            color: var(--primary);
        }

        /* Search input */
        .navbar .search-bar {
            max-width: 200px;
        }

        .navbar .search-bar input {
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 5px 8px;
            outline: none;
        }

        /* Category Navigation */
        .category-nav {
            background-color: #2a2a3d;
            text-align: center;
            padding: 0.8rem 0;
        }

        .category-nav a {
            margin: 0 1rem;
            padding: 0.6rem 1.2rem;
            font-weight: 600;
            color: var(--light);
            border-radius: 8px;
            transition: 0.3s;
        }

        .category-nav a:hover {
            color: var(--primary);
            background-color: #1a1a2b;
            text-decoration: none;
        }

        @media(max-width:768px) {
            .navbar {
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
            }

            .category-nav a {
                display: block;
                margin: 0.5rem auto;
                width: 80%;
            }

            .navbar .search-bar {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- Main Navbar -->
    <nav class="navbar d-flex justify-content-between align-items-center flex-wrap">
        <!-- Brand -->
        <a class="navbar-brand" href="index.php">🛒 Swift Cart</a>



        <!-- User & Cart Info -->
        <div class="user-info d-flex align-items-center flex-wrap gap-2">
            <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
            <a href="viewCart.php"><i class="fa-solid fa-cart-shopping"></i> Cart (<?php echo $count; ?>)</a>

            <?php if (isset($_SESSION['user'])): ?>
                <span><i class="fa-solid fa-user"></i> Hello, <?php echo htmlspecialchars($_SESSION['user']); ?></span>
                <a href="form/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            <?php else: ?>
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

</body>

</html>
