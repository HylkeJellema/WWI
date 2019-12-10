<?php
session_start();
include ("productfuncties.php");
$con = MaakVerbinding();

if(logged_in() == true) {
    $session_user_id = $_SESSION['user_id'];
    $user_data = user_data($con, $session_user_id);
}

$errors = array();
?>