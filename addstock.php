<?php
print_r($_POST);
include_once("connection.php");//import equivalent!

//$role=1;
// $userID=$_POST["password"];
//echo($username);
//$username="bob";
// echo($hashedpassword);
try{
    $stmt=$conn->prepare("INSERT INTO tblstock
    (Name,Quantity,Price,Category,Location,Units)
    VALUES
    (:Name,:Quantity,:Price,:Category,:Location,:Units)
    ");
    $stmt->bindParam(":Name", $_POST["name"]);
    $stmt->bindParam(":Quantity", $_POST["quantity"]);
    $stmt->bindParam(":Price", $_POST["price"]);
    $stmt->bindParam(":Category", $_POST["category"]);
    $stmt->bindParam(":Location", $_POST["location"]);
    $stmt->bindParam(":Units", $_POST["units"]);
    $stmt->execute();
    header("location: stock.php");
}
// echo($hashedpassword);
catch(PDOException $e)
{
    echo("error: " . $e->getMessage());
}

?>
<a href="index.php">back to main page</a><br>
