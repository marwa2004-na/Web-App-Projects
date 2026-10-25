<?php
include "dbconnection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    if (!preg_match('/^P\d+$/i', $name)) {
        echo "<script>alert('Invalid parking name. Use format like P01, P11, etc.'); window.location.href = 'Pinsert.php';</script>";
        exit();
    }

    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM parking WHERE name = :name");
    $checkStmt->execute([':name' => $name]);
    $count = $checkStmt->fetchColumn();

    if ($count > 0) {
        echo "<script>alert('Duplicate parking name! Please choose a different name.'); window.location.href = 'Pinsert.php';</script>";
        exit();
    }

    $insertStmt = $conn->prepare("INSERT INTO parking (name, price) VALUES (:name, :price)");
    $insertStmt->execute([
        ':name' => $name,
        ':price' => $price
    ]);

    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Parking Slot</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #0a3d62;
        }

        input, button {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        button {
            background-color: #0a3d62;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #0a2c49;
        }
    </style>
</head>
<body>

  <div class="container">
    <h2>Add New Parking Slot</h2>
    <form method="POST">
        <label for="name">Parking Name:</label>
        <input type="text" id="name" name="name" pattern="^P\d+$" title="Use format like P01, P11, etc." required>

        <label for="price">Price (OMR):</label>
        <input type="number" id="price" name="price" required>

        <button type="submit">Add Parking Slot</button>
		<button type="submit"><a style="color:white;" href="admin.php">back to the admin page</a></button>
    </form>
  </div>

</body>
</html>

