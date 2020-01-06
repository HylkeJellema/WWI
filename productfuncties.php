<?php

function MaakVerbinding(){
    //Verander dit als je offline wilt gaan
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

//standaard email check
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

//sluit verbinding met database
function SluitVerbinding($connection) {
    mysqli_close($connection);
}

function numberOfRecords($result) {
    return mysqli_num_rows($result);
}


//functie om gegevens op te halen die nodig zijn op de productpagina
function ProductOphalen($connection)
{
    $id = $_GET["id"];//haalt het meegegeven id op
    $id = mysqli_real_escape_string($connection, $id);//zorgt ervoor dat het id leesbaar is voor een sql string en haalt speciale tekens uit de GETmysqli
    if (isset($id)) { //checkt of het id is meegegeven
        $statement = mysqli_prepare($connection, "SELECT StockItemID, StockItemName, RecommendedRetailPrice, SearchDetails, IsChillerStock, Photo FROM stockitems WHERE StockItemID = ?"); //Bereid een SQL query voor om productgegevens op te halen
        mysqli_stmt_bind_param($statement, 'i', $id);//Koppelt de variabele $id aan ? in de voorbereide SQL query, dient als parameter
        mysqli_stmt_execute($statement);//Voert de query uit
        mysqli_stmt_bind_result($statement, $StockItemId, $StockItemName, $price, $beschrijving, $koelProduct, $photo);//stopt de terruggegeven informatie in variablen
        mysqli_stmt_fetch($statement);//vangt de resultaten op in de variablen
        $result = array("nummer" => $StockItemId, "naam" => $StockItemName, "price" => $price, "beschrijving" => $beschrijving, "koelProduct" => $koelProduct, "Photo" => $photo);//zet de gegevens in een array
        mysqli_stmt_close($statement);//eindigt het statement
        return $result;//geeft de uiteindelijke gegevens(array) terug
    }
}

//functie die gegevens ophaalt die je zelf in een query kunt aangeven bij het aanroepen van deze functie
function getProduct($connection, $query, $id)// geef connectie, een query, en het desbetreffende product id mee
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

//haalt voorraad gegevens op
function getProductVoorraad($connection, $query, $id) //geef connectie, een query, en het desbetreffende product id mee
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
        $statement = mysqli_prepare($connection, "SELECT QuantityOnHand FROM stockitemholdings WHERE StockItemID = ?");//query die voorraad aantal ophaalt vanuit de database
        mysqli_stmt_bind_param($statement, 'i', $id);
        mysqli_stmt_execute($statement);
        mysqli_stmt_bind_result($statement, $StockItemHoldings);
        mysqli_stmt_fetch($statement);
        $result = array("voorraad" => $StockItemHoldings);
        mysqli_stmt_close($statement);
        return $result;
    }
}

//haalt gegevens op van user uit database
function user_data($connection, $user_session_id) { // geef connectie en het id van de ingelogde user mee

    $stmt = mysqli_prepare($connection, "SELECT user_id, username, password, first_name, last_name, email, plaats, postcode, straatnaam, huisnummer FROM users WHERE user_id = ?"); //query die alle gegevens van een gebruiker ophaalt vanuit de database
    mysqli_stmt_bind_param($stmt, "s", $user_session_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt,$id, $username, $password, $first_name, $last_name, $email, $plaats, $postcode, $straatnaam, $huisnummer);
    while (mysqli_stmt_fetch($stmt)) { //zet opgehaalde resultaten in volgende variabelen
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

    $gegevens = array(); //zet de opgehaalde gegevens in een array
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

    mysqli_stmt_free_result($stmt); //resultaat opschonen
    mysqli_stmt_close($stmt); //statement opruimen

    return $gegevens;
}

//kijkt of een gebruiker bestaat in de database
function user_exists($connection, $username){ //geef connectie en username mee
    $statement = mysqli_prepare($connection, "SELECT COUNT(user_id) FROM users WHERE username = ?");//query die kijkt of er username bestaat in de database door user_id te tellen met desbetreffende naam, 0=nee, 1=ja
    mysqli_stmt_bind_param($statement, 's', $username);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $userExist);
    mysqli_stmt_fetch($statement);
    mysqli_stmt_close($statement);
    return $userExist;
}

//checkt of een email al bestaat in de database
function email_exists($connection, $email){ //geef connectie en email mee
    $statement = mysqli_prepare($connection, "SELECT COUNT(user_id) FROM users WHERE email = ?");//query die kijkt of email bestaat in de database door user_id te tellen met desbetreffende naam, 0=nee, 1=ja
    mysqli_stmt_bind_param($statement, 's', $email);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $emailExist);
    mysqli_stmt_fetch($statement);
    mysqli_stmt_close($statement);
    return $emailExist;
}

//checkt of gebruiker zijn account al heeft geactiveerd
function user_active($connection, $username){//geef connectie en ingelogde username mee
    $statement = mysqli_prepare($connection, "SELECT COUNT(user_id) FROM users WHERE username = ? AND active = 1"); //query die user_id telt, waar de username gelijk is aan de ingelogde username en of active op 1 staat
    mysqli_stmt_bind_param($statement, 's', $username);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $userActive);
    mysqli_stmt_fetch($statement);
    mysqli_stmt_close($statement);
    return $userActive;
}

//haalt user id op aan de hand van de username
function user_id_from_username($connection, $username) { //geef connectie en ingelogde username mee
    $statement = mysqli_prepare($connection, "SELECT user_id FROM users WHERE username = ?"); //query die user id ophaald waar de username gelijk is aan de ingelogde username
    mysqli_stmt_bind_param($statement, 's', $username);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $userID);
    mysqli_stmt_fetch($statement);
    mysqli_stmt_close($statement);
    return $userID;
}

//functie die ervoor zorgt dat een user kan inloggen
function login($connection, $username, $password) { // geef connectie, username en wachtwoord mee
    $check = 0;
    $con = MaakVerbinding();
    $user_id = user_id_from_username($con, $username); //haal id op van username
    $password = md5($password); //hasht meegegeven wachtwoord, zodat deze overeen komt met de wachtwoord informatie in de database
    $statement = mysqli_prepare($connection, "SELECT COUNT(user_id) FROM users WHERE username =? AND password =? "); //query die user id telt waar de inloggegevens het zelfde zijn als die zijn ingevuld.
    mysqli_stmt_bind_param($statement,'ss', $username,$password);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $userExist);
    mysqli_stmt_fetch($statement);
    mysqli_stmt_close($statement);
    if ($userExist == 1){
        $check = $user_id; //als de gebruiker bestaat geeft hij true mee terug
    } elseif ($userExist == 0) {
        $check = 0; // als de gebruiker niet bestaat geeft hij false terug
    }
    return $check;
}

//kijkt of gebruiker is ingelogd
function logged_in() {
    if (isset($_SESSION['user_id'])){ //checkt of de gebruikers sessie geset is
        return true;
    } else {
        return false;
    }
}

//geeft errors weer
function output_errors($errors) {
    return '<ul style="
    color: #D8000C;
    background-color: #FFBABA;
    border: 1px solid #ff0000;
    border-radius: 2px;
    list-style: none;
    padding: 0.5em;
    margin: 0.5em 0;
    "><li>' . implode('</li><li>', $errors) . '</li></ul>'; //zorgt ervoor dat alle errors netjes worden getoond
}

//registreerd gebruiker en zet gegevens in database
function register_user($con, $register_data) { //geef connectie en registratie gegevens mee
    //zet gegevens in variabelen
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


    $stmt = mysqli_prepare($con, "INSERT INTO users (username, password, first_name, last_name, email, email_code, plaats, postcode, straatnaam, huisnummer) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssssssssss", $username, $password, $first_name, $last_name, $email, $email_code, $plaats, $postcode, $straatnaam, $huisnummer);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    email($register_data['email'], 'Activeer uw account', "Hello " . $register_data['first_name'] . ",\n\nU moet uw account activeren als u wilt bestellen op onze site, dus gebruik de link hieronder:\n\nhttp://localhost/WWI/activate.php?email=" . $register_data['email'] . "&email_code=" . $register_data['email_code'] . "\n\n- WorldWideImporters"); //stuurt activatie mail
}

//checkt of iemand ingelogd is
function login_check() {
    if(logged_in() == false) {
        header('Location: loginCheck.php'); //stuurt niet ingelogde gebruikers naar loginCheck
        exit();
    }
}

//redirect ingelogde gebruikers
function logged_in_redirect() {
    if(!empty($_SESSION['cart']) && (logged_in() == true)) { //checkt of winkelwagen niet leeg is en of gebruiker is ingelogd
        header('Location: Winkelwagen.php'); //stuurt gebruiker naar winkelwagen
} elseif(logged_in()== true) { //checkt of gebruiker is ingelogd
        header('Location: Homepagina.php'); //stuurt gebruiker naar homepagina
        exit();
    }
}

function email($to, $subject, $body){ //geef geadresseerde, onderwerp en inhoud van de email mee
    mail($to, $subject, $body, 'From: wilslooten@gmail.com'); //stuurt mail
}

//checkt of gebruiker actief is
function check_activate($con, $email, $email_code) //geef connectie, email en email code mee
{
    $check = 0;
    $email = mysqli_real_escape_string($con, $email);
    $email_code = mysqli_real_escape_string($con, $email_code);
    $statement = mysqli_prepare($con, "SELECT COUNT(user_id) FROM users WHERE email =? AND email_code =? AND active = 0");//query die user id telt waar email gelijk is aan meegegeven email en waar de email code gelijk is aan meegegeven email code en of het account geactiveerd is
    mysqli_stmt_bind_param($statement, 'ss', $email, $email_code);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $checkActive);
    mysqli_stmt_fetch($statement);
    mysqli_stmt_close($statement);
    if($checkActive == 1) {
        $check = 1; //geeft true terug als gebruiker bestaat
    } elseif($checkActive == 0) {
        $check = 0; //geeft false terug als gebruiker niet bestaat
    }
    return $check;
}

//activeert account
function activate($con, $email, $email_code) { //geef connectie email en email code mee
    $email = mysqli_real_escape_string($con, $email);
    $email_code = mysqli_real_escape_string($con, $email_code);
    $check = check_activate($con, $email, $email_code);

    if ($check == true){ //kijkt of de check true is van check_activate
        $email = mysqli_real_escape_string($con, $email);
        $statement = mysqli_prepare($con, "UPDATE users SET active = 1 WHERE email = ?");//query die active op true zet waar de email gelijk is aan de meegegeven email
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

function voorraad_update($con, $id, $aantal) { //geef connectie, id en aantal mee
    $statement = mysqli_prepare($con, "SELECT QuantityOnHand FROM stockitemholdings WHERE StockItemID = ?"); //query die voorraad ophaalt waar het item id gelijk is aan het meegegeven id
    mysqli_stmt_bind_param($statement, 'i', $id);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $voorraad);
    mysqli_stmt_fetch($statement);
    mysqli_stmt_close($statement);
    $statement2 = mysqli_prepare($con, "UPDATE stockitemholdings SET QuantityOnHand = (? - ?) WHERE StockItemID = ?"); //update de voorraad aan de hand van het meegegeven aantal, waar het item id gelijk is aan het meegegeven id
    mysqli_stmt_bind_param($statement2, 'iii', $voorraad, $aantal, $id);
    mysqli_stmt_execute($statement2);
    mysqli_stmt_close($statement2);
}

?>


