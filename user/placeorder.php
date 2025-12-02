<?php
session_start();

/*
|--------------------------------------------------------------------------
| Ensure cart has items before showing order page
|--------------------------------------------------------------------------
*/
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    // If cart is empty, redirect back to cart
    header("Location: cart.php");
    exit();
}

/*
|--------------------------------------------------------------------------
| Calculate the total bill amount
|--------------------------------------------------------------------------
*/
$total = 0;
foreach ($_SESSION['cart'] as $value) {
    // Multiply price × quantity and add to total
    $total += (float) $value['productPrice'] * (int) $value['productQuantity'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Google font */
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap');

        /* Page background */
        body {
            background: linear-gradient(120deg, #f0f2f5, #d9e2ec);
            font-family: 'Quicksand', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Centered order container */
        .order-container {
            max-width: 700px;
            width: 100%;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            animation: fadeIn 0.8s ease-in-out;
        }

        h2 {
            font-weight: 700;
            text-align: center;
            color: #333;
            margin-bottom: 1.5rem;
        }

        /* Summary section */
        .summary {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            background: #fafafa;
        }

        .summary h5 {
            font-weight: 600;
            margin-bottom: 1rem;
            color: #444;
        }

        /* Each item row */
        .list-group-item {
            border: none;
            padding: 0.75rem 0;
            font-size: 1rem;
            color: #555;
        }

        .list-group-item span {
            font-weight: 600;
            color: #000;
        }

        /* Total line */
        .total {
            font-size: 1.25rem;
            font-weight: 700;
            text-align: right;
            margin-bottom: 1.5rem;
            color: #111;
        }

        /* Submit button */
        .btn-primary {
            background: #007bff;
            border: none;
            padding: 12px;
            font-size: 1.1rem;
            border-radius: 10px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
        }

        /* Fade-in animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 576px) {
            .order-container { padding: 1.5rem; }
            .total { font-size: 1.1rem; }
            h2 { font-size: 1.5rem; }
        }
    </style>
</head>

<body>

    <div class="order-container">
        <h2>Order Summary</h2>

        <!-- Items List -->
        <div class="summary">
            <h5>Your Items</h5>
            <ul class="list-group list-group-flush">

                <!-- Loop through cart items -->
                <?php foreach ($_SESSION['cart'] as $value) { ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <!-- Product name -->
                        <?= htmlspecialchars($value['productName']); ?>

                        <!-- Quantity × Price -->
                        <span>
                            <?= (int) $value['productQuantity']; ?> × ₹<?= (float) $value['productPrice']; ?>
                        </span>
                    </li>
                <?php } ?>

            </ul>
        </div>

        <!-- Total Amount -->
        <div class="total">Total: ₹<?= number_format($total, 2); ?></div>

        <!-- Order submission form -->
        <form action="order_success.php" method="POST">
            <!-- Hidden input to send total -->
            <input type="hidden" name="total" value="<?= $total; ?>">

            <button type="submit" class="btn btn-primary">
                Confirm & Place Order
            </button>
        </form>
    </div>

</body>

</html>
