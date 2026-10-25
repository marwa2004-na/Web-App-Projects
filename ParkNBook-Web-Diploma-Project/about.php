<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>about Page</title>
	


    <!-- External Stylesheets -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style2.css">
 <style>
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
$x="about";
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


    <!-- Overlay for Sidebar on Small Screens -->
    <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

    <!-- Main Content -->
    <div class="w3-main" style="margin-left:250px; margin-top:50px;">

        <!-- Hero Section -->
        <div class="w3-display-container w3-container">
            <img src="about.jpg" class="w3-justify-content w3-display-container" >
            <div class="w3-display-topleft w3-text-white" style="padding:24px 48px">
                
            </div>
        </div>

             <!-- Services Section -->
        <div class="w3-container" id="services" style="margin-top:75px; background:#9ABDDC">
            <h1 class="w3-xxxlarge" style="color:#000435"><b><br>About Us</b></h1>
            <p class="w3-text-white">
                We started our service on 2025 for citizens in Sultanate <br>
				of oman to be able to find,reserve and <br>
				Park there cars faster and easier.
				<br><br>
				This services was made to reduce people<br>
				hassale of finding a car as well as <br>
				reduce streets congestion.<br><br><br><br>
				
            </p>
        </div>

     <br><br><br><br><br>
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

    <!-- JavaScript for Sidebar -->
    <script>
        // Open and close sidebar
        function w3_open() {
            document.getElementById("mySidebar").style.display = "block";
            document.getElementById("myOverlay").style.display = "block";
        }

        function w3_close() {
            document.getElementById("mySidebar").style.display = "none";
            document.getElementById("myOverlay").style.display = "none";
        }
    </script>

</body>
</html>