<?php
include("connect.php");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>CITY SALON - HOME</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; } 
        .homebody {
            background-image: url("banner.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
        }
        .header {
            position: fixed; top: 0; left: 0; width: 100%; padding: 20px 80px;
            display: flex; justify-content: space-between; align-items: center; z-index: 100;
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
        .heading {
            font-size: 80px; color: rgba(255, 255, 255, 0.933);
            text-align: center; position: absolute; top: 50%; left: 50%;
            transform: translate(-50%, -50%); font-weight: bold; font-family: Bell MT; width: 100%;
        }
        .heading span { color: rgb(252, 180, 86); }
        .welcome-badge {
            position: absolute; top: 110px; right: 80px; color: white; font-size: 18px; font-weight: bold;
        }
        .welcome-badge span { color: rgb(252, 180, 86); }
    </style>
</head>
<body class="homebody">
    <header class="header">
        <a href="home.php" class="logo">CITY SALON</a>
        <nav class="navbar">
            <a href="home.php">HOME</a>
            <a href="styles.php">STYLES</a>
            <a href="price.php">PRICE DETAILS</a>
            <a href="contactus.php">CONTACT US</a>
            <a href="aboutus.php">ABOUT US</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="logout.php" style="color: #ff4d4d;">LOGOUT</a>
            <?php else: ?>
                <a href="login.php" style="color: rgb(252, 180, 86);">LOGIN</a>
            <?php endif; ?>
        </nav>
    </header>

    <?php if (isset($_SESSION['user_name'])): ?>
        <div class="welc9ome-badge">Welcome, <span><?php echo $_SESSION['user_name']; ?></span>!</div>
    <?php endif; ?>

    <div class="heading">
        WELCOME TO <br><span>CITY SALON</span>
    </div>
</body>
</html>