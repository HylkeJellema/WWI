<html>
<body>

<form method="get" action="InjectieTest.php">
    <input type="text" name="Zoekopdracht">
    <input type="submit" value="Zoeken" name="Verzend">
</form>

<?php
    $waarde="";
    if (isset($_GET["Verzend"])) {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "wideworldimporters";

// Maak verbinding met de database.
        $conn = new mysqli($servername, $username, $password, $dbname);

// Controleer of er verbinding is gemaakt.
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

// Haal de zoekopdracht op.
        $waarde=$_GET["Zoekopdracht"];

// Haal de karakters uit de code die een SQL-injectie kunnen veroorzaken.
        $waarde = mysqli_real_escape_string($conn, $waarde);

// Zoek op de zoekopdracht.
        $sql = "SELECT Stockgroupname, ValidFrom, ValidTo FROM stockgroups WHERE Stockgroupname LIKE '%$waarde%'";

// Sla het resultaat op in waarde $result.
        $result = $conn->query($sql);

// Druk de resultaten af.
        if ($result->num_rows > 0) {
            // output data of each row
            ?><ul><?php
            while($row = $result->fetch_assoc()) {
                ?><li><?php
                echo /*"id: " .*/ $row["Stockgroupname"]/*. " - Name: "*/ . $row["ValidFrom"]. /*" " .*/ $row["ValidTo"]. "<br>";
                ?></li><?php
            }
            ?></ul><?php
        } else {
            echo "0 results";
        }

// Sluit verbinding met de database.
        $conn->close();

        ?>

        <br>

        <?php
    }
?>


</body>
</html>