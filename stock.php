<!DOCTYPE HTML>
<html>
<head>          
    <title>PHP Info</title>
</head>

<body>
    <form action="addstock.php" method="POST">
        Name:<input type="text" name="name"><br>
        Price:<input type="float" name="price"><br>
        Quantity:<input type="float" name="quantity"><br>
        Units:<input type="text" name="units"><br>
        <p>CATEGORY</p>        
        <input type="radio" name="category" value="chemicals" > Chemicals<br>
        <input type="radio" name="category" value="equipment" checked> Equipment<br>
        <input type="radio" name="category" value="glassware" > Glassware<br>
        <p>LOCATION</p>        
        <input type="radio" name="location" value="SP1" > SP1<br>
        <input type="radio" name="location" value="SB3" > SB3<br>
        <input type="radio" name="location" value="SC2" > SC2<br>
        <input type="submit" value="Add stock">
    </form>
    <?php
        include_once("connection.php");
        $stmt=$conn->prepare("SELECT * FROM tblstock");
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            //print_r($row);
            echo($row["name"]." ".$row["units"]." ".$row["quantity"]);
            echo("<br>");
        }
    ?>

</body>
</html>
