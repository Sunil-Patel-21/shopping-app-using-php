
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart Page</title>
       <?php include 'header.php'; ?>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .custom-heading {
            font-size: 2.5rem;
            font-weight: 600;
            background-color: #f8f9fa;
            /* same as bg-light */
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: #ffc107;
            /* same as text-warning */
            text-align: center;
            margin-bottom: 3rem;
        }

        h1.text-warning {
            font-size: 2.5rem;
            padding: 1rem;
        }

        .table {
            background-color: #ffffff;
            border-radius: 0.5rem;
            overflow: hidden;
        }

        thead.bg-danger {
            background-color: #dc3545 !important;
        }

        .table td,
        .table th {
            vertical-align: middle !important;
        }

        .form-control {
            max-width: 80px;
            margin: 0 auto;
            padding: 0.25rem 0.5rem;
            text-align: center;
        }

        .btn-warning,
        .btn-danger {
            padding: 0.3rem 0.75rem;
            font-size: 0.9rem;
        }

        .fw-bold h1 {
            font-size: 1.75rem;
        }

        @media (max-width: 768px) {
            .table {
                font-size: 0.9rem;
            }

            .form-control {
                max-width: 60px;
            }

            .btn-warning,
            .btn-danger {
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-danger text-center  mb-5 p-3 rounded shadow-sm custom-heading">🛒 My Cart</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-around">
            <div class="col-sm-12 col-md-6 col-lg-9">
                <table class="table text-center table-bordered">
                    <thead class="bg-danger text-white fs-5">
                        <tr>
                            <th>Sr No.</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Product Quantity</th>
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
                                $i = $key+1;

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
                                        <button class='btn btn-warning' name='update'>Update</button>
                                    </td>
                                    <td>
                                        <button class='btn btn-danger' name='remove'>Delete</button>
                                    </td>
                                    <input type='hidden' name='item' value='$productName' />
                                </form>
                            </tr>";
                            }

                            // Total Row
                            echo "
                        <tr class='fw-bold'>
                            <td colspan='4'><h1>Total</h1></td>
                            <td colspan='3'><h1>₹ $total</h1></td>
                        </tr>";
                        } else {
                            echo "
                        <tr>
                            <td colspan='7'><h1>Cart is empty.</h1></td>
                        </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
</body>

</html>