<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Login</title>

<!-- Bootstrap CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome CDN for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">

<style>
/* Body styling with gradient background and center alignment */
body {
    background: linear-gradient(135deg, #2c3e50, #34495e);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

/* Card container for login form */
.login-card {
    background: #1f1f1f;
    padding: 40px;
    border-radius: 15px;
    width: 100%;
    max-width: 400px;
    color: #fff;
    transition: transform 0.3s ease;
}

/* Hover effect for login card */
.login-card:hover {
    transform: translateY(-5px);
}

/* Title inside the login card */
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
    color: #fff !important; /* Make text visible */
    border: 1px solid #444;
    transition: all 0.3s ease;
}

/* Placeholder text color */
.form-control::placeholder {
    color: #ccc;
}

/* Input focus styling */
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
    margin-bottom: 15px;
}

/* Login button hover effect */
.btn-login:hover {
    background: linear-gradient(135deg, #ff8a75, #ff4f3f);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(255,111,97,0.5);
}

/* Register button styling */
.btn-register {
    background: linear-gradient(135deg, #3498db, #2980b9);
    color: #fff;
    font-weight: bold;
    border-radius: 50px;
    padding: 12px 25px;
    border: none;
    width: 100%;
    font-size: 1.2rem;
    transition: all 0.3s ease;
    text-align: center;
}

/* Register button hover effect */
.btn-register:hover {
    background: linear-gradient(135deg, #5dade2, #2e86c1);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(52,152,219,0.5);
}

/* Label styling */
label {
    font-weight: 600;
    color: #fff; /* Ensure label is visible */
}

/* Anchor tag inside register button */
.btn-register a {
    color: #fff;
    display: block;
}

/* Error message styling */
.error {
    color: #ff6f61;
    font-size: 0.9rem;
    margin-top: 5px;
}
</style>
</head>

<body>
<!-- Login card container -->
<div class="login-card">
    <p>User Login</p>

    <!-- Login form -->
    <form id="loginForm" action="login1.php" method="post" novalidate>
        <!-- Email input -->
        <div class="mb-3">
            <label>Email:</label>
            <input name="name" type="email" class="form-control" placeholder="Enter email" required>
            <div class="error" id="emailError"></div> <!-- Placeholder for email errors -->
        </div>

        <!-- Password input -->
        <div class="mb-3">
            <label>Password:</label>
            <input name="password" type="password" class="form-control" placeholder="Enter password" required minlength="6">
            <div class="error" id="passwordError"></div> <!-- Placeholder for password errors -->
        </div>

        <!-- Login button -->
        <button class="btn-login" type="submit">
            <i class="fa fa-right-to-bracket me-2"></i> Login
        </button>

        <!-- Register button linking to register page -->
        <button type="button" class="btn-register">
            <a href="register.php" class="text-decoration-none">Register</a>
        </button>
    </form>
</div>

<script>
// Get form elements
const form = document.getElementById('loginForm');
const emailInput = form.name;
const passwordInput = form.password;
const emailError = document.getElementById('emailError');
const passwordError = document.getElementById('passwordError');

// Client-side form validation
form.addEventListener('submit', function(e) {
    let valid = true; // Flag to track validity
    emailError.textContent = '';
    passwordError.textContent = '';

    // Email regex pattern
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!emailInput.value.match(emailPattern)) {
        emailError.textContent = 'Please enter a valid email address.';
        valid = false;
    }

    // Password minimum length check
    if (passwordInput.value.length < 6) {
        passwordError.textContent = 'Password must be at least 6 characters.';
        valid = false;
    }

    // Prevent form submission if invalid
    if (!valid) e.preventDefault();
});
</script>

<!-- Bootstrap JS bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
