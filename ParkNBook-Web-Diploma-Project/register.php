<?php
include "dbconnection.php";

if (isset($_POST['register'])) {
    if (preg_match("/^[A-Za-z\s]+$/", $_POST['cname']) && 
        preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/", $_POST['email']) && 
        preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&_]{8,}$/", $_POST['psd']) && 
        preg_match("/^[0-9]{8}$/", $_POST['phone'])) {

        if (!empty($_POST['cname']) && !empty($_POST['email']) && 
            !empty($_POST['psd']) && !empty($_POST['phone'])) {

            // Check if the email already exists in the database
            $email = $_POST['email'];
            $sql = "SELECT * FROM customer WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':email' => $email]);

            if ($stmt->rowCount() > 0) {
                // If email exists, alert user
                echo "<script>alert('Email already exists. Please use a different email.'); window.history.back();</script>";
                exit();
            }

            // Hash the password
            $hashedPassword = password_hash($_POST['psd'], PASSWORD_BCRYPT);

            // Insert into the database
            $sql = "INSERT INTO customer (cname, email, psd, phone) 
                    VALUES (:cn, :em, :ps, :ph)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':cn' => $_POST['cname'],
                ':em' => $_POST['email'],
                ':ps' => $hashedPassword, 
                ':ph' => $_POST['phone']
            ]);

            // Redirect to car registration page
            header("Location: carReg.php");
            exit();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

<?php
$x="register";
include('header.php');
?>

<div class="login-container" style="width: 400px; padding: 40px;">
<br><br><br><br><br><br><br>
    <h2 style="margin-bottom: 30px; color:#000435">Register</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" 
	onsubmit="return validateForm()">
        <div class="inputs">
            <label>Full Name: </label>
            <input type="text" id="name" name="cname" required placeholder="Enter your Full Name">
        </div>
        <div class="inputs">
            <label>Email: </label>
            <input type="email" id="email" name="email" required placeholder="Enter your Email">
        </div>
        <div class="inputs">
            <label>Password: </label>
            <input type="password" id="password" name="psd" required placeholder="Enter your Password">
        </div>
        <div class="inputs">
            <label>Phone Number: </label>
            <input type="tel" id="phoneNo" name="phone" required placeholder="Enter your Phone Number">
        </div>
        <button type="submit" name="register" class="login_btn">Register</button>
        <p class="register_link">Already have an account? <a href="login.php">Login</a></p>
    </form>
</div>

<script>
function validateForm() {
    var cname = document.forms[0]["cname"].value;
    var email = document.forms[0]["email"].value;
    var password = document.forms[0]["psd"].value;
    var phone = document.forms[0]["phone"].value;

    // Name Validation: only letters and spaces allowed
    var nameRegex = /^[A-Za-z\s]+$/;
    if (!nameRegex.test(cname)) {
        alert("Full Name must contain only letters and spaces.");
        return false; // Prevent form submission
    }

    // Email Validation
    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!email.match(emailRegex)) {
        alert("Invalid email format.");
        return false; // Prevent form submission
    }

    // Password Validation: at least 8 characters, 1 uppercase, 1 lowercase, 1 number
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&_]{8,}$/; 
    if (!passwordPattern.test(password)) {
        alert("Password must be at least 8 characters long, with at least one uppercase letter, one lowercase letter, and one number.");
        return false; // Prevent form submission
    }

    // Phone Validation
    var phoneRegex = /^[0-9]{8}$/;
    if (!phone.match(phoneRegex)) {
        alert("Phone number must be exactly 8 digits.");
        return false; // Prevent form submission
    }

    return true; // Allow form submission
}
</script>
</body>
</html>
