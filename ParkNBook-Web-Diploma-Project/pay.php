<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="style.css"> 
</head>

<body>
<?php
include('header.php'); 
?>
<div class="login-container" style="width: 400px; padding: 40px; text-align: center;">
    <h2 style="margin-bottom: 30px; color:#000435;">Payment</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateForm();">
        <div class="inputs" style="margin-bottom: 20px;">
            <select id="payment_method" name="payment_method" required style="width: 100%; padding: 10px;">
                <option value="">Select Payment Method</option>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>
        </div>
        <button type="submit" name="pay" class="login_btn" >Pay</button>
    </form>
</div>

</body>
</html>

<?php
include "dbconnection.php";

if (isset($_POST['pay'])) {
    

        header("Location: feedback.php");
        exit();
    } 

?>

