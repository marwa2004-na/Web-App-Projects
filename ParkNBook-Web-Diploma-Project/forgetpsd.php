<?php
include "dbconnection.php";

if (isset($_GET['cid'])) {
    $cid = $_GET['cid'];
    $sql = "select * from customer where cid = :cid";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':cid' => $cid]);
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $n = $stmt->rowCount();
    $psd = $rows['psd'];
    $email = $rows['email'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password Page</title>
    <link rel="stylesheet" href="style.css"> 
    <script>
        function validatePassword() {
            const password = document.getElementById("password").value;
            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&_]{8,}$/; // At least 8 characters, 1 uppercase, 1 lowercase, 1 number

            if (!passwordPattern.test(password)) {
                alert("Password must be at least 8 characters long, with at least one uppercase letter, one lowercase letter, and one number.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
<?php
$x = "forgetpsd";
include('header.php');
?>
<div class="login-container" style="width: 400px; padding: 40px;">
<br><br><br><br><br><br>
    <h2 style="margin-bottom: 30px; color:#000435">Forget Password</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validatePassword();">
        <div class="inputs">
            <label>Email: </label>
            <input type="text" id="customer_id" name="email" required placeholder="Enter your Email">
        </div>
        <div class="inputs">
            <label>New Password: </label>
            <input type="password" id="password" name="psd" required placeholder="Enter your Password">
        </div>
        <button type="submit" name="update" class="login_btn">Update</button>
        <p class="register_link"><a href="login.php">Login</a><br><br><br></p>
    </form>
</div>
</body>
</html>
<?php
include "dbconnection.php";

if (isset($_POST['update'])) {
    if (!empty($_POST['email']) && !empty($_POST['psd'])) {
        $email = $_POST['email'];
        $password = $_POST['psd'];

        if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&_]{8,}$/", $password)) {
            $sql = "select * from customer where email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':email' => $email]);
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
            $n = $stmt->rowCount();

            if ($n > 0) {
                $cid = $rows['cid'];
                if ($email == $rows['email']) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    $sql = "update customer set psd = :ps where cid = :cid";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([
                        ':ps' => $hashedPassword, 
                        ':cid' => $cid
                    ]);
                    header("Location: login.php?email=$email");
                    exit();
                }
            } else {
                echo "<script>alert('Account not found. Please check again!');</script>";
            }
        } else {
            echo "<script>alert('Password must be at least 8 characters long, with at least one uppercase letter, one lowercase letter, and one number.');</script>";
        }
    } else {
        echo "<script>alert('No data provided.');</script>";
    }
}
?>

