<?php
session_start();// start sessie

include ("productfuncties.php"); //betrekt productfuncties
$con = MaakVerbinding();

if (logged_in() == true) { //checkt of er ingelogd is
        $session_user_id = $_SESSION['user_id']; //zet de gebruikers sessie in een variabele
        $user_data = user_data($con, $session_user_id);  //zet de gebruikers gegevens in een variabele
        $con = MaakVerbinding();
        if (user_active($con, ($user_data['username'])) == false) { //kijkt of user actief is en stopt de sessie als hij dat niet is
            session_destroy();
            header('Homepagina.php');
            exit();
        }
}



$errors = array(); //zet de errors in een array
