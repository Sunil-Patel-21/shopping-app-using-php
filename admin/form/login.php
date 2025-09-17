<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>

<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">

<style>
body {
    background: linear-gradient(135deg, #2c3e50, #34495e);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

.login-card {
    background: #1f1f1f;
    padding: 40px;
    border-radius: 15px;
    width: 100%;
    max-width: 400px;
    color: #fff;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.6);
    transition: transform 0.3s ease;
}

.login-card:hover {
    transform: translateY(-5px);
}

.login-card p {
    text-align: center;
    font-size: 2rem;
    font-weight: bold;
    color: #ff6f61;
    margin-bottom: 25px;
}

.form-control {
    border-radius: 50px;
    padding: 12px 20px;
    background: #2b2b2b;
    color: #fff;
    border: 1px solid #444;
    transition: all 0.3s ease;
}

.form-control::placeholder {
    color: #ccc;
}

.form-control:focus {
    outline: none;
    border-color: #ff6f61;
    background: #3a3a3a;
    color: #fff;
    box-shadow: 0 0 8px rgba(255, 111, 97, 0.5);
}

.btn-login {
    background: linear-gradient(135deg, #ff6f61, #e74c3c);
    color: #fff;
    font-weight: bold;
    border-radius: 50px;
    padding: 12px 25px;
    border: none;
    width: 100%;
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

.btn-login:hover {
    background: linear-gradient(135deg, #ff8a75, #ff4f3f);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(255,111,97,0.5);
}

label {
    font-weight: 600;
    color: #fff;
}
</style>
</head>

<body>

<div class="login-card">
    <form action="login1.php" method="post">
        <p>Admin Login</p>

        <div class="mb-3">
            <label>Username:</label>
            <input name="username" type="text" class="form-control" placeholder="Enter your username" required>
        </div>

        <div class="mb-3">
            <label>Password:</label>
            <input name="userpassword" type="password" class="form-control" placeholder="Enter your password" required>
        </div>

        <button class="btn-login mt-3" type="submit">
            <i class="fa fa-right-to-bracket me-2"></i> Login
        </button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
