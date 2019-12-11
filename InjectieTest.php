<html>
<body>

<form method="get" action="InjectieTest.php">
    <input type="text" name="Zoekopdracht">
    <input type="submit" value="Verzend" name="Verzend">
</form>

<?php
    //include_once 'productfuncties.php';
    $waarde="";
    if (isset($_GET["Verzend"])) {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "wideworldimporters";

// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $waarde=$_GET["Zoekopdracht"];
        $sql = "SELECT Stockgroupname, ValidFrom, ValidTo FROM stockgroups WHERE Stockgroupname LIKE '%$waarde%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            ?><ul><?php
            while($row = $result->fetch_assoc()) {
                ?><li><?php
                echo "id: " . $row["Stockgroupname"]. " - Name: " . $row["ValidFrom"]. " " . $row["ValidTo"]. "<br>";
                ?></li><?php
            }
            ?></ul><?php
        } else {
            echo "0 results";
        }
        $conn->close();

        ?>

        <br>

        <?php
    }
?>


</body>
</html>