<?php

function validateEmail($email)
{
    // SET INITIAL RETURN VARIABLES

        $emailIsValid = FALSE;

    // MAKE SURE AN EMPTY STRING WASN'T PASSED

        if (!empty($email))
        {
            // GET EMAIL PARTS

                $domain = ltrim(stristr($email, '@'), '@') . '.';
                $user   = stristr($email, '@', TRUE);

            // VALIDATE EMAIL ADDRESS

                if
                (
                    !empty($user) &&
                    !empty($domain) &&
                    checkdnsrr($domain)
                )
                {$emailIsValid = TRUE;}
        }

    // RETURN RESULT

        return $emailIsValid;
}

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
    $id = mysqli_real_escape_string($connection, $id);
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
    $id = mysqli_real_escape_string($connection, $id);
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

    $stmt = mysqli_prepare($connection, "SELECT user_id, username, password, first_name, last_name, email, plaats, postcode, straatnaam, huisnummer FROM users WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "s", $user_session_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt,$id, $username, $password, $first_name, $last_name, $email, $plaats, $postcode, $straatnaam, $huisnummer);
    while (mysqli_stmt_fetch($stmt)) {
        $session_user_id = $id;
        $username = $username;
        $password = $password;
        $first_name = $first_name;
        $last_name = $last_name;
        $email = $email;
        $plaats = $plaats;
        $postcode = $postcode;
        $straatnaam = $straatnaam;
        $huisnummer = $huisnummer;
    }

    $gegevens = array();
    $gegevens['user_id'] = $session_user_id;
    $gegevens['username'] = $username;
    $gegevens['password'] = $password;
    $gegevens['last_name'] = $last_name;
    $gegevens['first_name'] = $first_name;
    $gegevens['last_name'] = $last_name;
    $gegevens['email'] = $email;
    $gegevens['plaats'] = $plaats;
    $gegevens['postcode'] = $postcode;
    $gegevens['straatnaam'] = $straatnaam;
    $gegevens['huisnummer'] = $huisnummer;

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

function email_exists($connection, $email){
    $statement = mysqli_prepare($connection, "SELECT COUNT(user_id) FROM users WHERE email = ?");
    mysqli_stmt_bind_param($statement, 's', $email);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $emailExist);
    mysqli_stmt_fetch($statement);
    mysqli_stmt_close($statement);
    return $emailExist;
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
    return '<ul style="
    color: #D8000C;
    background-color: #FFBABA;
    border: 1px solid #ff0000;
    border-radius: 2px;
    list-style: none;
    padding: 0.5em;
    margin: 0.5em 0;
    "><li>' . implode('</li><li>', $errors) . '</li></ul>';
}

function register_user($con, $register_data) {
    $username = $register_data['username'];
    $password = $register_data['password'];
    $first_name = $register_data['first_name'];
    $last_name = $register_data['last_name'];
    $email = $register_data['email'];
    $email_code = $register_data['email_code'];
    $plaats = $register_data['plaats'];
    $postcode = $register_data['postcode'];
    $straatnaam = $register_data['straatnaam'];
    $huisnummer = $register_data['huisnummer'];


    $stmt = mysqli_prepare($con, "INSERT INTO users (username, password, first_name, last_name, email, email_code, plaats, postcode, huisnummer) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssssssssss", $username, $password, $first_name, $last_name, $email, $email_code, $plaats, $postcode, $straatnaam, $huisnummer);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    email($register_data['email'], 'Activeer uw account', "Hello " . $register_data['first_name'] . ",\n\nU moet uw account activeren als u wilt bestellen op onze site, dus gebruik de link hieronder:\n\nhttp://localhost/WWI/activate.php?email=" . $register_data['email'] . "&email_code=" . $register_data['email_code'] . "\n\n- WorldWideImporters");
}

function login_check() {
    if(logged_in() == false) {
        header('Location: loginCheck.php');
        exit();
    }
}

function logged_in_redirect() {
    if(!empty($_SESSION['cart']) && (logged_in() == true)) {
        header('Location: Winkelwagen.php');
} elseif(logged_in()== true) {
        header('Location: Homepagina.php');
        exit();
    }
}

function email($to, $subject, $body){
    mail($to, $subject, $body, 'From: wwi@zoho.eu');
}

function check_activate($con, $email, $email_code)
{
    $check = 0;
    $email = mysqli_real_escape_string($con, $email);
    $email_code = mysqli_real_escape_string($con, $email_code);
    $statement = mysqli_prepare($con, "SELECT COUNT(user_id) FROM users WHERE email =? AND email_code =? AND active = 0");
    mysqli_stmt_bind_param($statement, 'ss', $email, $email_code);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $checkActive);
    mysqli_stmt_fetch($statement);
    mysqli_stmt_close($statement);
    if($checkActive == 1) {
        $check = 1;
    } elseif($checkActive == 0) {
        $check = 0;
    }
    return $check;
}

function activate($con, $email, $email_code) {
    $email = mysqli_real_escape_string($con, $email);
    $email_code = mysqli_real_escape_string($con, $email_code);
    $check = check_activate($con, $email, $email_code);

    if ($check == true){
        $email = mysqli_real_escape_string($con, $email);
        $statement = mysqli_prepare($con, "UPDATE users SET active = 1 WHERE email = ?");
        mysqli_stmt_bind_param($statement, 's', $email);
        mysqli_stmt_execute($statement);
        mysqli_stmt_bind_result($statement, $updateActive);
        mysqli_stmt_fetch($statement);
        mysqli_stmt_close($statement);
        return true;
    } else {
        return false;
    }
}

function voorraad_update($con, $id, $aantal) {
    $statement = mysqli_prepare($con, "SELECT QuantityOnHand FROM stockitemholdings WHERE StockItemID = ?");
    mysqli_stmt_bind_param($statement, 'i', $id);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $voorraad);
    mysqli_stmt_fetch($statement);
    mysqli_stmt_close($statement);
    $statement2 = mysqli_prepare($con, "UPDATE stockitemholdings SET QuantityOnHand = (? - ?) WHERE StockItemID = ?");
    mysqli_stmt_bind_param($statement2, 'iii', $voorraad, $aantal, $id);
    mysqli_stmt_execute($statement2);
    mysqli_stmt_close($statement2);
}

?>


