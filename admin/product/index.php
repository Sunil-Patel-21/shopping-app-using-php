<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <!-- bootstrap cdn  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <!-- awesome cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
</head>

<body>

    <div class="container ">
        <div class="row">
            <div class="col-md-6 m-auto border border-primary mt-3 ">
                <form action="insert.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <p class="text-center fw-bold fs-3 text-warning">Product Details</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Name : </label>
                        <input name="Pname" placeholder="Enter product name" type="text" class="form-control"
                            aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Price : </label>
                        <input name="Pprice" placeholder="Enter product price" type="number" class="form-control"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Add Product Image : </label>
                        <input type="file" name="Pimage" class="form-control" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select Page Category :</label>
                        <select class="form-select" name="Pages">
                            <option value="Home">Home</option>
                            <option value="Laptop">Laptop</option>
                            <option value="Bag">Bag</option>
                            <option value="Mobile">Mobile</option>
                        </select>
                    </div>
                    <button name="submit"
                        class="bg-danger fs-4 fw-bold my-3 form-control text-white px-5 border-0">Upload</button>
                </form>
            </div>
        </div>
    </div>

    <!-- fetch data -->

    <div class="container ">
        <div class="row">
            <div class="col-md-8  m-auto ">
                <table class="table border-2 border-warning table-hover border my-5">
                    <thead  class="bg-dark text-white fs-5 font-monospace text-center ">
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Image</th>
                        <th>Product Category</th>
                        <th>Delete</th>
                    </thead>

                 

                    <tbody class="text-center">
                        <?php
                        include "Config.php";
                        $Record = mysqli_query($con, "SELECT * FROM `tblproduct`");
                        while ($row = mysqli_fetch_array($Record))
                            echo "
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[PName]</td>
                        <td>$row[PPrice]</td>
                        <td><img src='$row[PImage]' alt='' height='90px' width='90px'></td>
                        <td>$row[PCategory]</td>
                           <td><a href='delete.php? ID=$row[id]' class='btn btn-danger'>Delete</a></td>
                           <td><a href='update.php? ID=$row[id]' class='btn btn-warning'>Update</a></td>
                    </tr> 
                "
                        ?>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>



        <!-- bootstrap cdn  -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
            crossorigin="anonymous"></script>
    </body>

    </html>