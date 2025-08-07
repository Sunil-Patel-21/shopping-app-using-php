<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart Admin</title>
    <!-- bootstrap cdn  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <!-- awesome cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
</head>

<!-- session     -->
<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header("location:form/login.php");
}

?>

<body>
    <!-- navbar  -->
    <nav class="navbar navbar-light bg-dark">
        <div class="container-fluid text-white">
            <a class="navbar-brand"><h1 class="text-white">Shopping Cart</h1></a>
         <span>
            <i class="fa-solid fa-user-tie"></i>
            Hello, <?php echo $_SESSION['admin']; ?> |
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <a href="form/logout.php" class="text-white text-decoration-none">Logout</a> |
            <a href="" class="text-white text-decoration-none">UserPanel</a>
         </span>
        </div>
    </nav>

    <div>
        <h2 class="text-center">Dashboard</h2>
    </div>

    <div class="bg-danger text-center col-md-6 m-auto">
        <a href="product/index.php" class="text-white text-decoration-none fs-4 fw-bold px-5">Add Post</a>
        <a href="user.php" class="text-white text-decoration-none fs-4 fw-bold px-5">Users</a>
    </div>


    <!-- bootstrap cdn  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
</body>

</html>