<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">

    <style>
        footer {
            font-family: 'Quicksand', sans-serif;
        }
        footer a {
            transition: 0.3s;
        }
        footer a:hover {
            color: #ffc107 !important;
            text-decoration: underline;
        }
        .footer-bottom {
            background: linear-gradient(90deg, #007bff, #ff4f81);
            color: #fff;
            font-weight: 500;
        }
        .footer-bottom:hover {
            background: linear-gradient(90deg, #ff4f81, #007bff);
            transition: 0.5s;
        }
        .fa {
            color: #ffc107;
        }
    </style>
</head>
<body>
<footer class="bg-dark text-white text-center text-lg-start mt-5">
    <div class="container p-4">
        <div class="row">

            <!-- About -->
            <div class="col-lg-6 col-md-12 mb-4">
                <h5 class="text-uppercase">About Project</h5>
                <p>
                    This is a simple shopping cart system created for learning purposes using PHP, MySQL, and Bootstrap.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="text-uppercase">Quick Links</h5>
                <ul class="list-unstyled mb-0">
                    <li><a href="#" class="text-white text-decoration-none">Home</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Products</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Users</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Contact</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="text-uppercase">Contact</h5>
                <p><i class="fa fa-envelope me-2"></i> admin@example.com</p>
                <p><i class="fa fa-phone me-2"></i> +91 9876543210</p>
            </div>

        </div>
    </div>

    <div class="text-center p-3 footer-bottom">
        © <?= date("Y") ?> Swift Cart System | All rights reserved.
    </div>
</footer>
</body>
</html>
