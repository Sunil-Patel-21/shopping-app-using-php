<?php
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
    <?php include 'header.php'; ?>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap');

        body {
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
                url('https://images.unsplash.com/photo-1501785888041-2c0f3fa27939?auto=format&fit=crop&w=1950&q=80') no-repeat center center/cover;
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

        .table-responsive {
            animation: fadeInUp 1s ease forwards;
            opacity: 0;
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

        thead.bg-danger {
            background-color: #dc3545 !important;
        }

        .form-control {
            max-width: 80px;
            margin: 0 auto;
            padding: 0.25rem 0.5rem;
            text-align: center;
        }

        .btn-warning,
        .btn-danger,
        .btn-success {
            padding: 0.3rem 0.75rem;
            font-size: 0.9rem;
            transition: 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-warning:hover {
            box-shadow: 0 0 10px rgba(255, 193, 7, 0.7);
        }

        .btn-danger:hover {
            box-shadow: 0 0 10px rgba(220, 53, 69, 0.7);
        }

        .btn-success:hover {
            box-shadow: 0 0 10px rgba(40, 167, 69, 0.7);
        }

        .fw-bold h1 {
            font-size: 1.75rem;
        }

        @media (max-width: 768px) {
            .custom-heading {
                font-size: 2rem;
            }

            .form-control {
                max-width: 60px;
            }

            .btn-warning,
            .btn-danger,
            .btn-success {
                font-size: 0.8rem;
                padding: 0.25rem 0.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-5 p-3 rounded shadow-sm custom-heading">🛒 My Cart</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-9">
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
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
                            $total = 0;
                            $i = 0;

                            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                                foreach ($_SESSION['cart'] as $key => $value) {
                                    $productName = htmlspecialchars($value['productName']);
                                    $productPrice = (float) $value['productPrice'];
                                    $productQuantity = (int) $value['productQuantity'];
                                    $productTotal = $productPrice * $productQuantity;
                                    $total += $productTotal;
                                    $i = $key + 1;

                                    echo "
                                    <tr>
                                        <form action='Insertcart.php' method='post'>
                                            <td>$i</td>
                                            <td>
                                                <input type='hidden' name='PName' value='$productName' />
                                                $productName
                                            </td>
                                            <td>
                                                <input type='hidden' name='PPrice' value='$productPrice' />
                                                ₹ $productPrice
                                            </td>
                                            <td>
                                                <input type='number' name='PQuantity' min='1' value='$productQuantity' class='form-control'/>
                                            </td>
                                            <td>₹ $productTotal</td>
                                            <td>
                                                <button class='btn btn-warning btn-sm' name='update'>Update</button>
                                            </td>
                                            <td>
                                                <button class='btn btn-danger btn-sm' name='remove'>Delete</button>
                                            </td>
                                            <input type='hidden' name='item' value='$productName' />
                                        </form>
                                    </tr>";
                                }

                                echo "
                                <tr class='fw-bold'>
                                    <td colspan='4'><h5>Total</h5></td>
                                    <td colspan='3'>
                                        <h5>₹ $total</h5>
                                        <a href='checkout.php' class='btn btn-success btn-lg mt-2'>Proceed to Checkout</a>
                                    </td>
                                </tr>";
                            } else {
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>