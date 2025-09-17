<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Registration</title>

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

.form-card {
    background: #1f1f1f;
    padding: 40px;
    border-radius: 15px;
    width: 100%;
    max-width: 450px;
    color: #fff;
    transition: transform 0.3s ease;
}

.form-card:hover {
    transform: translateY(-5px);
}

.form-card p {
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
    color: #fff !important;
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

.btn-register:hover {
    background: linear-gradient(135deg, #5dade2, #2e86c1);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(52,152,219,0.5);
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
    text-align: center;
    margin-top: 10px;
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

.error {
    color: #ff6f61;
    font-size: 0.9rem;
    margin-top: 5px;
}
</style>
</head>

<body>
<div class="form-card">
    <p>User Registration</p>

    <?php
    if(isset($_POST['submit'])){
        include "../Config.php"; // Ensure the path is correct

        $username = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $number = mysqli_real_escape_string($con, $_POST['number']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        // Check if email already exists
        $check = mysqli_query($con, "SELECT * FROM tbluser WHERE Email='$email'");
        if(mysqli_num_rows($check) > 0){
            echo "<div class='alert alert-warning text-center'>Email already registered!</div>";
        } else {
            $insert = mysqli_query($con, "INSERT INTO tbluser(UserName, Email, Number, Password) 
                                          VALUES('$username', '$email', '$number', '$password')");
            if($insert){
                header("Location: login.php");
                exit();
            } else {
                echo "<div class='alert alert-danger text-center'>Registration Failed: ".mysqli_error($con)."</div>";
            }
        }
    }
    ?>

    <form id="registerForm" action="" method="post" novalidate>
        <div class="mb-3">
            <label>Username:</label>
            <input name="name" type="text" class="form-control" placeholder="Enter username" required>
            <div class="error" id="nameError"></div>
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input name="email" type="email" class="form-control" placeholder="Enter email" required>
            <div class="error" id="emailError"></div>
        </div>

        <div class="mb-3">
            <label>Phone No:</label>
            <input name="number" type="text" class="form-control" placeholder="Enter phone number" pattern="[0-9]{10}" title="Enter 10 digit phone number" required>
            <div class="error" id="numberError"></div>
        </div>

        <div class="mb-3">
            <label>Password:</label>
            <input name="password" type="password" class="form-control" placeholder="Enter password" required minlength="6">
            <div class="error" id="passwordError"></div>
        </div>

        <button type="submit" name="submit" class="btn-register">Register</button>

        <a href="login.php" class="btn-login text-decoration-none text-center d-block">Already have an account? Login</a>
    </form>
</div>

<script>
const form = document.getElementById('registerForm');

form.addEventListener('submit', function(e){
    let valid = true;

    const nameInput = form.name;
    const emailInput = form.email;
    const numberInput = form.number;
    const passwordInput = form.password;

    document.getElementById('nameError').textContent = '';
    document.getElementById('emailError').textContent = '';
    document.getElementById('numberError').textContent = '';
    document.getElementById('passwordError').textContent = '';

    if(nameInput.value.trim() === ''){
        document.getElementById('nameError').textContent = 'Username is required.';
        valid = false;
    }

    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if(!emailInput.value.match(emailPattern)){
        document.getElementById('emailError').textContent = 'Please enter a valid email address.';
        valid = false;
    }

    const phonePattern = /^[0-9]{10}$/;
    if(!numberInput.value.match(phonePattern)){
        document.getElementById('numberError').textContent = 'Enter 10 digit phone number.';
        valid = false;
    }

    if(passwordInput.value.length < 6){
        document.getElementById('passwordError').textContent = 'Password must be at least 6 characters.';
        valid = false;
    }

    if(!valid) e.preventDefault();
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
