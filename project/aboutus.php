<?php
include("connect.php");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>CITY SALON - ABOUT US</title>
    <style> 
        * { margin: 0; padding: 0; box-sizing: border-box; }
        .otherbody {
            background-image: url("footer-bg.png");
            background-color: black;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat ;
            background-attachment: fixed;
        }
        .header {
            position: fixed; top: 0; left: 0; width: 100%; padding: 20px 80px;
            display: flex; justify-content: space-between; align-items: center; z-index: 100;
        }
        .logo {
            font-size: 32px; color: rgb(252, 180, 86); text-decoration: none;
            font-weight: 700; font-family: Baskerville Old Face;
        }
        .navbar a {
            font-size: 18px; color: white; font-weight: bolder; text-decoration: none; margin-left: 40px;
        }
        .navbar a:hover { color: rgb(252, 180, 86); }
        .about { color: #fff; margin: 12% 0 30px 30px; font-size: 40px; }
        .about span { color: rgb(252, 180, 86); }
        .aboutus { color: #fff; font-size: 20px; font-weight: 800; margin: 30px; line-height: 1.6; }
        .aboutus span { color: rgb(252, 180, 86); }
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

    <h1 class="about">ABOUT <span>US</span></h1>
     
    <div class="aboutus">
        WELCOME TO <span>CITY SALON,</span> WHERE STYLE MEETS COMFORT AND CREATIVITY. LOCATED IN THE HEART OF <span>4TH MAIL, SILAWATHURAI ROAD.</span> OUR SALON IS DEDICATED TO PROVIDING HIGH-QUALITY HAIRCUTS AND PERSONALIZED HAIR CARE EXPERIENCES. WHETHER YOU'RE LOOKING FOR A FRESH NEW LOOK, A SIMPLE TRIM, OR A COMPLETE HAIR TRANSFORMATION, OUR TALENTED TEAM OF SKILLED STYLISTS IS HERE TO MAKE YOUR VISION A REALITY.<br><br>
        AT CITY SALON, WE PRIDE OURSELVES ON CREATING A WARM, INVITING ATMOSPHERE WHERE YOU CAN RELAX, UNWIND, AND ENJOY A TRULY TAILORED EXPERIENCE. OUR STYLISTS STAY UP-TO-DATE WITH THE LATEST TRENDS AND TECHNIQUES TO OFFER YOU THE BEST IN HAIRCUTS, COLOR, AND TREATMENTS, ALL WHILE ENSURING THAT EVERY VISIT IS A UNIQUE, ENJOYABLE EXPERIENCE.<br><br>
        OUR COMMITMENT IS TO NOT ONLY HELP YOU LOOK GREAT BUT FEEL GREAT TOO. WE USE PREMIUM, SALON-QUALITY PRODUCTS TO MAINTAIN THE HEALTH AND BEAUTY OF YOUR HAIR, SO YOU CAN LEAVE FEELING CONFIDENT, REFRESHED, AND READY TO TAKE ON THE WORLD.<br><br>
        COME VISIT US AT CITY SALON WHERE GREAT HAIR IS JUST THE BEGINNING.
    </div>
</body>
</html>