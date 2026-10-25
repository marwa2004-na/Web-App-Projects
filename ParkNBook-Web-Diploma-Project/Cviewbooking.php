<?php
include "dbconnection.php";
session_start(); 
if (!isset($_SESSION['cid'])) {
    header("Location: login.php"); 
    exit();
}

$cid = $_SESSION['cid']; 

$sql = "select * from customer where cid = :cid";
$stmt = $conn->prepare($sql);
$stmt->execute([':cid' => $cid]);
$rows = $stmt->fetch(PDO::FETCH_ASSOC);

if ($rows) {
    $psd = $rows['psd'];
    $email = $rows['email'];
    $phone = $rows['phone'];
    $cname = $rows['cname'];
} else {
    echo "Customer not found.";
    exit();
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Page</title>
    <link rel="stylesheet" href="style.css"> 
	<style>
	body {
  animation: fadeIn 1s ease forwards;
}
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}
 th {
      background-color: #0a3d62;
      color: #fff;
      padding: 12px;
      text-align: left;
      font-size: 16px;
    }

    td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      font-size: 15px;
    }

    tr:hover {
      background-color: #f1f1f1;
      transition: background-color 0.3s;
    }

    .delete-btn {
      background-color: #ff4757;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s;
    }
	</style>
</head>
<body>
<?php
$x = "register";
include('header.php');
?>
<div class="dashboard-container" style="display: flex; flex-direction: row; min-height: 100vh;">
    
    <!-- Sidebar -->
    <div class="sidebar" style="width: 220px; background-color: #000435; padding: 20px; color: white;">
        <h2 style="margin-bottom: 50px;height:auto;"><br><br>Welcome, <?php echo htmlspecialchars($cname); ?></h2>
        <ul style="list-style: none; padding: 0;">
            <li style="margin-bottom: 15px;"><a href="home.php" style="color: white; text-decoration: none;">Home Page</a></li>
            <li style="margin-bottom: 15px;"><a href="Cviewbooking.php" style="color: white; text-decoration: none;"> My Bookings</a></li>
            <li style="margin-bottom: 15px;"><a href="account.php" style="color: white; text-decoration: none;"> update my account</a></li>
            <li style="margin-bottom: 15px;"><a href="logout.php" style="color: #f88; text-decoration: none;"> Log Out</a></li>
        </ul>
    </div>
	
	<div style="flex-grow: 1; display: flex; justify-content: center; align-items: center;">
	<?php
	$sql = "SELECT * FROM bookings WHERE cid = :cid ORDER BY booking_date DESC";
	$stmt = $conn->prepare($sql);
	$stmt->execute([':cid' => $cid]);
	$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
	?>
	
	 <div style="width: 220%; background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
            <h2 style="color: #000435; text-align: center;">My Bookings</h2>

            <?php if ($bookings): ?>
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr style="background-color: #f0f0f0;">
                        <th style="text-align: left; padding: 10px;">Booking ID</th>
                        <th style="text-align: left; padding: 10px;">Slot ID</th>
                        <th style="text-align: left; padding: 10px;">Parking ID</th>
                        <th style="text-align: left; padding: 10px;">Vehicle No</th>
                        <th style="text-align: left; padding: 10px;">Booking Date</th>
                        <th style="text-align: left; padding: 10px;">Start time </th>
                        <th style="text-align: left; padding: 10px;">End time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td style="padding: 10px;"><?php echo htmlspecialchars($booking['id']); ?></td>
                        <td style="padding: 10px;"><?php echo htmlspecialchars($booking['slot_id']); ?></td>
                        <td style="padding: 10px;"><?php echo htmlspecialchars($booking['parking_id']); ?></td>
                        <td style="padding: 10px;"><?php echo htmlspecialchars($booking['vno']); ?></td>
						<td style="padding: 10px;"><?php echo htmlspecialchars($booking['booking_date']); ?></td>
						<td style="padding: 10px;"><?php echo htmlspecialchars($booking['start_time']); ?></td>
						<td style="padding: 10px;"><?php echo htmlspecialchars($booking['end_time']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p style="text-align:center;">You have no bookings yet.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>