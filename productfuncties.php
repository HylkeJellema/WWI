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
        $statement = mysqli_prepare($connection, "SELECT StockItemID, StockItemName, RecommendedRetailPrice, SearchDetails FROM stockitems WHERE StockItemID = ?");
        mysqli_stmt_bind_param($statement, 'i', $id);
        mysqli_stmt_execute($statement);
        mysqli_stmt_bind_result($statement, $StockItemId, $StockItemName, $price, $beschrijving);
        mysqli_stmt_fetch($statement);
        $result = array("nummer" => $StockItemId, "naam" => $StockItemName, "price" => $price, "beschrijving" => $beschrijving);
        mysqli_stmt_close($statement);
        return $result;
    }
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

