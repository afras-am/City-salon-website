<?php
include("connect.php");
session_start();

$error = "";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // 1. CHECK IF ADMIN IS LOGGING IN (Updated Admin Email)
    if ($email === "admin.salon@gmail.com" && $password === "afras2004") {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;
        header("Location: admindashboard.php"); // Redirecting to Admin Dashboard
        exit();
    } 
    
    // 2. REGULAR USER LOGIN CHECK (FROM DATABASE)
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Verify user password hash or plain text password
        if (password_verify($password, $row['password']) || $password === $row['password']) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['fullname'];
            $_SESSION['user_email'] = $row['email'];
            
            header("Location: home.php"); // Redirecting Regular User to Website
            exit();
        } else {
            $error = "Incorrect Password!";
        }
    } else {
        $error = "No user found with this Email!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>CITY SALON - LOGIN</title>
    <style>
        body {
            background-image: url("footer-bg.png");
            background-color: #111;
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background: rgba(0, 0, 0, 0.85);
            padding: 40px;
            border-radius: 10px;
            border: 1px solid rgb(252, 180, 86);
            width: 360px;
            text-align: center;
        }
        h2 { color: rgb(252, 180, 86); margin-bottom: 20px; font-size: 28px; }
        input[type="email"], input[type="password"] {
            width: 100%; padding: 12px; margin: 10px 0;
            border-radius: 5px; border: 1px solid #444;
            background: #222; color: white; box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%; padding: 12px;
            background: rgb(252, 180, 86); border: none;
            color: black; font-weight: bold; cursor: pointer;
            border-radius: 5px; margin-top: 15px; font-size: 16px;
        }
        input[type="submit"]:hover { background: white; }
        .error { color: #ff4d4d; margin-bottom: 10px; font-weight: bold; }
        p a { color: rgb(252, 180, 86); text-decoration: none; }
        p a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>CITY SALON LOGIN</h2>
        <?php if($error != "") echo "<p class='error'>$error</p>"; ?>
        
        <form action="" method="POST">
            <input type="email" name="email" placeholder="Email Address" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" name="login" value="LOGIN">
        </form>
        
        <p style="margin-top: 20px; font-size: 14px;">
            Don't have an account? <a href="signup.php">Sign Up</a>
        </p>
    </div>
</body>
</html>