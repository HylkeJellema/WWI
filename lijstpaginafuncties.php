<?php
include "productfuncties.php";

function ZoekProduct($vraag){
    $connection = MaakVerbinding();
    $sql = "SELECT Photo, StockItemName, RecommendedRetailPrice FROM stockitems WHERE StockItemName LIKE '%" . $vraag . "%'";
    $zoekresultaten = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($zoekresultaten,MYSQLI_NUM);
    SluitVerbinding($connection);

    return $row;
}

?>