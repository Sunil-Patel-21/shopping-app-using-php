<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register From</title>
    <!-- bootstrap cdn  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <!-- awesome cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto mt-5 bg-white shadow font-monospace rounded  ">
                <p class="text-center fw-bold fs-3 text-info my-3">User Register</p>
                <form action="insert.php" method="post">

                    <div class="mb-3">
                        <label class="form-label">Username : </label>
                        <input name="name" placeholder="Enter username" required type="text" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email : </label>
                        <input name="email" placeholder="Enter email" required type="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone No : </label>
                        <input name="number" placeholder="Enter phone no" required type="number" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password : </label>
                        <input name="password" placeholder="Enter password" required type="password"
                            class="form-control">
                    </div>

                    <div class="mb-3">
                        <button name="submit" class="btn fs-5  btn-info w-100">Register</button>
                    </div>
                    <div class="mb-3">
                        <button class="btn fs-5  btn-danger w-100"><a href="login.php"
                                class="text-decoration-none text-white">already account</a></button>
                    </div>

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