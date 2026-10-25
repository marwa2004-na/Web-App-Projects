<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>
<?php
function webpage($x){
    echo " $x page";
}
webpage($x);
?>
</title>
<style>

body {
  animation: fadeIn 1s ease forwards;
}
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}
</style>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="style2.css"> 
</head>


<body>
<header class="w3-bar w3-top w3-xlarge color">
    <a href="home.php" style="text-decoration:none;">
        <div class="w3-bar-item w3-padding-24 w3-wide" style="display: flex; align-items: center; gap: 10px;">
            <span>ParkNBook</span>
            <img src="icon.png" alt="Logo" style="height: 45px;">
        </div>
    </a>
    
    <div class="w3-bar-item w3-padding-24 w3-wide" style="float:right">
        <div>
            <img src="user.png" alt="cid" class="user-img">
            <?php if (isset($_SESSION['cid'])): ?>
                <span style="font-size:16px;">Welcome</span>
            <?php elseif(isset($_SESSION['aid'])): ?>
				 <span style="font-size:16px;">Welcome</span>
				 <?php else: ?>
                <a href="register.php" style="text-decoration:none; font-size:16px;">Register or</a> 
                <a href="login.php" style="text-decoration:none; font-size:16px;">Login</a>
            <?php endif; ?>
        </div>
    </div>
</header>

</body>
