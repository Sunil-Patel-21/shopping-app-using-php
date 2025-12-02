<?php
session_start(); // Start the session to access cart data

// Calculate total for checkout
$total = 0;
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    foreach ($_SESSION['cart'] as $value) {
        // Multiply price by quantity for each item
        $total += (float) $value['productPrice'] * (int) $value['productQuantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            /* Background with gradient overlay */
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url('https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=1950&q=80') no-repeat center center/cover;
            font-family: 'Quicksand', sans-serif;
            color: #fff;
        }

        .checkout-box {
            background: rgba(255, 255, 255, 0.9); /* White box with transparency */
            color: #333;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            margin-top: 50px;
        }

        h2 {
            font-weight: 700;
            color: #dc3545; /* Checkout title color */
        }

        .btn-success {
            font-size: 1.1rem;
            padding: 10px 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="checkout-box">
                    <h2 class="text-center mb-4">🛍 Checkout</h2>

                    <?php if ($total > 0): // If cart has items ?>
                        <!-- Display total -->
                        <h4 class="mb-3 text-center">Order Total: <span class="text-success">₹ <?php echo $total; ?></span></h4>

                        <!-- Checkout Form -->
                        <form action="placeorder.php" method="post">
                            <!-- Customer Full Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>

                            <!-- Customer Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>

                            <!-- Customer Phone -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" id="phone" name="phone" class="form-control" required>
                            </div>

                            <!-- Shipping Address -->
                            <div class="mb-3">
                                <label for="address" class="form-label">Shipping Address</label>
                                <textarea id="address" name="address" rows="3" class="form-control" required></textarea>
                            </div>

                            <!-- Payment Method -->
                            <div class="mb-3">
                                <label for="payment" class="form-label">Payment Method</label>
                                <select id="payment" name="payment" class="form-select" required>
                                    <option value="cod">Cash on Delivery</option>
                                    <option value="razorpay">Razorpay</option>
                                    <option value="stripe">Stripe</option>
                                </select>
                            </div>

                            <!-- Hidden total field -->
                            <input type="hidden" name="order_total" value="<?php echo $total; ?>">

                            <!-- Place Order Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Place Order</button>
                            </div>
                        </form>

                    <?php else: // If cart is empty ?>
                        <h4 class="text-center text-warning">
                            Your cart is empty. <a href="index.php">Shop now</a>
                        </h4>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
