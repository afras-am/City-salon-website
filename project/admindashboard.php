<?php
include("connect.php");
session_start();

// Admin Login Check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$msg = "";

// 1. UPDATE STATUS LOGIC
if (isset($_POST['update_status'])) {
    $booking_id = mysqli_real_escape_string($conn, $_POST['booking_id']);
    $new_status = mysqli_real_escape_string($conn, $_POST['status']);
    
    $update_query = "UPDATE bookings SET status='$new_status' WHERE id='$booking_id'";
    if (mysqli_query($conn, $update_query)) {
        $msg = "<div class='alert success'>Booking #$booking_id status updated to $new_status!</div>";
    } else {
        $msg = "<div class='alert danger'>Error updating status!</div>";
    }
}

// 2. DELETE BOOKING LOGIC
if (isset($_GET['delete_id'])) {
    $delete_id = mysqli_real_escape_string($conn, $_GET['delete_id']);
    $delete_query = "DELETE FROM bookings WHERE id='$delete_id'";
    if (mysqli_query($conn, $delete_query)) {
        $msg = "<div class='alert success'>Booking #$delete_id deleted successfully!</div>";
    } else {
        $msg = "<div class='alert danger'>Error deleting record!</div>";
    }
}

// Fetch Stats
$total_bookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM bookings"))['total'];
$total_revenue = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(price) as total FROM bookings WHERE payment_status='Paid'"))['total'] ?? 0;
$pending_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM bookings WHERE status='Pending' OR status='' IS NULL"))['total'];
$completed_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM bookings WHERE status='Completed'"))['total'];

// Fetch All Bookings Data with User Info
$query = "SELECT bookings.*, users.fullname, users.email 
          FROM bookings 
          JOIN users ON bookings.user_id = users.id 
          ORDER BY bookings.id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>City Salon - Admin Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background: #121212; color: #fff; min-height: 100vh; }
        
        /* Header */
        .header {
            background: #1e1e1e; padding: 20px 50px;
            display: flex; justify-content: space-between; align-items: center;
            border-bottom: 2px solid rgb(252, 180, 86);
        }
        .logo { font-size: 24px; color: rgb(252, 180, 86); font-weight: bold; text-decoration: none; }
        .logout-btn { background: #ff4d4d; color: white; padding: 8px 16px; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .logout-btn:hover { background: #cc0000; }

        .container { width: 92%; margin: 30px auto; }

        /* Stats Cards */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
        .card { background: #1e1e1e; padding: 20px; border-radius: 8px; border-left: 4px solid rgb(252, 180, 86); }
        .card h3 { font-size: 14px; color: #aaa; text-transform: uppercase; margin-bottom: 8px; }
        .card p { font-size: 24px; font-weight: bold; color: rgb(252, 180, 86); }

        /* Table Area */
        .table-box { background: #1e1e1e; padding: 25px; border-radius: 8px; border: 1px solid #333; overflow-x: auto; }
        .table-box h2 { margin-bottom: 20px; color: rgb(252, 180, 86); }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { background: #2a2a2a; color: rgb(252, 180, 86); padding: 12px; font-size: 14px; }
        td { padding: 12px; border-bottom: 1px solid #333; font-size: 14px; }
        tr:hover { background: #252525; }

        /* Status & Badges */
        .badge-paid { background: #28a745; color: white; padding: 3px 8px; border-radius: 4px; font-size: 12px; }
        .badge-pending { background: #ffc107; color: black; padding: 3px 8px; border-radius: 4px; font-size: 12px; }
        
        select { background: #333; color: white; border: 1px solid #555; padding: 5px; border-radius: 4px; }
        .btn-save { background: rgb(252, 180, 86); color: black; border: none; padding: 5px 10px; cursor: pointer; border-radius: 4px; font-weight: bold; }
        .btn-save:hover { background: white; }
        .btn-delete { color: #ff4d4d; text-decoration: none; margin-left: 10px; font-weight: bold; }
        .btn-delete:hover { text-decoration: underline; }

        /* Alerts */
        .alert { padding: 12px; margin-bottom: 20px; border-radius: 5px; text-align: center; font-weight: bold; }
        .success { background: #155724; color: #d4edda; }
        .danger { background: #721c24; color: #f8d7da; }
    </style>
</head>
<body>

    <header class="header">
        <a href="#" class="logo">CITY SALON - ADMIN PANEL</a>
        <a href="logout.php" class="logout-btn">LOGOUT</a>
    </header>

    <div class="container">
        <?php echo $msg; ?>

        <div class="stats-grid">
            <div class="card">
                <h3>Total Bookings</h3>
                <p><?php echo $total_bookings; ?></p>
            </div>
            <div class="card">
                <h3>Total Revenue</h3>
                <p>Rs. <?php echo number_format($total_revenue, 2); ?></p>
            </div>
            <div class="card">
                <h3>Pending Actions</h3>
                <p><?php echo $pending_count; ?></p>
            </div>
            <div class="card">
                <h3>Completed</h3>
                <p><?php echo $completed_count; ?></p>
            </div>
        </div>

        <div class="table-box">
            <h2>MANAGE APPOINTMENTS</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Haircut Style</th>
                        <th>Price</th>
                        <th>Date & Time</th>
                        <th>Payment</th>
                        <th>Current Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td>#<?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['style_name']); ?></td>
                                <td style="color: rgb(252, 180, 86); font-weight: bold;">Rs. <?php echo $row['price']; ?></td>
                                <td><?php echo $row['booking_date'] . ' @ ' . date("g:i A", strtotime($row['booking_time'])); ?></td>
                                <td>
                                    <span class="<?php echo ($row['payment_status'] == 'Paid') ? 'badge-paid' : 'badge-pending'; ?>">
                                        <?php echo $row['payment_status']; ?>
                                    </span>
                                </td>
                                <td>
                                    <form action="" method="POST" style="display:inline-flex; gap: 5px;">
                                        <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">
                                        <select name="status">
                                            <option value="Pending" <?php if(($row['status'] ?? 'Pending') == 'Pending') echo 'selected'; ?>>Pending</option>
                                            <option value="Approved" <?php if(($row['status'] ?? '') == 'Approved') echo 'selected'; ?>>Approved</option>
                                            <option value="Completed" <?php if(($row['status'] ?? '') == 'Completed') echo 'selected'; ?>>Completed</option>
                                            <option value="Cancelled" <?php if(($row['status'] ?? '') == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                                        </select>
                                </td>
                                <td>
                                        <input type="submit" name="update_status" value="Save" class="btn-save"> </form>
                                        <a href="admindashboard.php?delete_id=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" style="text-align: center; color: #888; padding: 20px;">No bookings found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>