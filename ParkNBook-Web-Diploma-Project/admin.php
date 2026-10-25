<?php
session_start();
$x = "admin";
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      display: flex;
      background-color: #f1f1f1;
    }

    .sidebar {
      width: 240px;
      background-color: #000435;
      padding: 20px;
      color: white;
      height: 100vh;
      position: fixed;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .sidebar img.profile-pic {
      height: 120px;
      width: 120px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 10px;
    }

    .sidebar h3 {
      margin: 0 0 30px 0;
      text-align: center;
      font-size: 18px;
    }

    .sidebar button {
      background: none;
      border: none;
      color: white;
      padding: 10px 0;
      text-align: left;
      width: 100%;
      cursor: pointer;
      font-size: 16px;
    }

    .sidebar button:hover {
      color: #f88;
    }

    .sidebar img.icon {
      height: 20px;
      vertical-align: middle;
      margin-left: 8px;
    }

    .main-content {
      margin-left: 260px;
      padding: 30px;
      flex: 1;
    }

    .main-content h2 {
      margin-top: 0;
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar" style="width:500px;"><br><br><br><br><br>
  <img src="profilepic.avif" alt="Avatar" class="profile-pic">
  <h1 style="margin: auto; text-align: center;"><b><i>Admin Profile</i></b></h1>
  <button style="margin: auto; text-align: center;" onclick="location.href='Cinfo.php'">
    Customer Details
  </button>
  <button style="margin: auto; text-align: center;" onclick="location.href='Pinfo.php'">
    Parking View 
  </button>
  <button style="margin: auto; text-align: center;" onclick="location.href='pinsert.php'">
    Parking Addition 
  </button>
  <button style="margin: auto; text-align: center;" onclick="location.href='binfo.php'">
    Booking View 
  </button>
  <button style="margin: auto; text-align: center;" onclick="location.href='finfo.php'">
    Feedback View
  </button>
  <button style=" color:#f88;margin: auto; text-align: center;" onclick="location.href='logout.php'">
    Log Out
  </button>
</div>



</body>
</html>

