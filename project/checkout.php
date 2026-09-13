<?php
include("connect.php");
session_start();

if (!isset($_SESSION['user_id']) || !isset($_GET['booking_id'])) {
    header("Location: home.php");
    exit();
}

$booking_id = mysqli_real_escape_string($conn, $_GET['booking_id']);
$user_id = $_SESSION['user_id'];

// Fetch booking data details securely
$query = "SELECT * FROM bookings WHERE id='$booking_id' AND user_id='$user_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    echo "Invalid Session Booking Reference.";
    exit();
}

$booking = mysqli_fetch_assoc($result);

// Process Secure Payment Logic Mockup
if (isset($_POST['pay_now'])) {
    // In production, your third-party API validation code goes here
    $update_query = "UPDATE bookings SET payment_status='Paid' WHERE id='$booking_id'";
    if (mysqli_query($conn, $update_query)) {
        header("Location: dashboard.php?status=success");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>CITY SALON - SECURE GATEWAY</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        .otherbody {
            background-image: url("footer-bg.png"); background-color: black;
            background-position: center; background-size: cover; background-attachment: fixed;
            font-family: Arial, sans-serif;
        }
        .pay-box {
            background-color: rgba(0,0,0,0.9); border: 1px solid rgb(252, 180, 86);
            border-radius: 8px; width: 40%; margin: 150px auto; padding: 40px; color: white;
        }
        h2 { color: rgb(252, 180, 86); text-align: center; margin-bottom: 20px; }
        .invoice-details { margin-bottom: 20px; font-size: 18px; line-height: 2; border-bottom: 1px solid #333; padding-bottom: 15px;}
        .invoice-details span { float: right; color: rgb(252, 180, 86); font-weight: bold;}
        input[type=text] { width: 100%; padding: 12px; margin: 8px 0 15px 0; border-radius: 4px; border: 1px solid #ccc; }
        .pay-btn { background-color: #04AA6D; color: white; font-weight: bold; width:100%; padding:15px; border:none; cursor: pointer; font-size:18px; }
        .pay-btn:hover { background-color: #45a049; }
    </style>
</head>
<body class="otherbody">
    <div class="pay-box">
        <h2>SECURE PAYMENT GATEWAY</h2>
        <div class="invoice-details">
            <p>Service: <span><?php echo $booking['style_name']; ?></span></p>
            <p>Date: <span><?php echo $booking['booking_date']; ?></span></p>
            <p>Time Frame: <span><?php echo $booking['booking_time']; ?></span></p>
            <hr style="margin: 10px 0; border-color: #444;">
            <p style="font-size: 22px;">Total Payable Amount: <span>Rs. <?php echo $booking['price']; ?></span></p>
        </div>

        <form action="" method="POST">
            <label>Cardholder Name</label>
            <input type="text" required placeholder="John Doe">
            
            <label>Mock Card Number</label>
            <input type="text" required placeholder="4000 1234 5678 9010" maxlength="19">

            <div style="display: flex; gap: 10px;">
                <div style="flex: 1;">
                    <label>Expiry Date</label>
                    <input type="text" required placeholder="MM/YY" maxlength="5">
                </div>
                <div style="flex: 1;">
                    <label>CVC</label>
                    <input type="text" required placeholder="123" maxlength="3">
                </div>
            </div>

            <button type="submit" name="pay_now" class="pay-btn">Authorize Payment</button>
        </form>
    </div>
</body>
</html>