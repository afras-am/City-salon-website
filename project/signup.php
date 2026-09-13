<?php
include("connect.php");
session_start();

$message = "";

if (isset($_POST['signup'])) {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $check_email = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($result) > 0) {
        $message = "<p style='color:red; text-align:center;'>Email is already registered!</p>";
    } else {
        $query = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$hashed_password')";
        if (mysqli_query($conn, $query)) {
            $message = "<p style='color:#04AA6D; text-align:center;'>Registration successful! Please login.</p>";
        } else {
            $message = "<p style='color:red; text-align:center;'>Something went wrong. Try again.</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>CITY SALON - SIGN UP</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        .otherbody {
            background-image: url("footer-bg.png");
            background-color: black;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
        }
        .header {
            position: fixed; top: 0; left: 0; width: 100%;
            padding: 20px 80px; display: flex;
            justify-content: space-between; align-items: center; z-index: 100;
        }
        .logo {
            font-size: 32px; color: rgb(252, 180, 86);
            text-decoration: none; font-weight: 700; font-family: Baskerville Old Face;
        }
        .navbar a {
            font-size: 18px; color: white; font-weight: bolder;
            text-decoration: none; margin-left: 40px;
        }
        .navbar a:hover { color: rgb(252, 180, 86); }
        .container {
            border-radius: 5px; background-color: rgba(0, 0, 0, 0.85);
            padding: 40px; margin: 150px auto 0 auto; width: 40%;
            border: 1px solid rgb(252, 180, 86);
        }
        h2 { color: rgb(252, 180, 86); text-align: center; margin-bottom: 20px; font-size: 30px; }
        label { color: white; font-size: 18px; }
        input[type=text], input[type=email], input[type=password] {
            width: 100%; padding: 12px; border: 1px solid #ccc;
            margin-top: 6px; margin-bottom: 16px; background: #fff;
        }
        input[type=submit] {
            background-color: rgb(252, 180, 86); color: black; font-weight: bold;
            padding: 12px 20px; border: none; cursor: pointer; width: 100%; font-size: 18px;
        }
        input[type=submit]:hover { background-color: white; }
        .switch-link { color: white; text-align: center; margin-top: 15px; display: block; text-decoration: none; }
        .switch-link span { color: rgb(252, 180, 86); }
    </style>
</head>
<body class="otherbody">
    <header class="header">
        <a href="#" class="logo">CITY SALON</a>
        <nav class="navbar">
            <a href="login.php">LOGIN</a>
            <a href="signup.php">SIGN UP</a>
        </nav>
    </header>

    <div class="container">
        <h2>SIGN <span>UP</span></h2>
        <?php echo $message; ?>
        <form action="" method="POST">
            <label>Full Name</label>
            <input type="text" name="fullname" required placeholder="Enter your full name">

            <label>Email Address</label>
            <input type="email" name="email" required placeholder="Enter your email address">

            <label>Password</label>
            <input type="password" name="password" required placeholder="Create a secure password">

            <input type="submit" name="signup" value="SIGN UP">
        </form>
        <a href="login.php" class="switch-link">Already have an account? <span>LOGIN</span></a>
    </div>
</body>
</html>