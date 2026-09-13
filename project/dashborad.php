<?php
include("connect.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM bookings WHERE user_id='$user_id' ORDER BY booking_date DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>CITY SALON - MY ACCOUNT</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        .otherbody {
            background-image: url("footer-bg.png"); background-color: black;
            background-position: center; background-size: cover; background-attachment: fixed;
            font-family: Arial, sans-serif; color: white;
        }
        .header {
            position: fixed; top: 0; left: 0; width: 100%; padding: 20px 80px;
            display: flex; justify-content: space-between; align-items: center; z-index: 100; background: black;
        }
        .logo { font-size: 32px; color: rgb(252, 180, 86); text-decoration: none; font-weight: 700; }
        .navbar a { font-size: 18px; color: white; font-weight: bolder; text-decoration: none; margin-left: 40px; }
        .container { width: 80%; margin: 120px auto; background: rgba(0,0,0,0.8); padding: 30px; border-radius: 8px; border: 1px solid #333; }
        h2 { color: rgb(252, 180, 86); margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #b9b4b4; }
        th { color: rgb(252, 180, 86); }
        .status-paid { color: #04AA6D; font-weight: bold; }
        .status-pending { color: #ffbc00; font-weight: bold; }
    </style>
</head>
<body class="otherbody">
    <header class="header">
        <a href="home.php" class="logo">CITY SALON</a>
        <nav class="navbar">
            <a href="home.php">HOME</a>
            <a href="price.php">BOOK NOW</a>
            <a href="dashboard.php">MY BOOKINGS</a>
            <a href="logout.php" style="color: #ff4d4d;">LOGOUT</a>
        </nav>
    </header>

    <div class="container">
        <h2>Welcome back, <?php echo $_SESSION['user_name']; ?>!</h2>
        
        <?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            <p style="background: #04AA6D; padding: 15px; border-radius: 4px; color: white; margin-bottom: 20px;">
                🎉 Payment received! Your slot is officially locked and reserved.
            </p>
        <?php endif; ?>

        <h3>Your Booking History</h3>
        <table>
            <thead>
                <tr>
                    <th>Style Package</th>
                    <th>Price Paid</th>
                    <th>Date Scheduled</th>
                    <th>Time Slot</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($result) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['style_name']; ?></td>
                            <td>Rs. <?php echo $row['price']; ?></td>
                            <td><?php echo $row['booking_date']; ?></td>
                            <td><?php echo date("g:i A", strtotime($row['booking_time'])); ?></td>
                            <td>
                                <span class="<?php echo ($row['payment_status'] == 'Paid') ? 'status-paid' : 'status-pending'; ?>">
                                    <?php echo $row['payment_status']; ?>
                                </span>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5" style="text-align: center;">No reservations verified yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>