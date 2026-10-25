<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>

   <!-- External Stylesheets -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style2.css">  
<style>
body {
  animation: fadeIn 1s ease forwards;
}
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}
    .stars {
      display: inline-block;
      direction: rtl;
    }
    .stars input {
      display: none;
    }
    .stars label {
      font-size: 30px;
      color: lightgray;
      cursor: pointer;
    }
    .stars input:checked ~ label {
      color: gold;
    }
    .stars label:hover,
    .stars label:hover ~ label {
      color: gold;
    }
  </style>
   
</head>

<body>
<?php
$x="home";
include('header.php');
?>


<!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-white w3-collapse" style="z-index:3;width:250px; margin-top:56px;" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-16">
    </div>
    <div class="w3-padding-64 w3-large" style="font-weight:bold; color:#000435">
        <a href="home.php" class="w3-bar-item w3-button">Home</a>
        <a href="carReg.php" class="w3-bar-item w3-button">Register Your Car</a>
        <a href="book.php" class="w3-bar-item w3-button">Book a Parking</a>
		<a href="account.php" class="w3-bar-item w3-button">
		<img src="account.png">&nbsp; Account </a>
    </div>
</nav>
<!-- Main Content -->
<div class="w3-main" style="margin-left:250px; margin-top:56px;">

    <!-- Hero Section -->
    <div class="w3-display-container w3-container">
        <img src="car.jpg" class="w3-justify-content w3-display-container">
        <div class="w3-display-topleft w3-text-white" style="padding:24px 48px">
            <h1 class="w3-jumbo w3-hide-small">Book a Parking Now!</h1>
            <h1 class="w3-hide-small">Secure Your Spot <br> 
			&nbsp;&nbsp;&nbsp; Before It's Too Late!</h1>
            <p>
                <a href="book.php" class="w3-button w3-padding-large w3-large btn">BOOK NOW</a>
            </p>
        </div>
    </div>

    <!-- Services Section -->
    <div class="w3-container" id="services" style="margin-top:75px; background:#9ABDDC">
        <h1 class="w3-xxxlarge" style="color:#000435"><b>Our Services</b></h1>
        <p style="color:#000435"><i>Drive Smart, Book Easy – Seamless Car Booking at Your Fingertips!</i></p>
        <p class="w3-text-white">
            Our Car Booking Management System is a seamless, efficient, and user-friendly platform designed to simplify vehicle reservations for individuals and businesses.
            Whether you’re a car rental agency, a chauffeur service, or a corporate fleet manager, our system ensures smooth scheduling, real-time availability tracking, and hassle-free payment processing.
            With features like instant booking, automated reminders, route optimization, and secure payment options, we provide an all-in-one solution to enhance customer satisfaction and operational efficiency.
            Our intuitive dashboard allows businesses to manage fleets effortlessly, while customers enjoy a quick and convenient booking experience.
        </p>
    </div>

    <!-- Footer Section -->
<footer class="w3-padding-64 w3-small w3-center" style="background:#AECCE4;" id="footer">
    <div class="w3-container">
    
        <div class="w3-row w3-center w3-padding-32" 
             style="display: flex; justify-content: center; flex-wrap: wrap; gap: 100px;">

            <!-- About Section -->
            
            <div class="w3-col s12 m6 l4 w3-padding" style="max-width: 300px;">
                <h4 class="color">About us</h4>
                <p class="w3-text-white">Learn more about our mission and services.</p>
                <a href="about.php" class="register-link">Click here to know more about us!</a>
            </div>

            <!-- Contact Section -->
     
            <div class="w3-col s12 m6 l4 w3-padding" style="max-width: 300px;">
                <h4 class="color">Contact</h4>
                <p><i class="fa fa-fw fa-phone"></i> 9999 9999</p>
                <p><i class="fa fa-fw fa-envelope"></i> Carbooking@gmail.com</p>
                <br>
                <div>
                    <i class="fa fa-instagram w3-hover-opacity w3-large" style="margin: 0 10px;"></i>
                    <i class="fa fa-twitter w3-hover-opacity w3-large" style="margin: 0 10px;"></i>
                    <i class="fa fa-linkedin w3-hover-opacity w3-large" style="margin: 0 10px;"></i>
                </div>
            </div>

        </div>
    </div>
</footer>

</div>

</body>
</html>
