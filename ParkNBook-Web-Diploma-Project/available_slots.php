<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include "dbconnection.php";
session_start();

if (!isset($_SESSION['cid'])) {
    header("Location: login.php");
    exit();
}

$cid = $_SESSION['cid'];

// Fetch customer details
$sql = "SELECT * FROM customer WHERE cid = :cid";
$stmt = $conn->prepare($sql);
$stmt->execute([':cid' => $cid]);
$rows = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$rows) {
    echo "<script>alert('❌ Customer not found.');</script>";
    exit();
}

// Get data from form
$parking_id = isset($_POST['parking_id']) ? (int) $_POST['parking_id'] : 0;
$slot_date = isset($_POST['slot_date']) ? $_POST['slot_date'] : '';
$vno = isset($_POST['vno']) ? $_POST['vno'] : '';

// Check vehicle number
if (empty($vno)) {
    echo "<script>alert('❌ Vehicle number (vno) is required.');</script>";
    exit();
}

// If no date provided, use today
if (empty($slot_date)) {
    $slot_date = date("Y-m-d");
}

// ✅ Corrected Query — Replaced booking_time with booking_date
$slotsQuery = $conn->prepare("SELECT * FROM parking_slots 
    WHERE parking_id = ? 
    AND slot_date = ? 
    AND id NOT IN (
        SELECT slot_id 
        FROM bookings 
        WHERE parking_id = ? 
        AND booking_date = ?)"
);
$slotsQuery->execute([$parking_id, $slot_date, $parking_id, $slot_date]);
$availableSlots = $slotsQuery->fetchAll(PDO::FETCH_ASSOC);

// Display slots if available
if (!empty($availableSlots)) {
    echo "<form action='book_slot.php' method='POST' class='form-center' id='bookingForm'>";
    echo "<h2>Available Slots for $slot_date</h2>";

    echo "<input type='hidden' name='parking_id' value='$parking_id'>";
    echo "<input type='hidden' name='slot_date' value='$slot_date'>";
    echo "<input type='hidden' name='vno' value='$vno'>";

    echo "<div class='form-container'>";
    echo "<div class='slot-container'>";

    foreach ($availableSlots as $slot) {
        $timeRange = date("H:i", strtotime($slot['start_time'])) . " - " . date("H:i", strtotime($slot['end_time']));
        echo "<div>";
        echo "<label><input type='checkbox' name='slot_ids[]' value='{$slot['id']}' class='slot-checkbox'>$timeRange</label>";
        echo "</div>";
    }

    echo "</div>";
    echo "<p id='max-slots-warning' class='max-slots-warning'>❌ You can only select up to 3 time slots.</p>";
    echo "<button type='submit'>Book Selected Slots</button>";
    echo "</div>";
    echo "</form>";
} else {
    echo "<script>alert('❌ No available slots for the selected date and parking lot.');</script>";
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
        /* Centering the form */
        .form-center {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            height: 100vh; /* Full height of the viewport */
            margin: 0;
        }

        /* Styling the content */
        .form-container {
            width: 50%; /* Adjust the width as necessary */
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .slot-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px; /* Adds space between the checkboxes */
        }

        .slot-container div {
            margin-bottom: 15px; /* Space below each checkbox */
        }

        .slot-container input {
            margin-right: 15px;
            margin-bottom: 10px;
        }

        button {
            background-color: #0077cc;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #005fa3;
        }

        /* Restricting more than three checkboxes */
        .max-slots-warning {
            color: red;
            display: none;
        }
    </style>
</head>
<body>

<?php
$x = "available_slots";
include('header.php');
?>

<!-- Booking Form -->
<div class="content">
    <!-- The booking form is already displayed above -->
</div>

<script>
document.getElementById("bookingForm").addEventListener("submit", function(e) {
    const checkedSlots = document.querySelectorAll('input[name="slot_ids[]"]:checked');
    if (checkedSlots.length === 0) {
        e.preventDefault();
        alert("❌ Please select at least one slot.");
    }
});

const slotCheckboxes = document.querySelectorAll('.slot-checkbox');
const maxSlotsWarning = document.getElementById('max-slots-warning');

slotCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
        const selectedSlots = document.querySelectorAll('input[name="slot_ids[]"]:checked');
        if (selectedSlots.length > 3) {
            maxSlotsWarning.style.display = 'block';
            checkbox.checked = false; // Uncheck the last one
        } else {
            maxSlotsWarning.style.display = 'none';
        }
    });
});
</script>
</body>
</html>




