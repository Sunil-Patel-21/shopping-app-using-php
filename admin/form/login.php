<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>

<!-- Bootstrap CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome CDN for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">

<style>
/* Body styling with gradient background and centered form */
body {
    background: linear-gradient(135deg, #2c3e50, #34495e);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

/* Card styling for login form */
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

/* Hover effect for card */
.login-card:hover {
    transform: translateY(-5px);
}

/* Title styling */
.login-card p {
    text-align: center;
    font-size: 2rem;
    font-weight: bold;
    color: #ff6f61;
    margin-bottom: 25px;
}

/* Input field styling */
.form-control {
    border-radius: 50px;
    padding: 12px 20px;
    background: #2b2b2b;
    color: #fff;
    border: 1px solid #444;
    transition: all 0.3s ease;
}

/* Placeholder color */
.form-control::placeholder {
    color: #ccc;
}

/* Focus state styling for input fields */
.form-control:focus {
    outline: none;
    border-color: #ff6f61;
    background: #3a3a3a;
    color: #fff;
    box-shadow: 0 0 8px rgba(255, 111, 97, 0.5);
}

/* Login button styling */
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

/* Hover effect for login button */
.btn-login:hover {
    background: linear-gradient(135deg, #ff8a75, #ff4f3f);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(255,111,97,0.5);
}

/* Label styling */
label {
    font-weight: 600;
    color: #fff;
}
</style>
</head>

<body>

<!-- Login Card -->
<div class="login-card">
    <!-- Form submission to login1.php -->
    <form action="login1.php" method="post">
        <!-- Form title -->
        <p>Admin Login</p>

        <!-- Username input -->
        <div class="mb-3">
            <label>Username:</label>
            <input name="username" type="text" class="form-control" placeholder="Enter your username" required>
        </div>

        <!-- Password input -->
        <div class="mb-3">
            <label>Password:</label>
            <input name="userpassword" type="password" class="form-control" placeholder="Enter your password" required>
        </div>

        <!-- Submit button -->
        <button class="btn-login mt-3" type="submit">
            <i class="fa fa-right-to-bracket me-2"></i> Login
        </button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
