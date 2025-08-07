<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <!-- bootstrap cdn  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <!-- awesome cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
</head>

<body class="bg-secondary">

    <div class="container ">
        <div class="row">
            <div class="col-md-6 shadow bg-white p-3 font-monospace m-auto border border-primary mt-3 ">
                <form action="login1.php" method="post" >
                    <div class="mb-3">
                        <p class="text-center fw-bold fs-3 text-info">Admin Login</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username : </label>
                        <input name="username" placeholder="Enter your name" type="text" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password : </label>
                        <input name="userpassword" placeholder="Enter your password" type="password" class="form-control">
                    </div>

                    <button
                        class="bg-danger fs-4 fw-bold my-3 form-control text-white px-5 border-0">Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- bootstrap cdn  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
</body>

</html>