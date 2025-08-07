<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
        <!-- bootstrap cdn  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <!-- awesome cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
</head>
<body>
    <!-- footer.php -->
<footer class="bg-dark text-white text-center text-lg-start mt-5">
    <div class="container p-4">
        <div class="row">

            <!-- About -->
            <div class="col-lg-6 col-md-12 mb-4">
                <h5 class="text-uppercase">About Project</h5>
                <p>
                    This is a simple shopping cart system created for learning purposes using PHP and MySQL with Bootstrap.
                </p>
            </div>

            <!-- Links -->
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

    <div class="text-center p-3 bg-primary">
        © <?= date("Y") ?> Shopping Cart System | All rights reserved.
    </div>
</footer>

</body>
</html>