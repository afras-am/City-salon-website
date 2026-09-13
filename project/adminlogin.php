<?php
include("connect.php");
session_start();

$error = "";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Specific Admin Email and Password Check
    if ($email === "admin@citysalon.com" && $password === "admin123") {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid Admin Credentials!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>CITY SALON - ADMIN LOGIN</title>
    <style>
        body {
            background-color: #111;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background: rgba(0,0,0,0.85);
            padding: 30px;
            border-radius: 10px;
            border: 1px solid rgb(252, 180, 86);
            width: 350px;
            text-align: center;
        }
        h2 { color: rgb(252, 180, 86); margin-bottom: 20px; }
        input[type="email"], input[type="password"] {
            width: 100%; padding: 10px; margin: 10px 0;
            border-radius: 5px; border: 1px solid #444;
            background: #222; color: white; box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%; padding: 10px;
            background: rgb(252, 180, 86); border: none;
            color: black; font-weight: bold; cursor: pointer;
            border-radius: 5px; margin-top: 10px;
        }
        input[type="submit"]:hover { background: white; }
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>ADMIN LOGIN</h2>
        <?php if($error != "") echo "<p class='error'>$error</p>"; ?>
        <form action="" method="POST">
            <input type="email" name="email" placeholder="Admin Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" name="login" value="LOGIN">
        </form>
    </div>
</body>
</html>