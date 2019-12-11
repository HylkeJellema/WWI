<?php
session_start();

include ("productfuncties.php");
$con = MaakVerbinding();

<<<<<<< HEAD
if (logged_in() == true) {
    $session_user_id = $_SESSION['user_id'];
    $user_data = user_data($con, $session_user_id);
    $con = MaakVerbinding();
    if (user_active($con,($user_data['username'])) == false) {
        session_destroy();
        header('Homepagina.php');
        exit();
    }
=======
if(logged_in() == true) {
    $session_user_id = $_SESSION['user_id'];
    $user_data = user_data($con, $session_user_id);
>>>>>>> productpagina
}

$errors = array();
