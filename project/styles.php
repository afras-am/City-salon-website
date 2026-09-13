<?php
include("connect.php");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>CITY SALON - STYLES</title>
    <style> 
        * { margin: 0; padding: 0; box-sizing: border-box; } 
        .otherbody {
            background-image: url("footer-bg.png");
            background-color: black;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            padding-top: 150px;
            text-align: center;
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
        div img { width: 300px; height: 300px; border-radius: 20px; }
        div p { color: white; text-align: center; font-size: 20px; font-weight: 900; margin: 5px 0 25px 0; }
        .cards { width: 300px; display: inline-block; margin: 30px;}
        h1 { color: white; font-size: 45px; margin-bottom: 20px; font-family: Bell MT; }
        h1 span { color: rgb(252, 180, 86); }
    </style>
</head>
<body class="otherbody">
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

    <h1>HAIR <span>STYLES</span></h1>

    <div class="cards"><img src="buzz cut.jpg"><p>BUZZ CUT</p></div>
    <div class="cards"><img src="bowl cut.jpg"><p>BOWL CUT</p></div>
    <div class="cards"><img src="highfade.jpg"><p>HIGH FADE CUT</p></div>
    <div class="cards"><img src="hipster cut.jpg"><p>HIPSTER CUT</p></div> 
    <div class="cards"><img src="low fade.jpg"><p>LOW FADE CUT</p></div>
    <div class="cards"><img src="middle fade.jpg"><p>MIDDLE FADE CUT</p></div>
    <div class="cards"><img src="quiff cut.jpg"><p>QUIFF CUT</p></div>
    <div class="cards"><img src="tapercut.jpg"><p>TAPER CUT</p></div> 
    <div class="cards"><img src="undercut.jpg"><p>UNDER CUT</p></div>
    <div class="cards"><img src="Pompadour.jpg"><p>POMPADOUR CUT</p></div>
    <div class="cards"><img src="Spiky Hair Fade.jpg"><p>SPIKY HAIR CUT</p></div>
    <div class="cards"><img src="Comb Over.jpg"><p>COMB OVER CUT</p></div>
</body>
</html>