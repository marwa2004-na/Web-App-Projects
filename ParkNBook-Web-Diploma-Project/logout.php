<!DOCTYPE html>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <title>Logout Page</title>
	
    <link rel="stylesheet" href="style.css"> 

    
</head>

<body>

<?php
$x="logout";
include('header.php');


include "dbconnection.php";
session_start();
session_unset() ; 
session_destroy() ;
header("location:home.php");
exit();
?>