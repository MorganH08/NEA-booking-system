<?php
$servername="localhost";
$username="root";
$password="password";
$conn= new PDO("mysql:host=$servername",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql="CREATE DATABASE IF NOT EXISTS nea_booking_system";
$conn->exec($sql);
$sql="USE nea_booking_system";
$conn->exec($sql);
echo("DB created successfully<br>");

// create users table
$stmt=$conn->prepare("DROP TABLE IF EXISTS tblusers;
CREATE TABLE tblusers
(UserID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
EmailAddress VARCHAR(100) NOT NULL,
Surname  VARCHAR(20) NOT NULL,
Forename  VARCHAR(20) NOT NULL,
Password  VARCHAR(255) NOT NULL,
Technician BOOLEAN NOT NULL
);
"); // technician = 1, teacher = 0

echo("tblusers created<br>");
//add in test bed of users

$hashedpassword=password_hash("password",PASSWORD_DEFAULT);
echo($hashedpassword);
echo("<br>");

$stmt=$conn->prepare("INSERT INTO tblusers
(UserID,EmailAddress,Surname,Forename,Password,Technician)
VALUES
(NULL,'cunniffe.r@mail.com','Cunniffe','Robert',:Password,1),
(NULL,'smith.b@mail.com','Smith','Bob',:Password,0),
(NULL,'jones.d@mail.com','Jones','Dave',:Password,0)
");

$stmt->bindParam(":Password1", $hashedpassword);
$stmt->bindParam(":Password2", $hashedpassword);
$stmt->bindParam(":Password3", $hashedpassword);
echo("users added<br>");

$stmt=$conn->prepare("DROP TABLE IF EXISTS tblstock;
CREATE TABLE tblstock
(ItemID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Name VARCHAR(20) NOT NULL,
Quantity DECIMAL(7,3) NOT NULL,
Price DECIMAL(6,2) NOT NULL,
Category VARCHAR(20) NOT NULL,
Location VARCHAR(4) NOT NULL,
Units VARCHAR(10) NOT NULL
);
");

echo("tblstock created<br>");
// adds in table to keep track of stock

$stmt=$conn->prepare("INSERT INTO tblstock
    (ItemID, Name, Quantity, Price, Category, Location, Units)
    VALUES
    (NULL,'Microscope',15,200.00,'Digital','SP7','Units'),
    (NULL,'Hydrochloric acid',2000,150.00,'Chemicals','SP7,'mL')
    ");
    
echo("stock added<br>");


$stmt=$conn->prepare("DROP TABLE IF EXISTS tblrequests;
CREATE TABLE tblrequests
(RequestID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
UserID INT(4) NOT  NULL,
RequestDate  DATETIME NOT NULL,
DeliveryDate DATE NOT NULL,
ExtraNotes TEXT(1000),
Technician TEXT(50) NOT NULL,
);
");

echo("tblrequests created<br>");

$stmt=$conn->prepare("DROP TABLE IF EXISTS tblbasket;
CREATE TABLE tblbasket
(OrderID INT(4) NOT NULL,
Quantity  INT(2) DEFAULT 1,
FoodID INT(4) NOT NULL,
PRIMARY KEY (OrderID, FoodID)
);
");
$stmt->execute();
echo("tblbasket created<br>");
?>
