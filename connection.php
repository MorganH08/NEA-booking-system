<?php
$servername="localhost";
$username="root";
$password="password";
$dbname="nea_booking_system";

try{
    $conn= new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo("Connected successfully<br>"); #message displayed if connection is successful
}
catch(PDOException $e){
    echo("Connection failed: " . $e->getMessage()); #error message if connection doesnt work
}
?>




