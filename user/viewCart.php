<?php
// Start session only if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart Page</title>

    <!-- Include header (Navbar, CSS, etc.) -->
    <?php include 'header.php'; ?>

    <style>
        /* Importing font */
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap');

        /* Page background and animation */
        body {
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
                url('https://images.unsplash.com/photo-1501785888041-2c0f3fa27939?auto=format&fit=crop&w=1950&q=80') no-repeat center center/cover;
            animation: bgAnimation 60s linear infinite;
        }

        /* Smooth background animation */
        @keyframes bgAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Styling for cart heading */
        .custom-heading {
            font-size: 2.5rem;
            font-weight: 600;
            background: rgba(248, 249, 250, 0.85);
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            color: #ffc107;
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeInDown 1s ease forwards;
            opacity: 0;
        }

        /* Heading fade in animation */
        @keyframes fadeInDown {
            0% { transform: translateY(-30px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        /* Table fade-in animation */
        .table-responsive {
            animation: fadeInUp 1s ease forwards;
            opacity: 0;
        }

        @keyframes fadeInUp {
            0% { transform: translateY(30px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        /* Table header styling */
        thead.bg-danger {
            background-color: #dc3545 !important;
        }

        /* Quantity input box */
        .form-control {
            max-width: 80px;
            margin: 0 auto;
            padding: 0.25rem 0.5rem;
            text-align: center;
        }

        /* Button hover glow effects */
        .btn-warning:hover { box-shadow: 0 0 10px rgba(255, 193, 7, 0.7); }
        .btn-danger:hover { box-shadow: 0 0 10px rgba(220, 53, 69, 0.7); }
        .btn-success:hover { box-shadow: 0 0 10px rgba(40, 167, 69, 0.7); }
    </style>
</head>

<body>

    <!-- Page Heading -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-5 p-3 rounded shadow-sm custom-heading">
                    🛒 My Cart
                </h1>
            </div>
        </div>
    </div>

    <!-- Cart Table -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-9">
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">

                        <!-- Table Header -->
                        <thead class="bg-danger text-white fs-5">
                            <tr>
                                <th>Sr No.</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            // Initialize total and index
                            $total = 0;
                            $i = 0;

                            // If cart exists and has items
                            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {

                                // Loop through all cart items
                                foreach ($_SESSION['cart'] as $key => $value) {

                                    // Sanitize values
                                    $productName = htmlspecialchars($value['productName']);
                                    $productPrice = (float)$value['productPrice'];
                                    $productQuantity = (int)$value['productQuantity'];

                                    // Calculate row total
                                    $productTotal = $productPrice * $productQuantity;

                                    // Add to grand total
                                    $total += $productTotal;

                                    // Serial number
                                    $i = $key + 1;

                                    // Display each cart row
                                    echo "
                                    <tr>
                                        <!-- Form for update & delete actions -->
                                        <form action='Insertcart.php' method='post'>

                                            <td>$i</td>

                                            <!-- Product name -->
                                            <td>
                                                <input type='hidden' name='PName' value='$productName' />
                                                $productName
                                            </td>

                                            <!-- Product price -->
                                            <td>
                                                <input type='hidden' name='PPrice' value='$productPrice' />
                                                ₹ $productPrice
                                            </td>

                                            <!-- Quantity input -->
                                            <td>
                                                <input type='number' name='PQuantity' min='1' value='$productQuantity' class='form-control'/>
                                            </td>

                                            <!-- Total price of this item -->
                                            <td>₹ $productTotal</td>

                                            <!-- Update button -->
                                            <td>
                                                <button class='btn btn-warning btn-sm' name='update'>Update</button>
                                            </td>

                                            <!-- Delete button -->
                                            <td>
                                                <button class='btn btn-danger btn-sm' name='remove'>Delete</button>
                                            </td>

                                            <!-- Hidden name to identify item -->
                                            <input type='hidden' name='item' value='$productName' />
                                        </form>
                                    </tr>";
                                }

                                // Show final total and checkout button
                                echo "
                                <tr class='fw-bold'>
                                    <td colspan='4'><h5>Total</h5></td>
                                    <td colspan='3'>
                                        <h5>₹ $total</h5>

                                        <!-- Checkout button -->
                                        <a href='checkout.php' class='btn btn-success btn-lg mt-2'>
                                            Proceed to Checkout
                                        </a>
                                    </td>
                                </tr>";
                            } else {
                                // If cart is empty
                                echo "
                                <tr>
                                    <td colspan='7'><h5>Cart is empty.</h5></td>
                                </tr>";
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>
