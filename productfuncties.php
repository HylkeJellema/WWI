<?php
function MaakVerbinding()
{
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $databasename = 'wideworldimporters';
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

function ProductOphalen($connection)
{
    $id = $_GET["id"];
    if (isset($id)) {
        $statement = mysqli_prepare($connection, "SELECT StockItemID, StockItemName, RecommendedRetailPrice FROM stockitems WHERE StockItemID = ?");
        mysqli_stmt_bind_param($statement, 'i', $id);
        mysqli_stmt_execute($statement);
        mysqli_stmt_bind_result($statement, $StockItemId, $StockItemName, $price);
        mysqli_stmt_fetch($statement);
        $result = array("nummer" => $StockItemId, "naam" => $StockItemName, "price" => $price);
        mysqli_stmt_close($statement);
        return $result;
    }
}

function ZoekProduct($vraag){
    $connection = MaakVerbinding();
    $sql = "SELECT Photo, StockItemName, RecommendedRetailPrice FROM stockitems WHERE StockItemName LIKE '%($vraag)%'";
    $zoekresultaten = mysqli_query($connection, $sql);
    $row = mssql_fetch_array($zoekresultaten,MYSQLI_NUM);
    SluitVerbinding($connection);

    return $row;
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

