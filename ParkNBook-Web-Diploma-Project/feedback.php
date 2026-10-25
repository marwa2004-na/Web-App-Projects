<?php
session_start(); // Start the session
$email = isset($_SESSION['email']) ? $_SESSION['email'] : ''; // Get email from session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Page</title>
    <link rel="stylesheet" href="style.css"> 
    <script>
        function popup() {
            alert("Feedback Received!");
        }

        function validateFeedbackForm() {
            var email = document.getElementById("customer_email").value.trim();
            var feedback = document.getElementById("customer_feedback").value.trim();
            var rating = document.querySelector('input[name="rating"]:checked');

            var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!email.match(emailRegex)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // Feedback Validation
            if (feedback === "") {
                alert("Feedback is required.");
                return false;
            }

            if (!rating) {
                alert("Please select a rating.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

    <?php
        $x = "feedback";
        include('header.php');
    ?>

<div class="login-container" style="width: 400px; padding: 40px;">
<br><br><br><br>
    <h2 style="margin-bottom: 30px; color:#000435">Feedback</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateFeedbackForm();">
        <div class="inputs">
            <input type="email" id="customer_email" name="email" required value="<?php echo htmlspecialchars($email); ?>">
        </div>

        <div class="inputs">
            <input type="text" id="customer_feedback" name="feedback" required placeholder="Enter your Feedback">
        </div>
        <br>
        <label>Rating:</label>
        <div class="stars">
            <input type="radio" id="star1" name="rating" value="1">
            <label for="star1" title="Very Poor">★</label>

            <input type="radio" id="star2" name="rating" value="2">
            <label for="star2" title="Poor">★</label>

            <input type="radio" id="star3" name="rating" value="3">
            <label for="star3" title="Average">★</label>

            <input type="radio" id="star4" name="rating" value="4">
            <label for="star4" title="Good">★</label>

            <input type="radio" id="star5" name="rating" value="5">
            <label for="star5" title="Excellent">★</label>
        </div>
        <br><br>
        <button type="submit" name="send" class="login_btn">Send</button>
        <br><br><br><br><br><br>
    </form>
</div>
    
</body>
</html>

<?php
include "dbconnection.php";
if (isset($_POST['send'])) {
    if (!empty($_POST['feedback']) && isset($_POST['rating'])) {
        if (preg_match("/^[\w\-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $_POST['email'])) {
            $email = $_POST['email'];
            $sql = "select cid from customer where email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':email' => $email]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row) {
                $cid = $row['cid'];
                $sql = "insert into feedback (cid, feedback, rating)
                values (:cid, :fe, :ra)";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array(
                    ':cid' => $cid,
                    ':fe' => $_POST['feedback'],
                    ':ra' => $_POST['rating']
                ));
                echo "<script>popup();</script>";
                header("location:thankyou.php");
                exit();
            } else {
                echo "Customer not found.";
            }
        } else {
            echo "Invalid email format.";
        }
    } else {
        echo "Feedback and rating are required.";
    }
}
?>



