<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>booking List</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f4f7fa;
      margin: 0;
      padding: 0;
    }

    h2 {
      text-align: center;
      color: #0a3d62;
      margin-top: 40px;
    }

    .container {
      width: 90%;
      max-width: 1000px;
      margin: 30px auto;
      background: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
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

    .delete-btn:hover {
      background-color: #e84118;
    }

    .edit-btn {
      background-color: #1e90ff;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .edit-btn:hover {
      background-color: #2980b9;
    }

    .no-data {
      text-align: center;
      padding: 20px;
      color: #555;
    }
  </style>
</head>
<body>
<?php include('header.php'); ?>

<div class="container">
<?php
include "dbconnection.php";

// Update the query to include the booking_date column (though SELECT * already fetches it)
$sql = "SELECT * FROM bookings"; 
$stmt = $conn->prepare($sql);
$stmt->execute(); 
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($rows) > 0) {
    echo "<table><br><br>";
    // Add the booking_date column in the table header
    echo "<tr><th>ID</th><th>Slot ID</th><th>Parking ID</th><th>Customer ID</th><th>Vehicle No</th><th>Booking Date</th><th>Start Time</th><th>End Time</th></tr>";
    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['slot_id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['parking_id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['cid']) . "</td>";
        echo "<td>" . htmlspecialchars($row['vno']) . "</td>";
        echo "<td>" . htmlspecialchars($row['booking_date']) . "</td>";
        echo "<td>" . htmlspecialchars($row['start_time']) . "</td>";
        echo "<td>" . htmlspecialchars($row['end_time']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br><br><div style='text-align: center;'>
        <a href='admin.php'>Back to the admin page</a>
      </div>";
} else {
    echo "<div class='no-data'>No parking records found.</div>";
}
?>
</div>

</div>

</div>

</div>
</body>
</html>