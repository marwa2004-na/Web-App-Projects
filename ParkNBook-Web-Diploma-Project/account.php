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
}

if (isset($_POST['save'])) {
    if (!empty($_POST['email']) && !empty($_POST['psd']) && 
        !empty($_POST['cname']) && !empty($_POST['phone'])) {
        
        $email = $_POST['email'];
        $psd = $_POST['psd'];  
        $cname = $_POST['cname'];
        $phone = $_POST['phone'];

        // Hash the password
        $hashedPassword = password_hash($psd, PASSWORD_DEFAULT);

        
        $sql = "update customer set cname = :cn, email = :em, psd = :ps, phone = :ph where cid = :cid";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':cn' => $cname,
            ':em' => $email,
            ':ps' => $hashedPassword,  
            ':ph' => $phone,
            ':cid' => $cid
        ]);

        
        header("Location: home.php?email=$email");
        exit();
    } else {
        echo "Please fill in all fields.";
    }
}
?>
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

    <!-- Main content area -->
    <div style="flex-grow: 1; display: flex; justify-content: center; align-items: center;">
        <?php if (basename($_SERVER['PHP_SELF']) == "account.php") : ?>
        <div class="login-container" style="width: 400px; padding: 40px;">
            <br><br><br>
            <h2 style="margin-bottom: 30px; color:#000435">Account updating</h2>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateForm()">
                <div class="inputs">
                    <label>Full Name: </label>
                    <input type="text" id="name" name="cname" required value="<?php echo htmlspecialchars($cname); ?>">
                </div>
                <div class="inputs">
                    <label>Email: </label>
                    <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email); ?>">
                </div>
                <div class="inputs">
                    <label>Password: </label>
                    <input type="password" id="password" name="psd" required value="<?php echo htmlspecialchars($psd); ?>">
                </div>
                <div class="inputs">
                    <label>Phone Number: </label>
                    <input type="tel" id="phoneNo" name="phone" required value="<?php echo htmlspecialchars($phone); ?>">
                </div>
                <button type="submit" name="save" class="login_btn">update</button>
                <br><br>
            </form>
        </div>
        <?php endif; ?>
    </div>
</div>
<script>
function validateForm() {
    var email = document.forms[0]["email"].value;
    var phone = document.forms[0]["phone"].value;

    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!email.match(emailRegex)) {
        alert("Invalid email format.");
        return false; 
    }

    var phoneRegex = /^[0-9]{8}$/; // Adjust regex to match your phone format
    if (!phone.match(phoneRegex)) {
        alert("Invalid phone number format.");
        return false; 
    }

    return true; 
}
</script>

</body>
</html>