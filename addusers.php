<?php
header("location: users.php");
//print_r($_POST);
include_once("connection.php");//import equivalent!
if($_POST["role"]=="technician"){
    $role=1;
#else if not elif
}else{
    $role=0;
}
//$role=1;
//test
$userID=$_POST[]
//echo($username);
//$username="bob";
$hashedpassword=password_hash($_POST["password"],PASSWORD_DEFAULT);
echo($hashedpassword);
try{
    $stmt=$conn->prepare("INSERT INTO tblusers 
    (UserID,EmailAddress,Surname,Forename,Password,Technician)
    VALUES
    (NULL,:UserID,:EmailAddress,:Surname,:Forename,:Password)
    ");
    $stmt->bindParam(":Surname", $_POST["surname"]);
    $stmt->bindParam(":Forename", $_POST["forename"]);
    $stmt->bindParam(":Password", $hashedpassword);
    $stmt->bindParam(":EmailAddress", $_POST["emailaddress"]);
    $stmt->bindParam(":Role", $role);
    $stmt->execute();
}
catch(PDOException $e)
{
    echo("error: " . $e->getMessage());
}

?>
<a href="index.php">back to main page</a><br>
