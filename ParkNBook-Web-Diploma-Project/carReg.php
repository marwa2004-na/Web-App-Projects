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
    $email = $rows['email'];
    $phone = $rows['phone'];
    $cname = $rows['cname'];
} else {
    echo "Customer not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <title>Car Registration Page</title>
	
    <link rel="stylesheet" href="style.css"> 

</head>

<body>

<?php
$x = "carReg";
include('header.php');
?>

<script>
function validateVehicleNumber() {
    const vehicleInput = document.getElementById("vehicle_number").value.trim().toUpperCase();
    const pattern = /^[0-9]{1,5}[- ]?[A-Z]{1,2}$/;

    if (!pattern.test(vehicleInput)) {
        alert("Please enter a valid Omani vehicle number (e.g., 1234 A or 56789 AB).");
        return false;
    }

    return true;
}
</script>

<div class="login-container" style="width: 400px; padding: 40px;">
    <br><br><br><br><br><br><br><br><br><br>
    <h2 style="margin-bottom: 30px; color:#000435">Car Registration</h2>
		
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" 
          onsubmit="return validateVehicleNumber()">
          
        <div class="inputs">
            <label>Vehicle Number:</label>
            <input type="text" id="vehicle_number" name="vno" required placeholder="Enter your Vehicle Number">
        </div>

        <div class="inputs">
            <label>Vehicle Type:</label>
            <input type="text" id="vehicle_type" name="type" required placeholder="Enter your Vehicle Type">
        </div>

        <div class="inputs">
            <label for="vehicle_model">Vehicle Model:</label>
            <input type="text" id="vehicle_model" name="model" required placeholder="Enter your Vehicle Model">
        </div>

        <div style="display: flex; justify-content: space-between; margin-top: 20px;">
            <button type="submit" name="register" class="login_btn">Register</button>
            <button type="reset" class="login_btn">Clear</button>
        </div>
    </form>
</div>

</body>
</html>

<?php
if (isset($_POST['register'])) {
    $vno = $_POST['vno']; 
    $type = $_POST['type']; 
    $model = $_POST['model']; 

    if (!empty($vno) && !empty($type) && !empty($model)) {
        $cid = $_SESSION['cid']; 

        $sql = "insert into vehicle (cid, vno, type, model)
                values (:cid, :vn, :ty, :mo)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':cid' => $cid,  
            ':vn' => $vno,
            ':ty' => $type,
            ':mo' => $model
        ));

        header("Location: book.php");
        exit();
    } else {
        echo "Please fill in all fields.";
    }
}
?>
