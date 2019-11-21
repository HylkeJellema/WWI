<?php
include "productfuncties.php";

function ZoekProduct($vraag){
    $conn = MaakVerbinding();
    $sql = "SELECT Photo, StockItemName, RecommendedRetailPrice FROM stockitems WHERE StockItemName LIKE '%" . $vraag . "%'";
    $zoekresultaten = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($zoekresultaten,MYSQLI_NUM);
    SluitVerbinding($conn);

    return $row;
}

?>