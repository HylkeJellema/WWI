<?php
function MaakVerbinding(){
    //Verander dit als je offline wilt prutsen
    $offline = true;

    if($offline){
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $databasename = 'wideworldimporters';
        $connection = mysqli_connect($host, $user, $pass, $databasename);
        if (!$connection) die("Unable to connect to MySQL: " . mysqli_error($connection));
        return $connection;
    } else{
        $host = 'hyl.ke';
        $user = 'u11725p60100_WWI';
        $pass = 'database';
        $databasename = 'u11725p60100_WWI';
        $connection = mysqli_connect($host, $user, $pass, $databasename);
        if (!$connection) die("Unable to connect to MySQL: " . mysqli_error($connection));
        return $connection;
    }
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
        $statement = mysqli_prepare($connection, "SELECT StockItemID, StockItemName, RecommendedRetailPrice, SearchDetails, IsChillerStock, Photo FROM stockitems WHERE StockItemID = ?");
        mysqli_stmt_bind_param($statement, 'i', $id);
        mysqli_stmt_execute($statement);
        mysqli_stmt_bind_result($statement, $StockItemId, $StockItemName, $price, $beschrijving, $koelProduct, $photo);
        mysqli_stmt_fetch($statement);
        $result = array("nummer" => $StockItemId, "naam" => $StockItemName, "price" => $price, "beschrijving" => $beschrijving, "koelProduct" => $koelProduct, "Photo" => $photo);
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

function getUsername($connection, $query, $username){
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($statement, 's', $username);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $username);
    mysqli_stmt_fetch($statement);
    $result = array("userexists" => $username);
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

function user_data($connection, $user_session_id) {

    $stmt = mysqli_prepare($connection, "SELECT user_id, username, password, first_name, last_name, email FROM users WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "s", $user_session_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt,$id, $username, $password, $first_name, $last_name, $email);
    while (mysqli_stmt_fetch($stmt)) {
        $session_user_id = $id;
        $username = $username;
        $password = $password;
        $first_name = $first_name;
        $last_name = $last_name;
        $email = $email;
    }

    $gegevens = array();
    $gegevens['user_id'] = $session_user_id;
    $gegevens['username'] = $username;
    $gegevens['password'] = $password;
    $gegevens['last_name'] = $last_name;
    $gegevens['first_name'] = $first_name;
    $gegevens['last_name'] = $last_name;
    $gegevens['email'] = $email;

    mysqli_stmt_free_result($stmt); // resultset opschonen
    mysqli_stmt_close($stmt); // statement opruimen

    return $gegevens;
}

function user_exists($connection, $username){
    $statement = mysqli_prepare($connection, "SELECT COUNT(user_id) FROM users WHERE username = ?");
    mysqli_stmt_bind_param($statement, 's', $username);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $userExist);
    mysqli_stmt_fetch($statement);
    mysqli_stmt_close($statement);
    return $userExist;
}

function user_active($connection, $username){
    $statement = mysqli_prepare($connection, "SELECT COUNT(user_id) FROM users WHERE username = ? AND active = 1");
    mysqli_stmt_bind_param($statement, 's', $username);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $userActive);
    mysqli_stmt_fetch($statement);
    mysqli_stmt_close($statement);
    return $userActive;
}

function user_id_from_username($connection, $username) {
    $statement = mysqli_prepare($connection, "SELECT user_id FROM users WHERE username = ?");
    mysqli_stmt_bind_param($statement, 's', $username);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $userID);
    mysqli_stmt_fetch($statement);
    mysqli_stmt_close($statement);
    return $userID;
}

function login($connection, $username, $password) {
    $check = 0;
    $con = MaakVerbinding();
    $user_id = user_id_from_username($con, $username);
    $password = md5($password);
    $statement = mysqli_prepare($connection, "SELECT COUNT(user_id) FROM users WHERE username =? AND password =? ");
    mysqli_stmt_bind_param($statement,'ss', $username,$password);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $userExist);
    mysqli_stmt_fetch($statement);
    mysqli_stmt_close($statement);
    if ($userExist == 1){
        $check = $user_id;
    } elseif ($userExist == 0) {
        $check = 0;
    }
    return $check;
}

function logged_in() {
    if (isset($_SESSION['user_id'])){
        return true;
    } else {
        return false;
    }
}

function output_errors($errors) {

    return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
}


?>


