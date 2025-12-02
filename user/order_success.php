<?php
session_start();

/*
|--------------------------------------------------------------------------
| Ensure cart has items before showing success page
|--------------------------------------------------------------------------
*/
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    // If cart is empty, redirect back to cart page
    header("Location: cart.php");
    exit();
}

/*
|--------------------------------------------------------------------------
| Save the placed order temporarily for invoice generation
|--------------------------------------------------------------------------
*/
$_SESSION['last_order'] = $_SESSION['cart'];

/*
|--------------------------------------------------------------------------
| Calculate total amount of the order
|--------------------------------------------------------------------------
*/
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['productPrice'] * $item['productQuantity'];
}

// Store total in session for invoice
$_SESSION['last_order_total'] = $total;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Google Font */
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap');

        /* Background and layout styling */
        body {
            font-family: 'Quicksand', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #89f7fe, #66a6ff);
            overflow-x: hidden;
            position: relative;
        }

        /* Center success card with glassmorphism */
        .success-box {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 2rem;
            width: 100%;
            max-width: 700px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            text-align: center;
            animation: fadeInUp 1s ease forwards;
            opacity: 0;
        }

        /* Confetti full-screen container */
        .confetti {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            top: 0;
            left: 0;
        }

        /* Headings and text */
        h2 {
            color: #28a745;
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 2rem;
            animation: bounceIn 1s ease;
        }

        p {
            font-size: 1.1rem;
            color: #fff;
            margin-bottom: 2rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Order summary block */
        .summary {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 1rem;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
            overflow-x: auto;
        }

        .summary h5 {
            font-weight: 600;
            margin-bottom: 1rem;
            color: #fff;
        }

        /* Each item row in summary */
        .list-group-item {
            background: transparent;
            border: none;
            padding: 0.75rem 0;
            font-size: 1rem;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .list-group-item span {
            font-weight: 700;
            color: #ffeb3b;
        }

        /* Total amount section */
        .total {
            font-size: 1.3rem;
            font-weight: 700;
            text-align: right;
            margin-bottom: 2rem;
            color: #fff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Buttons styling */
        .btn-custom {
            background: linear-gradient(45deg, #ff6a00, #ee0979);
            border: none;
            font-size: 1rem;
            padding: 12px 20px;
            border-radius: 10px;
            margin: 5px;
            color: #fff;
            transition: all 0.3s ease;
            flex: 1 1 45%;
        }

        .btn-custom:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(255, 105, 135, 0.6);
        }

        /* Animation keyframes */
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(50px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes bounceIn {
            0% { transform: scale(0.5); }
            60% { transform: scale(1.1); }
            80% { transform: scale(0.95); }
            100% { transform: scale(1); }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .success-box { padding: 1.5rem; }
            h2 { font-size: 1.6rem; }
            p { font-size: 1rem; }
            .btn-custom { flex: 1 1 100%; }
        }

        @media (max-width: 480px) {
            .success-box { padding: 1rem; }
            h2 { font-size: 1.4rem; }
            p { font-size: 0.95rem; }
            .summary { padding: 0.75rem; }
            .list-group-item { font-size: 0.9rem; }
            .total { font-size: 1.1rem; }
        }
    </style>
</head>

<body>

    <!-- Confetti Layer -->
    <div class="confetti" id="confetti"></div>

    <!-- Success Message Box -->
    <div class="success-box">

        <!-- Success Title -->
        <h2>🎉 Order Placed Successfully!</h2>
        <p>Thank you for your purchase. Your order is on its way.</p>

        <!-- Order Summary -->
        <div class="summary">
            <h5>Order Summary</h5>

            <ul class="list-group list-group-flush">

                <!-- Loop through placed items -->
                <?php foreach ($_SESSION['last_order'] as $item): ?>
                    <li class="list-group-item">
                        <!-- Product Name -->
                        <?= htmlspecialchars($item['productName']); ?>

                        <!-- Quantity × Price -->
                        <span>
                            <?= (int)$item['productQuantity']; ?> × ₹<?= (float)$item['productPrice']; ?>
                        </span>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>

        <!-- Total Price Section -->
        <div class="total">Total Paid: ₹<?= number_format($total, 2); ?></div>

        <!-- Buttons -->
        <div class="d-flex justify-content-center flex-wrap">
            <a href="index.php" class="btn btn-custom">Continue Shopping</a>
            <a href="invoice.php" class="btn btn-custom" target="_blank">Download Invoice</a>
        </div>
    </div>

    <script>
        /*
        |--------------------------------------------------------------------------
        | Simple Confetti Animation
        |--------------------------------------------------------------------------
        */
        const confettiContainer = document.getElementById('confetti');

        function createConfetti() {
            const confetti = document.createElement('div');

            // Random size, color, and start position
            confetti.style.position = 'absolute';
            confetti.style.width = confetti.style.height = Math.random() * 10 + 7 + 'px';
            confetti.style.backgroundColor = `hsl(${Math.random() * 360}, 100%, 50%)`;
            confetti.style.top = '-20px';
            confetti.style.left = Math.random() * window.innerWidth + 'px';
            confetti.style.opacity = Math.random();
            confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
            confetti.style.borderRadius = '50%';
            confettiContainer.appendChild(confetti);

            // Falling animation
            const fall = setInterval(() => {
                confetti.style.top = parseFloat(confetti.style.top) + (Math.random() * 5 + 2) + 'px';
                confetti.style.left = parseFloat(confetti.style.left) + Math.sin(Date.now() / 100) * 2 + 'px';

                if (parseFloat(confetti.style.top) > window.innerHeight) {
                    confettiContainer.removeChild(confetti);
                    clearInterval(fall);
                }
            }, 20);
        }

        // Generate multiple confetti pieces
        for (let i = 0; i < 150; i++) {
            setTimeout(createConfetti, i * 50);
        }
    </script>

</body>

</html>
