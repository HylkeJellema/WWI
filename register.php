<?php
//include 'init.php';
include_once 'header.php';

if (empty($_POST) == false) { //kijkt of er op de registreer knop is geklikt
    $required_fields = array('username', 'password', 'password_again', 'first_name', 'email', 'plaats', 'postcode', 'huisnummer');
    foreach($_POST as $key => $value){
        if(empty($value) && in_array($key, $required_fields) == true){ //kijkt of aangegeven velden zijn ingevuld
            $errors[] = 'Velden die gemarkeerd zijn met een sterretje zijn verplicht.';
            break 1;
        }
    }

    if (empty($errors) == true){
        if(user_exists($con, $_POST['username']) == true){ //kijkt of username bestaat
            $errors[] = 'Sorry, de gebruikersnaam \'' . $_POST['username'] . '\' is al in gebruik.';
        }
        if(preg_match("/\\s/", $_POST['username']) == true){ //kijkt of er spaties in de username zitten
            $errors[] = 'Uw gebruikersnaam mag geen spaties bevatten.';
        }
        if(strlen($_POST['password']) < 9){ //kijkt of het wachtwoord minimaal 8 karakters lang is
            $errors[] = 'Uw wachtwoord moet minstens 8 karakters lang zijn.';
        }
        if($_POST['password'] !== $_POST['password_again']){ //kijkt of de 2 opgegeven wachtwoorden overeen komen
            $errors[] = 'Uw wachtwoorden komen niet overeen.';
        }
        if(validateEmail($_POST['email']) == false) { //kijkt of de email wel bestaat
            $errors[] = 'Een geldige email is vereist.';
        }
        if(email_exists($con, $_POST['email']) == true) { //kijkt of de email al bestaat
            $errors[] = 'Sorry, de email \'' . $_POST['email'] . '\' is al in gebruik.';
        }
        if(preg_match("/\\s/", $_POST['postcode']) == true) { //kijkt of de postcode spaties bevat
            $errors[] = 'Uw postcode mag geen spaties bevatten.';
        }
        if (preg_match("/^[0-9#+]+$/", $_POST['straatnaam']) == true){ //kijkt of de woonplaats speciale tekens bevat
            $errors[] = "Uw woonplaats mag geen speciale tekens bevatten.";
        }
    }
}



?>
<html>
<head></head>
    </head>
    <body>
    <div class="container">
        <div class="card" style="padding-left: 40px; margin-top: 10px">
            <h1>Register</h1>
            <?php
            if (isset($_GET['succes']) && empty($_GET['succes'])) { //kijkt of het registreren succesvol is gelukt
               echo 'You\'ve been registered succesfully! Please check your email to activate your account.';
               ?>
            <div>
                <br>
                <a class='btn btn-lg btn-light align-center' style="background: lightskyblue; margin-bottom: 10px" href="login.php">Inloggen</a>
            </div>

            <?php
            } else {
            if (empty($_POST) == false && empty($errors) == true) { //kijkt of er geen errors zijn
                $register_data = array( //maakt array met gebruiker gegevens
                    'username' => $_POST['username'],
                    'password' => md5($_POST['password']),
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'email' => $_POST['email'],
                    'email_code' => md5(($_POST['username'] + microtime())),
                    'plaats' => $_POST['plaats'],
                    'postcode' => $_POST['postcode'],
                    'straatnaam' => $_POST['straatnaam'],
                    'huisnummer' => $_POST['huisnummer']
                );

                register_user($con, $register_data); //registreert gebruiker en zet informatie in database
                header('Location: register.php?succes');
                exit();

            } elseif (empty($errors) == false) { //kijkt of errors niet leeg is
                echo output_errors($errors);
            }

            ?>
            <div class="row">
                <div class="inner">
                    <form action="" method="post">
                        <ul style="list-style: none">
                            <li>
                                Username*:<br>
                                <input class="form-control" type="text" name="username">
                            </li>
                            <li>
                                Password*:<br>
                                <input class="form-control" type="password" name="password">
                            </li>

                            <li>
                                Password again*:<br>
                                <input class="form-control" type="password" name="password_again">
                            </li>
                            <li>
                                First name*:<br>
                                <input class="form-control" type="text" name="first_name">
                            </li>
                            <li>
                                Last name:<br>
                                <input class="form-control" type="text" name="last_name">
                            </li>
                            <li>
                                Email*:<br>
                                <input class="form-control" type="text" name="email">
                            </li>
                            <li>
                                Plaats*:<br>
                                <input class="form-control" type="text" name="plaats">
                            </li>
                            <li>
                                Postcode*:<br>
                                <input class="form-control" type="text" name="postcode">
                            </li>
                            <li>
                                Straatnaam*:<br>
                                <input class="form-control" type="text" name="straatnaam">
                            </li>
                            <li>
                                Huisnummer en toevoeging*:<br>
                                <input class="form-control" type="text" name="huisnummer">
                            </li>
                            <br>
                            <li>
                                <input class="btn btn-success" type="submit" value="Register">
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
    <?php
    }
    ?>
</html>