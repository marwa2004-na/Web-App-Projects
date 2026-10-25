<?php
include "dbconnection.php";

if (isset($_GET['delete'])) {
    $cid = $_GET['delete'];
    $stmt = $conn->prepare("delete from customer where cid = :cid");
    $stmt->execute([':cid' => $cid]);
    header("Location: Cinfo.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Customer List</title>
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

    .no-data {
      text-align: center;
      padding: 20px;
      color: #555;
    }
  </style>
</head>
<body>
<br><br>
<br>
<br>
<br>

<?php include('header.php'); ?>


<div class="container">
<?php
$sql = "select * from customer";
$stmt = $conn->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($rows) > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Action</th></tr>";
    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td>" . ($row['cid']) . "</td>";
        echo "<td>" . ($row['cname']) . "</td>";
        echo "<td>" . ($row['email']) . "</td>";
        echo "<td>" . ($row['phone']) . "</td>";
        echo "<td>
            <a href='Cinfo.php?delete=" . $row['cid'] . "' onclick=\"return confirm('Delete this customer?');\">
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
    echo "<div class='no-data'>No customer records found.</div>";
}
?>
</div>

</body>
</html>
