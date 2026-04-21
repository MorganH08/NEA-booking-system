<?php
$servername="localhost";
$username="root";
$password="password";
$conn= new PDO("mysql:host=$servername",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql="CREATE DATABASE IF NOT EXISTS NEA-booking-system";
$conn->exec($sql);
$sql="USE NEA-booking-system";
$conn->exec($sql);
echo("DB created successfully<br>");
// create users table
$stmt=$conn->prepare("DROP TABLE IF EXISTS tblusers;
CREATE TABLE tblusers
(UserID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
EmailAddress VARCHAR(100) NOT NULL,
Surname  VARCHAR(20) NOT NULL,
Forename  VARCHAR(20) NOT NULL,
Password  VARCHAR(MAX) NOT NULL,
Technician BOOLEAN 
);
"); // technician = 1, teacher = 0

$stmt->execute();
echo("tblusers created<br>");
//add in test bed of users
;
$hashedpassword=password_hash("password",PASSWORD_DEFAULT);
//echo($hashedpassword);

$stmt=$conn->prepare("INSERT INTO tblusers 
(UserID,Username,Surname,Forename,Password,Year,Balance,Role)
VALUES
(NULL,'cunniffe.r','Cunniffe','Robert',:Password,13,10.00,1),
(NULL,'smith.b','Smith','Bob',:Password,12,100,0),
(NULL,'smith.d','Smith','Dave',:Password,12,100,0)
");

$stmt->bindParam(":Password", $hashedpassword);

$stmt->execute();

$stmt=$conn->prepare("DROP TABLE IF EXISTS tblstock;
CREATE TABLE tblstock
(ItemID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Name VARCHAR(20) NOT NULL,
Quantity DECIMAL(7,3) NOT NULL,
Price DECIMAL(6,2) NOT NULL,
Category VARCHAR(20) NOT NULL,
Location VARCHAR(4) NOT NULL,
Units VARCHAR(10) NOT NULL,
);
");
$stmt->execute();
echo("tblstock created<br>");

$stmt=$conn->prepare("INSERT INTO tblstock
    (ItemID, Name, Quantity, Price, Category, Location, RA, Units)
    VALUES
    (NULL,'0123','Microscope',15,200.00,'Digital','SP7','RA placeholder','Units' ),
    (NULL,'0145','Hydrochloric acid',2000,150.00,'Chemicals','SP7,'RA placeholder','mL')
    ");
    
    
$stmt->execute();

// $stmt=$conn->prepare("DROP TABLE IF EXISTS tblrequests;
// CREATE TABLE tblrequests
// (RequestID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// UserID INT(4) NOT  NULL,
// RequestDate  DATETIME NOT NULL,
// DeliveryDate DATE NOT NULL,
// ExtraNotes TEXT(1000),
// Technician TEXT(50) NOT NULL,

// );
// ");
// $stmt->execute();
// echo("order table made");

// $stmt=$conn->prepare("DROP TABLE IF EXISTS tblbasket;
// CREATE TABLE tblbasket
// (OrderID INT(4) NOT NULL,
// Quantity  INT(2) DEFAULT 1,
// FoodID INT(4) NOT NULL,
// PRIMARY KEY (OrderID, FoodID)
// );
// ");
// $stmt->execute();
// echo("basket table made");
// ?>