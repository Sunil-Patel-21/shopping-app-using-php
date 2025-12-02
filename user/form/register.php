<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Registration</title>

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

/* Card container for registration form */
.form-card {
    background: #1f1f1f;
    padding: 40px;
    border-radius: 15px;
    width: 100%;
    max-width: 450px;
    color: #fff;
    transition: transform 0.3s ease;
}

/* Hover effect for form card */
.form-card:hover {
    transform: translateY(-5px);
}

/* Title inside the form card */
.form-card p {
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
    color: #fff !important;
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
    margin-top: 10px;
}

/* Register button hover effect */
.btn-register:hover {
    background: linear-gradient(135deg, #5dade2, #2e86c1);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(52,152,219,0.5);
}

/* Login button styling for redirect link */
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
    text-align: center;
    margin-top: 10px;
}

/* Login button hover effect */
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

/* Error message styling */
.error {
    color: #ff6f61;
    font-size: 0.9rem;
    margin-top: 5px;
}
</style>
</head>

<body>
<!-- Registration form card -->
<div class="form-card">
    <p>User Registration</p>

    <?php
    // Handle form submission
    if(isset($_POST['submit'])){
        include "../Config.php"; // Include database connection file

        // Escape special characters to prevent basic SQL injection
        $username = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $number = mysqli_real_escape_string($con, $_POST['number']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        // Check if email already exists in the database
        $check = mysqli_query($con, "SELECT * FROM tbluser WHERE Email='$email'");
        if(mysqli_num_rows($check) > 0){
            // Display warning if email already registered
            echo "<div class='alert alert-warning text-center'>Email already registered!</div>";
        } else {
            // Insert new user into the database
            $insert = mysqli_query($con, "INSERT INTO tbluser(UserName, Email, Number, Password) 
                                          VALUES('$username', '$email', '$number', '$password')");
            if($insert){
                // Redirect to login page on successful registration
                header("Location: login.php");
                exit();
            } else {
                // Display error if insertion fails
                echo "<div class='alert alert-danger text-center'>Registration Failed: ".mysqli_error($con)."</div>";
            }
        }
    }
    ?>

    <!-- Registration form -->
    <form id="registerForm" action="" method="post" novalidate>
        <!-- Username input -->
        <div class="mb-3">
            <label>Username:</label>
            <input name="name" type="text" class="form-control" placeholder="Enter username" required>
            <div class="error" id="nameError"></div>
        </div>

        <!-- Email input -->
        <div class="mb-3">
            <label>Email:</label>
            <input name="email" type="email" class="form-control" placeholder="Enter email" required>
            <div class="error" id="emailError"></div>
        </div>

        <!-- Phone number input -->
        <div class="mb-3">
            <label>Phone No:</label>
            <input name="number" type="text" class="form-control" placeholder="Enter phone number" pattern="[0-9]{10}" title="Enter 10 digit phone number" required>
            <div class="error" id="numberError"></div>
        </div>

        <!-- Password input -->
        <div class="mb-3">
            <label>Password:</label>
            <input name="password" type="password" class="form-control" placeholder="Enter password" required minlength="6">
            <div class="error" id="passwordError"></div>
        </div>

        <!-- Submit button -->
        <button type="submit" name="submit" class="btn-register">Register</button>

        <!-- Link to login page -->
        <a href="login.php" class="btn-login text-decoration-none text-center d-block">Already have an account? Login</a>
    </form>
</div>

<script>
// Client-side form validation
const form = document.getElementById('registerForm');

form.addEventListener('submit', function(e){
    let valid = true;

    const nameInput = form.name;
    const emailInput = form.email;
    const numberInput = form.number;
    const passwordInput = form.password;

    // Clear previous error messages
    document.getElementById('nameError').textContent = '';
    document.getElementById('emailError').textContent = '';
    document.getElementById('numberError').textContent = '';
    document.getElementById('passwordError').textContent = '';

    // Username validation
    if(nameInput.value.trim() === ''){
        document.getElementById('nameError').textContent = 'Username is required.';
        valid = false;
    }

    // Email validation using regex
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if(!emailInput.value.match(emailPattern)){
        document.getElementById('emailError').textContent = 'Please enter a valid email address.';
        valid = false;
    }

    // Phone number validation (10 digits)
    const phonePattern = /^[0-9]{10}$/;
    if(!numberInput.value.match(phonePattern)){
        document.getElementById('numberError').textContent = 'Enter 10 digit phone number.';
        valid = false;
    }

    // Password length validation
    if(passwordInput.value.length < 6){
        document.getElementById('passwordError').textContent = 'Password must be at least 6 characters.';
        valid = false;
    }

    // Prevent form submission if any validation fails
    if(!valid) e.preventDefault();
});
</script>

<!-- Bootstrap JS bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
