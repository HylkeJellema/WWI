<?php
include_once "init.php";

function ZoekProduct(){
    if (isset($_GET['search'])){
        $vraag = $_GET['search'];
    } else {
        $vraag = "";
    }
    $conn = MaakVerbinding();
    $sql = "SELECT StockItemName, RecommendedRetailPrice, StockItemID, SearchDetails FROM stockitems WHERE SearchDetails LIKE '%" . $vraag . "%' OR StockItemName LIKE '%" . $vraag . "%'";
    $zoekresultaten = mysqli_query($conn, $sql);

    return $zoekresultaten;
}

function ZoekCategorie($vraag){
    $conn = MaakVerbinding();
    //$sql = "SELECT Photo, StockItemName, RecommendedRetailPrice FROM stockitems WHERE StockItemName LIKE '%" . $vraag . "%'";
    $sql= "
SELECT Si.Photo,Si.StockitemName,Si.RecommendedRetailPrice
FROM stockgroups as Sg 
INNER JOIN stockitemstockgroups as Stg on Sg.StockGroupID=Stg.StockGroupID 
INNER JOIN stockitems as Si on Si.StockItemID=Stg.StockItemID
WHERE Sg.StockGroupName ='" . $vraag . "'";

    $zoekresultaten = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($zoekresultaten,MYSQLI_NUM);
    SluitVerbinding($conn);

    return $row;
}

function ResultatenAfrdukken($zoekresultaten){
    while ($row = mysqli_fetch_array($zoekresultaten)) {
        echo "<tr>";
        echo "<td><img src='imgs/ImageComingSoon.png' width='120' height='80'></td>";
        echo "<td>" . $row['StockItemName'] . "</td>";
        echo "<td>" . round(($row['RecommendedRetailPrice'] * 0.91), 2) . "</td>";
        echo "<td><a href='Product.php?id=" . $row['StockItemID'] . "'>Meer details</a>";
        echo "</tr>";
    }
}

function AtotZ(){
    if(isset($_GET["search"]) == true) {
        $vraag = $_GET["search"];
        $conn = MaakVerbinding();
        $sqlAtotZ = "SELECT StockItemName, RecommendedRetailPrice, StockItemID, SearchDetails FROM stockitems WHERE SearchDetails LIKE '%" . $vraag . "%' OR StockItemName LIKE '%" . $vraag . "%' ORDER BY StockItemName ASC";
        $zoekresultaten = mysqli_query($conn, $sqlAtotZ);
        ResultatenAfrdukken($zoekresultaten);
        SluitVerbinding($conn);
    } else {
        $conn = MaakVerbinding();
        $sql = "SELECT StockItemName, RecommendedRetailPrice, StockItemID FROM stockitems ORDER BY StockItemName ASC";
        $zoekresultaten = mysqli_query($conn, $sql);
        ResultatenAfrdukken($zoekresultaten);
        SluitVerbinding($conn);
    }
}

function ZtotA(){
    if(isset($_GET["search"]) == true) {
        $vraag = $_GET["search"];
        $conn = MaakVerbinding();
        $sqlZtotA = "SELECT StockItemName, RecommendedRetailPrice, StockItemID, SearchDetails FROM stockitems WHERE SearchDetails LIKE '%" . $vraag . "%' OR StockItemName LIKE '%" . $vraag . "%' ORDER BY StockItemName DESC";
        $zoekresultaten = mysqli_query($conn, $sqlZtotA);
        ResultatenAfrdukken($zoekresultaten);
        SluitVerbinding($conn);
    } else {
        $conn = MaakVerbinding();
        $sql = "SELECT StockItemName, RecommendedRetailPrice, StockItemID FROM stockitems ORDER BY StockItemName DESC";
        $zoekresultaten = mysqli_query($conn, $sql);
        ResultatenAfrdukken($zoekresultaten);
        SluitVerbinding($conn);
    }
}

function PLtotPH(){
    if(isset($_GET["search"]) == true) {
        $vraag = $_GET["search"];
        $conn = MaakVerbinding();
        $sqlPLtotPH = "SELECT StockItemName, RecommendedRetailPrice, StockItemID, SearchDetails FROM stockitems WHERE SearchDetails LIKE '%" . $vraag . "%' OR StockItemName LIKE '%" . $vraag . "%' ORDER BY RecommendedRetailPrice ASC";
        $zoekresultaten = mysqli_query($conn, $sqlPLtotPH);
        ResultatenAfrdukken($zoekresultaten);
        SluitVerbinding($conn);
    } else {
        $conn = MaakVerbinding();
        $sql = "SELECT StockItemName, RecommendedRetailPrice, StockItemID FROM stockitems ORDER BY RecommendedRetailPrice ASC";
        $zoekresultaten = mysqli_query($conn, $sql);
        ResultatenAfrdukken($zoekresultaten);
        SluitVerbinding($conn);
    }
}

function PHtotPL(){
    if(isset($_GET["search"]) == true) {
        $vraag = $_GET["search"];
        $conn = MaakVerbinding();
        $sqlPHtotPL = "SELECT StockItemName, RecommendedRetailPrice, StockItemID, SearchDetails FROM stockitems WHERE SearchDetails LIKE '%" . $vraag . "%' OR StockItemName LIKE '%" . $vraag . "%' ORDER BY RecommendedRetailPrice DESC";
        $zoekresultaten = mysqli_query($conn, $sqlPHtotPL);
        ResultatenAfrdukken($zoekresultaten);
        SluitVerbinding($conn);
    } else {
        $conn = MaakVerbinding();
        $sql = "SELECT StockItemName, RecommendedRetailPrice, StockItemID FROM stockitems ORDER BY RecommendedRetailPrice DESC";
        $zoekresultaten = mysqli_query($conn, $sql);
        ResultatenAfrdukken($zoekresultaten);
        SluitVerbinding($conn);
    }
}

?>