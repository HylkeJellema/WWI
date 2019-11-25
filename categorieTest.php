<?php
function categorieLijst(){

include "productfuncties.php";


$host = "localhost";
$databasename = "wideworldimporters";
$user = "root";
$pass = ""; //eigen password invullen
$port = 3306;
$connection = mysqli_connect($host, $user, $pass, $databasename, $port);


$sql = "SELECT StockGroupName FROM stockgroups";
//$result = mysqli_query($connection, $sql);
$result = mysqli_query($connection, $sql)
or die("Error: " . mysqli_error($connection));

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $naam = $row["StockGroupName"];
    //print($naam . "<br>");
    print("<li><a href ='#'>" . $naam . "</a></li>");
}


SluitVerbinding($connection);

}

categorieLijst();