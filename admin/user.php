<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin -> Users</title>

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">

  <style>
    /* Background with dark overlay */
    body {
      background: url("https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80") no-repeat center center/cover;
      min-height: 100vh;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      color: white;
      position: relative;
    }

    body::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      z-index: 0;
    }

    .container {
      position: relative;
      z-index: 1;
    }

    h2.title {
      text-align: center;
      margin: 30px 0;
      font-weight: bold;
      letter-spacing: 1px;
      animation: fadeIn 1.2s ease-in-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    /* Search box */
    #searchInput {
      border-radius: 50px;
      padding: 10px 20px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    /* Gray Table styling */
    table {
      width: 100%;
      background: rgba(128, 128, 128, 0.2); /* Gray base */
      backdrop-filter: blur(6px);
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
    }

    thead {
      background: rgba(100, 100, 100, 0.4); /* Darker gray for header */
      color: #fff;
    }

    tr {
      transition: all 0.3s ease;
    }

    tr:hover {
      background: rgba(150, 150, 150, 0.25); /* Lighter gray on hover */
      transform: scale(1.01);
    }

    th,
    td {
      vertical-align: middle !important;
      color: #fff;
    }

    /* Delete button */
    .btn-danger {
      background: linear-gradient(135deg, #e74c3c, #c0392b);
      border: none;
      border-radius: 30px;
      transition: all 0.3s ease-in-out;
      position: relative;
      overflow: hidden;
    }

    .btn-danger:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 14px rgba(255, 99, 71, 0.5);
      background: linear-gradient(135deg, #ff6f61, #d63031);
    }

    .btn-danger::after {
      content: "";
      position: absolute;
      width: 300%;
      height: 300%;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) scale(0);
      background: rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      transition: transform 0.6s ease-out;
      z-index: 0;
    }

    .btn-danger:active::after {
      transform: translate(-50%, -50%) scale(1);
      transition: 0s;
    }

    /* Total Users card */
    .card-total {
      background: rgba(255, 255, 255, 0.1);
      color: #fff;
      border-radius: 15px;
      padding: 1rem 2rem;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
      transition: transform 0.3s ease;
    }

    .card-total:hover {
      transform: scale(1.05);
    }

    /* Back button */
    .btn-back {
      background: linear-gradient(135deg, #3498db, #2980b9);
      color: #fff;
      border-radius: 50px;
      padding: 10px 25px;
      font-weight: bold;
      transition: all 0.3s ease;
    }

    .btn-back:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 14px rgba(52, 152, 219, 0.5);
      background: linear-gradient(135deg, #5dade2, #2e86c1);
    }
  </style>
</head>

<body>
  <?php
  $con = mysqli_connect("localhost", "root", "", "ecommerce", 3307);
  $Record = mysqli_query($con, "SELECT * FROM tbluser");
  $row_count = mysqli_num_rows($Record);
  ?>

  <div class="container my-4">
    <h2 class="title">Admin Panel - Users</h2>

    <div class="mb-3 w-50 mx-auto">
      <input type="text" id="searchInput" class="form-control" placeholder="Search by name, email, or number...">
    </div>

    <table class="table table-bordered text-center">
      <thead>
        <tr>
          <th>Sr.No</th>
          <th>Name</th>
          <th>Email</th>
          <th>Number</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody id="userTable">
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($Record)) :
        ?>
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

    <div class="d-flex justify-content-center mt-4">
      <div class="card-total text-center">
        <h4>Total Users</h4>
        <h2 class="mb-0"><?php echo $row_count; ?></h2>
      </div>
    </div>

    <div class="text-center mt-4">
      <a href="myStore.php" class="btn btn-back">
        <i class="fa fa-arrow-left"></i> Back
      </a>
    </div>
  </div>

  <!-- Live search -->
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
