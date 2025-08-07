<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin -> User</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
</head>
<style>
            .title {
            font-weight: bold;
            color: #0d6efd;
            text-align: center;
            margin: 20px 0;
        }
           .card-total {
            background: #0d6efd;
            color: #fff;
            border-radius: 10px;
            padding: 1rem 2rem;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        }
</style>

<body>
    <?php
    $con = mysqli_connect("localhost", "root", "", "ecommerce");
    $Record = mysqli_query($con, "SELECT * FROM tbluser");
    $row_count = mysqli_num_rows($Record);
    ?>

    <div class="container my-4">
        <h2 class="title">Admin Panel - Users</h2>

        <div class="mb-3 w-50 mx-auto">
            <input type="text" id="searchInput" class="form-control" placeholder="Search by name, email, or number...">
        </div>

        <table class="table table-bordered">
            <thead class="text-center table-secondary">
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Number</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody class="text-center" id="userTable">

                <?php
                $i = 0;
                    while ($row = mysqli_fetch_array($Record)) : ?>
                    <tr>
                        <td><?php echo ++$i ?></td>
                        <td><?= htmlspecialchars($row['UserName']) ?></td>
                        <td><?= htmlspecialchars($row['Email']) ?></td>
                        <td><?= htmlspecialchars($row['Number']) ?></td>
                        <td>
                            <a href='delete.php?ID=<?= $row["Id"] ?>' class='btn btn-danger btn-sm'>
                                <i class="fa fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            <div class="card-total text-center">
                <h4>Total Users</h4>
                <h2 class="mb-0"><?php echo $row_count; ?></h2>
            </div>
        </div>
      <div class="text-center mt-4">
    <a href="myStore.php" class="btn btn-outline-primary">
        <i class="fa fa-arrow-left"></i> Back
    </a>
</div>

       

    </div>

    <!-- JavaScript for live search -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const userTable = document.getElementById('userTable');

        searchInput.addEventListener('keyup', () => {
            const filter = searchInput.value.toLowerCase();
            const rows = userTable.getElementsByTagName('tr');

            Array.from(rows).forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
