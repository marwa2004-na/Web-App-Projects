<?php
include "dbconnection.php";
session_start(); 
if (!isset($_SESSION['cid'])) {
    header("Location: login.php"); 
    exit();
}

$cid = $_SESSION['cid']; 

$sql = "SELECT * FROM customer WHERE cid = :cid";
$stmt = $conn->prepare($sql);
$stmt->execute([':cid' => $cid]);
$rows = $stmt->fetch(PDO::FETCH_ASSOC);

$vehicleSql = "SELECT vno, type FROM vehicle WHERE cid = :cid";
$vehicleStmt = $conn->prepare($vehicleSql);
$vehicleStmt->execute([':cid' => $cid]);
$vehicles = $vehicleStmt->fetchAll(PDO::FETCH_ASSOC);

if (!$rows) {
    echo "Customer not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Page</title>

    <!-- External Stylesheets -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Montserrat">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            background-color: #9ABDDC;
            margin-top: 75px;
        }
        .w3-sidebar a {
            color: #000435;
        }
        .slotButton {
            width: 100px;
            height: 100px;
            background-color: #ccc;
            border: 2px solid #888;
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            color: #000435;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .slotButton:hover {
            background-color: #8ab4f8;
        }
        .slotButton.selected {
            background-color: #0077cc;
            color: white;
            border: 2px solid #003366;
        }
    .pslots-image {
        max-width: 100%; /* Make it responsive */
        height: auto;    /* Maintain the aspect ratio */
        border-radius: 10px;  /* Optional: Add rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Optional: Add shadow for better look */
        display: block;
        margin: 0 auto;  /* Center the image */
    }
    </style>
</head>

<body>

<?php
$x = "book";
include('header.php');
?>

<!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-white w3-collapse" style="z-index:3;width:250px; margin-top:56px;" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-16"></div>
    <div class="w3-padding-64 w3-large" style="font-weight:bold; color:#000435">
        <a href="home.php" class="w3-bar-item w3-button">Home</a>
        <a href="carReg.php" class="w3-bar-item w3-button">Register Your Car</a>
        <a href="book.php" class="w3-bar-item w3-button">Book a Parking</a>
        <a href="account.php" class="w3-bar-item w3-button">
            <img src="account.png">&nbsp; Account
        </a>
    </div>
</nav>

<!-- Main Content -->
<div class="content" style="color: white;">
    <h1 class="w3-xxxlarge" style="color:#000435;"><b><i>Parking Booking</i></b></h1>
    <p>Choose the parking spot, date, and time, then search for available time slots</p>

    <br>
    <img src="pslots.png" class="pslots-image" alt="Parking Slots">
<br><br>

    <label>Enter all the booking information:</label><br><br>

    <form action="available_slots.php" method="POST">
        <input type="hidden" name="cid" value="<?php echo $cid; ?>">

        <!-- Vehicle Selection -->
        <label>Choose Vehicle:</label>
        <select name="vno" required>
            <?php foreach ($vehicles as $vehicle): ?>
                <option value="<?php echo $vehicle['vno']; ?>">
                    <?php echo "{$vehicle['type']} ({$vehicle['vno']})"; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <?php
        $stmt = $conn->query("SELECT * FROM parking");
        $parkingList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <label>Select Parking Lot:</label>
        <select name="parking_id" required>
            <?php foreach ($parkingList as $lot): ?>
                <option value="<?= $lot['id'] ?>"><?= $lot['name'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Check Available Slots</button>
    </form>
</div>

</body>
</html>






