<?php
session_start();
if (isset($_POST["user"] && $_POST == "hylke")){
    if (isset($_POST["pass"] && $_POST == "123")){
        $_SESSION["ingelogd"]=true;
        $_SESSION["user"] = $_POST["user"];
        $_SESSION["pass"] = $_POST["pass"];
    } else {print ("Verkeerde gegevens")}
} else {print ("Verkeerde gegevens")}