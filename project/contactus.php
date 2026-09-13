<?php
include("connect.php");
session_start();

$msg = "";
if (isset($_POST['submit_message'])) {
    $msg = "<p style='color:#04AA6D; font-weight:bold; margin-bottom:10px; text-align:center;'>Your message has been sent successfully!</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>CITY SALON - CONTACT US</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; } 
        .otherbody {
            background-image: url("footer-bg.png");
            background-color: black;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
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
        input[type=text], select, textarea {
            width: 100%; padding: 12px; border: 1px solid #ccc;
            margin-top: 6px; margin-bottom: 16px; resize: vertical;
        }
        input[type=submit] {
            background-color: #04AA6D; color: white; padding: 12px 20px;
            border: none; cursor: pointer; font-size: 16px; font-weight: bold;
        }
        input[type=submit]:hover { background-color: #45a049; }
        p.ppp { font-family: Algerian; font-size: 40px; color: white; text-align: center; margin-bottom: 20px; }
        p.ppp span { color: rgb(252, 180, 86); }
        .container {
            border-radius: 5px; background-color: rgba(0,0,0,0.8);
            padding: 30px; margin: 130px auto; width: 80%; border: 1px solid #333;
        }
        .column { float: left; width: 50%; margin-top: 6px; padding: 20px; }
        .row:after { content: ""; display: table; clear: both; }
        @media screen and (max-width: 600px) {
            .column, input[type=submit] { width: 100%; margin-top: 0; }
        }
        .contact-details { color: white; font-size: 25px; line-height: 1.8; }
        .get-in-touch { font-weight: 900; font-size: 30px; color: rgb(231, 202, 83); margin-bottom: 15px; }
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

    <div class="container">
        <p class="ppp">CONTACT <span>US</span></p>
        <?php echo $msg; ?>
        <div class="row">
            <div class="column">
                <div class="get-in-touch">GET IN TOUCH</div>
                <div class="contact-details">
                    <p>📍 Address: 4th Mail, Silawathurai Road.</p>
                    <p>📞 Phone: +94 76 445 0708</p>
                    <p>✉️ Email: info@citysalon.com</p>
                </div>
            </div>
            
            <div class="column">
                <form action="" method="POST">
                    <label style="color: white;">First Name</label>
                    <input type="text" name="firstname" placeholder="Your name.." required>

                    <label style="color: white;">Last Name</label>
                    <input type="text" name="lastname" placeholder="Your last name.." required>

                    <label style="color: white;">Subject</label>
                    <textarea name="subject" placeholder="Write something.." style="height:170px" required></textarea>

                    <input type="submit" name="submit_message" value="Submit">
                </form>
            </div>
        </div>
    </div>
</body>
</html>