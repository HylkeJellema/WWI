<?php
function MaakVerbinding()
{
    $host = 'hyl.ke';
    $user = 'u11725p60100_WWI';
    $pass = 'database';
    $databasename = 'u11725p60100_WWI';
    $connection = mysqli_connect($host, $user, $pass, $databasename);
    if (!$connection) die("Unable to connect to MySQL: " . mysqli_error($connection));
    return $connection;
}

function SluitVerbinding($connection) {
    mysqli_close($connection);
}

function numberOfRecords($result) {
    return mysqli_num_rows($result);
}


//functie om gegevens op te halen die nodig zijn op de productpagina
function ProductOphalen($connection)
{
    $id = $_GET["id"];
    if (isset($id)) {
        $statement = mysqli_prepare($connection, "SELECT StockItemID, StockItemName, RecommendedRetailPrice, SearchDetails, IsChillerStock FROM stockitems WHERE StockItemID = ?");
        mysqli_stmt_bind_param($statement, 'i', $id);
        mysqli_stmt_execute($statement);
        mysqli_stmt_bind_result($statement, $StockItemId, $StockItemName, $price, $beschrijving, $koelProduct);
        mysqli_stmt_fetch($statement);
        $result = array("nummer" => $StockItemId, "naam" => $StockItemName, "price" => $price, "beschrijving" => $beschrijving, "koelProduct" => $koelProduct);
        mysqli_stmt_close($statement);
        return $result;
    }
}

//functie die gegevens ophaalt die je zelf in een query kunt aangeven bij het aanroepen van deze functie
function getProduct($connection, $query, $id)
{
        $statement = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($statement, 'i', $id);
        mysqli_stmt_execute($statement);
        mysqli_stmt_bind_result($statement, $StockItemId, $StockItemName, $price, $voorraad);
        mysqli_stmt_fetch($statement);
        $result = array("id" => $StockItemId, "productNaam" => $StockItemName, "productPrijs" => $price, "productVoorraad" => $voorraad);
        mysqli_stmt_close($statement);
        return $result;

}

//haalt voorraad op
function getProductVoorraad($connection, $query, $id)
{
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($statement, 'i', $id);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $voorraad);
    mysqli_stmt_fetch($statement);
    $result = array("voorraad" => $voorraad);
    mysqli_stmt_close($statement);
    return $result;

}

function VoorraadOphalen($connection)
{
    $id = $_GET["id"];
    if (isset($id)) {
        $statement = mysqli_prepare($connection, "SELECT QuantityOnHand FROM stockitemholdings WHERE StockItemID = ?");
        mysqli_stmt_bind_param($statement, 'i', $id);
        mysqli_stmt_execute($statement);
        mysqli_stmt_bind_result($statement, $StockItemHoldings);
        mysqli_stmt_fetch($statement);
        $result = array("voorraad" => $StockItemHoldings);
        mysqli_stmt_close($statement);
        return $result;
    }
}


?>


