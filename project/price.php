<?php
include("connect.php");
session_start();

$message = "";

// Handle Form Submission
if (isset($_POST['confirm_booking'])) {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $style_name = mysqli_real_escape_string($conn, $_POST['style_name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $booking_date = mysqli_real_escape_string($conn, $_POST['booking_date']);
    $booking_time = mysqli_real_escape_string($conn, $_POST['booking_time']);

    // Insert booking into database as 'Pending'
    $query = "INSERT INTO bookings (user_id, style_name, price, booking_date, booking_time, payment_status) 
              VALUES ('$user_id', '$style_name', '$price', '$booking_date', '$booking_time', 'Pending')";
    
    if (mysqli_query($conn, $query)) {
        $booking_id = mysqli_insert_id($conn);
        // Redirect to payment simulator step
        header("Location: checkout.php?booking_id=" . $booking_id);
        exit();
    } else {
        $message = "<p style='color:red; text-align:center;'>Booking failed. Try again.</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>CITY SALON - PRICE & BOOKING</title>
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
        .pricedetails {
            color: white; width: 65%; margin: 120px auto 50px auto;
            background-color: rgba(0, 0, 0, 0.85); padding: 30px;
            border-radius: 10px; border: 1px solid rgb(243, 201, 146);
        }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        table th {
            font-size: 24px; padding: 15px; color: rgb(243, 201, 146);
            border-bottom: 2px solid rgb(243, 201, 146);
        }
        table tr td {
            text-align: center; font-size: 18px; font-weight: 700;
            padding: 15px; color: rgb(202, 192, 175); border-bottom: 1px solid #333;
        }
        .rs { color: rgb(252, 180, 86); font-weight: bold; }
        h2 { text-align: center; color: white; margin-bottom: 20px; font-size: 35px; }
        h2 span { color: rgb(252, 180, 86); }
        .btn-book {
            background-color: rgb(252, 180, 86); color: black; border: none;
            padding: 8px 16px; font-weight: bold; cursor: pointer; border-radius: 4px;
        }
        .btn-book:hover { background-color: white; }
        
        /* Modal Form Styles */
        .booking-form {
            background: rgba(255, 255, 255, 0.1); padding: 20px; 
            border-radius: 5px; border: 1px dashed rgb(252, 180, 86); margin-top: 20px;
        }
        .booking-form h3 { color: rgb(252, 180, 86); margin-bottom: 15px; }
        .booking-form label { display: block; margin: 10px 0 5px 0; color: white; }
        .booking-form input, .booking-form select {
            width: 100%; padding: 10px; margin-bottom: 10px; border-radius: 4px; border: none;
        }
        .btn-submit {
            background-color: #04AA6D; color: white; padding: 12px; width: 100%;
            border: none; font-size: 18px; font-weight: bold; cursor: pointer; margin-top: 10px;
        }
        .btn-submit:hover { background-color: #45a049; }
    </style>
    <script>
        function selectStyle(name, price) {
            document.getElementById('display_style').value = name;
            document.getElementById('style_name').value = name;
            document.getElementById('display_price').value = 'Rs. ' + price;
            document.getElementById('price').value = price;
            document.getElementById('form-container').scrollIntoView({ behavior: 'smooth' });
        }
    </script>
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

    <div class="pricedetails">
        <h2>BOOK YOUR <span>APPOINTMENT</span></h2>
        <?php echo $message; ?>
        <table>
            <thead>
                <tr>
                    <th>HAIRCUT STYLE</th>
                    <th>PRICE</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>BUZZ CUT</td><td class="rs">Rs. 500</td><td><button class="btn-book" onclick="selectStyle('BUZZ CUT', 500)">Select</button></td></tr>
                <tr><td>BOWL CUT</td><td class="rs">Rs. 600</td><td><button class="btn-book" onclick="selectStyle('BOWL CUT', 600)">Select</button></td></tr>
                <tr><td>HIGH FADE CUT</td><td class="rs">Rs. 700</td><td><button class="btn-book" onclick="selectStyle('HIGH FADE CUT', 700)">Select</button></td></tr>
                <tr><td>HIPSTER CUT</td><td class="rs">Rs. 800</td><td><button class="btn-book" onclick="selectStyle('HIPSTER CUT', 800)">Select</button></td></tr>
                <tr><td>LOW FADE CUT</td><td class="rs">Rs. 700</td><td><button class="btn-book" onclick="selectStyle('LOW FADE CUT', 700)">Select</button></td></tr>
                <tr><td>POMPADOUR CUT</td><td class="rs">Rs. 900</td><td><button class="btn-book" onclick="selectStyle('POMPADOUR CUT', 900)">Select</button></td></tr>
            </tbody>
        </table>

        <div id="form-container" class="booking-form">
            <h3>Appointment Details</h3>
            <?php if(isset($_SESSION['user_id'])): ?>
                <form action="" method="POST">
                    <input type="hidden" name="style_name" id="style_name">
                    <input type="hidden" name="price" id="price">

                    <label>Selected Style</label>
                    <input type="text" id="display_style" disabled placeholder="Click a select button above">

                    <label>Total Fee</label>
                    <input type="text" id="display_price" disabled placeholder="—">

                    <label>Choose Date</label>
                    <input type="date" name="booking_date" required min="<?php echo date('Y-m-d'); ?>">

                    <label>Choose Time Slot</label>
                    <select name="booking_time" required>
                        <option value="">-- SELECT TIME --</option>
                        <option value="09:00:00">09:00 AM</option>
                        <option value="10:30:00">10:30 AM</option>
                        <option value="12:00:00">12:00 PM</option>
                        <option value="14:00:00">02:00 PM</option>
                        <option value="15:30:00">03:30 PM</option>
                        <option value="17:00:00">05:00 PM</option>
                    </select>

                    <input type="submit" name="confirm_booking" class="btn-submit" value="Proceed to Checkout">
                </form>
            <?php else: ?>
                <p style="text-align: center; font-size: 18px;">Please <a href="login.php" style="color:rgb(252, 180, 86);">LOGIN</a> to book appointment time frames.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>