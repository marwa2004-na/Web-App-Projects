<?php
session_start(); // Start the session

$pdo = new PDO("mysql:host=localhost;dbname=parknbook", "root", "");

// Retrieve the customer ID from the session
$cid = isset($_SESSION['cid']) ? $_SESSION['cid'] : null;
if (!$cid) {
    echo "❌ You must be logged in to book a slot.";
    exit();
}

// Settings from POST
$parking_id = $_POST['parking_id'];
$slot_date = $_POST['slot_date'];
$vno = $_POST['vno'];
$slot_ids = $_POST['slot_ids'];

$successfulSlots = [];

foreach ($slot_ids as $slot_id) {
    $slot_id = (int) $slot_id;

    // Check if slot is already booked for this date and parking lot
    $check = $pdo->prepare("SELECT COUNT(*) FROM bookings WHERE slot_id = ? AND parking_id = ? AND booking_date = ?");
    $check->execute([$slot_id, $parking_id, $slot_date]);

    if ($check->fetchColumn() == 0) {
        // Fetch time details from parking_slots
        $slotInfoStmt = $pdo->prepare("SELECT start_time, end_time, slot_date FROM parking_slots WHERE id = ?");
        $slotInfoStmt->execute([$slot_id]);
        $slotInfo = $slotInfoStmt->fetch(PDO::FETCH_ASSOC);

        if ($slotInfo) {
            $start_time = $slotInfo['start_time'];
            $end_time = $slotInfo['end_time'];
            $booking_date = $slotInfo['slot_date']; // Usually matches $slot_date

            // Insert into bookings
            $stmt = $pdo->prepare("INSERT INTO bookings (cid, vno, parking_id, slot_id, booking_date, start_time, end_time) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$cid, $vno, $parking_id, $slot_id, $booking_date, $start_time, $end_time]);

            if ($stmt->errorCode() == '00000') {
                $successfulSlots[] = $slot_id;
            } else {
                echo "❌ Error booking slot $slot_id: " . implode(", ", $stmt->errorInfo());
            }
        } else {
            echo "❌ Slot information not found for slot ID $slot_id.";
        }
    } else {
        echo "❌ Slot $slot_id is already booked for $slot_date.<br>";
    }
}

// Redirect if successful
if (!empty($successfulSlots)) {
    $_SESSION['booked_slots'] = $successfulSlots;
    $_SESSION['vno'] = $vno;
    $_SESSION['parking_id'] = $parking_id;
    header("Location: pay.php");
    exit();
} else {
    echo "❌ No slots were booked. All selected slots may already be taken.";
}
?>








