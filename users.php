<!DOCTYPE HTML>
<html>
<head>          
    <title>PHP Info</title>
</head>

<body>
    <form action="addusers.php" method="POST">
        Surname:<input type="text" name="surname"><br>
        Forename:<input type="text" name="forename"><br>
        Password:<input type="password" name="password"><br>
        EmailAddress:<input type="text" name="emailaddress"><br>
        <input type="radio" name="role" value="teacher" checked> Teacher<br>
        <input type="radio" name="role" value="technician" > Technician<br>
        <input type="submit" value="Add User">
    </form>
    <?php
        include_once("connection.php");
        $stmt=$conn->prepare("SELECT * FROM tblusers");
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            //print_r($row);
            echo($row["Forename"]." ".$row["Surname"]);
            echo("<br>");
        }
    ?>

</body>
</html>