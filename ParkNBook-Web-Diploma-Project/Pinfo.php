<?php
include "dbconnection.php";

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Check if there are any bookings for this parking spot
    $stmt_check_bookings = $conn->prepare("SELECT COUNT(*) FROM bookings WHERE parking_id = :parking_id");
    $stmt_check_bookings->execute([':parking_id' => $id]);
    $count = $stmt_check_bookings->fetchColumn();

    if ($count > 0) {
        // Redirect with error status if bookings exist
        header("Location: Pinfo.php?status=error");
        exit();
    } else {
        // No bookings, proceed with deletion
        $stmt_delete_parking = $conn->prepare("DELETE FROM parking WHERE id = :id");
        $stmt_delete_parking->execute([':id' => $id]);

        // Redirect with success status
        header("Location: Pinfo.php?status=success");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parking List</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f4f7fa;
      margin: 0;
      padding: 0;
	  animation: fadeIn 1s ease forwards;
    }
	@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
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
  $sql = "SELECT * FROM parking";
  $stmt = $conn->query($sql);
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if (count($rows) > 0) {
      echo "<table><br><br>";
      echo "<tr><th>ID</th><th>Name</th><th>Price</th><th>Action</th></tr>";
      foreach ($rows as $row) {
          echo "<tr>";
          echo "<td>" . ($row['id']) . "</td>";
          echo "<td>" . ($row['name']) . "</td>";
          echo "<td>" . ($row['price']) . "</td>";
          echo "<td>
              <a href='Pupdate.php?id=" . $row['id'] . "'>
                <button class='edit-btn'>Edit</button>
              </a>
              <a href='Pinfo.php?delete=" . $row['id'] . "' onclick=\"return confirm('Delete this parking slot?');\">
                <button class='delete-btn'>Delete</button>
              </a>
            </td>";
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
  
<?php
// Handle alerts based on status from URL
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    if ($status == 'error') {
        echo "<script>alert('Cannot delete – booking exists');</script>";
    } elseif ($status == 'success') {
        echo "<script>alert('Delete completed');</script>";
    }
}
?>
</body>
</html>
