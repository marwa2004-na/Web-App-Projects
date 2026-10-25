<?php

try {
$conn = new PDO('mysql:host=localhost;port=3306;dbname=parknbook', 'root', '');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
}

catch(PDOException $e)
{
echo ("Internal Login Error, Please Contact Web Site Support");
$error = "Error message: ".$e->getMessage() ." Error at line: ".$e->getLine()."  
in a file named :  ".$e->getFile(); 
error_log($error);  //error will be logged to  C:\wamp64\logs\php_error.log
return;
}
?>

