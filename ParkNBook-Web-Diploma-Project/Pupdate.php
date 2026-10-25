<?php
include "dbconnection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $stmt = $conn->prepare("SELECT * FROM parking WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $parking = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$parking) {
        echo "Parking slot not found.";
        exit();
    }
} else {
    echo "No parking ID provided.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Attempt to update parking slot
    $updateStmt = $conn->prepare("UPDATE parking SET name = :name, price = :price WHERE id = :id");

    try {
        $updateStmt->execute([
            ':name' => $name,
            ':price' => $price,
            ':id' => $id
        ]);
        
        // Redirect to admin page after successful update
        header("Location: admin.php");
        exit();

    } catch (PDOException $e) {
        // Check if the error is due to a duplicate entry
        if ($e->getCode() == 23000) {
            echo "<script>alert('Duplicate parking name! Please choose a different name.');</script>";
        } else {
            echo "<script>alert('An error occurred: " . $e->getMessage() . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Parking Slot</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7fa;
            margin: 0;
            padding: 0;
        }
			@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
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
    <h2>Edit Parking Slot</h2>
    <form method="POST">
        <label for="name">Parking Name:</label>
        <input type="text" id="name" name="name" value="<?= $parking['name'] ?>" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?= $parking['price'] ?>" required>

        <button type="submit">Update Parking Slot</button>
    </form>
  </div>

</body>
</html>
