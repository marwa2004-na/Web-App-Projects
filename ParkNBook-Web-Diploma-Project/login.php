<?php 

    session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <title>Login Page</title>
	
    <link rel="stylesheet" href="style.css"> 

    
</head>
<script>
function validateForm() {
    // Get form field values
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    // Email Validation
    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!email.match(emailRegex)) {
        alert("Invalid email format.");
        return false;
    }

    // Password Validation: check if it's not empty
    if (password === "") {
        alert("Password is required.");
        return false;
    }

    return true; // Allow form submission
}
</script>
<body>

<?php
$x="login";
include('header.php');
?>
<div class="login-container" style="width: 400px; padding: 40px;">
  <br><br><br><br><br><br><br>
  <h2 style="margin-bottom: 30px; color:#000435">Login</h2>
		
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"
		onsubmit="return validateForm();">
            <div class="inputs">
                <label>Email: </label>
                <input type="text" id="customer_id" name="email" required 
				placeholder="Enter your Email">
            </div>

            <div class="inputs">
                <label>Password: </label>
                <input type="password" id="password" name="psd" required
				placeholder="Enter your Password">
            </div>

  <button type="submit" name="login" class="login_btn">Login</button>
  <p class="register_link"><a href="forgetpsd.php">Forget Password</a></p>
 <p class="register_link">Don't have an account? <a href="register.php">Register Now!</a></p>

        </form>
    </div>
	
</body>

</html>
<?php
include "dbconnection.php";

if (isset($_POST['login'])) {
    if (!empty($_POST['email']) && !empty($_POST['psd'])) {
        
        $email = $_POST['email'];
        $psd = $_POST['psd'];

        $sqlAdmin = "SELECT * FROM admin WHERE email = :email";
        $stmtAdmin = $conn->prepare($sqlAdmin);
        $stmtAdmin->execute([':email' => $email]);
        $admin = $stmtAdmin->fetch(PDO::FETCH_ASSOC);

        if ($admin && $psd === $admin['psd']) {
            $_SESSION['email'] = $admin['email'];
            $_SESSION['aid'] = $admin['aid']; 
            header("Location: admin.php"); 
        }

        $sqlCustomer = "SELECT * FROM customer WHERE email = :email";
        $stmtCustomer = $conn->prepare($sqlCustomer);
        $stmtCustomer->execute([':email' => $email]);
        $customer = $stmtCustomer->fetch(PDO::FETCH_ASSOC);

        if ($customer && password_verify($psd, $customer['psd'])) {
            $_SESSION['email'] = $customer['email'];
            $_SESSION['cid'] = $customer['cid']; 
            header("Location: home.php");
            exit();
        } else {
            echo "<script>alert('Incorrect email or password');</script>";
        }

    } else {
        echo "<script>alert('Please fill in both email and password');</script>";
    }
}
?>


