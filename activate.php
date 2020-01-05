<?php
include 'header.php'; //betrekt header.php
logged_in_redirect(); //redirect gebruiker als hij ingelogd is
?>
<html>
    <head></head>
    <body>
        <?php

        if(isset($_GET['succes']) == true && empty($_GET['succes']) == true){ //kijkt of de gebruiker succesvol is geactiveerd
            ?>
            <div class="container">
                <div class="card" style="padding-left: 20px; margin-top: 10px">
                    <br>
                    <h1>Bedankt, we hebben uw account geactiveerd...</h1><br>
                    <div class="row">
                        <div class="inner">
                            <div class="col-md-5" style="width:50rem">
                                Voelt u vrij om in te loggen!
                            </div><br>
                            <a class="btn btn-lg btn-outline-primary" href="login.php" style="margin-left: 20px">Naar inloggen</a>
                        </div>
                    </div><br>
                </div>
            </div>
            <?php
        } elseif (isset($_GET['email'], $_GET['email_code']) == true) { //kijkt of de email en de email code bestaan

            $email      = trim($_GET['email']);
            $email_code = trim($_GET['email_code']);

            if (email_exists($con, $email) == false) { //checkt of email bestaat
                $errors[] = 'Oops, er is iets fout gegaan en we konden het email adres niet vinden';
            } elseif(activate($con, $email, $email_code) == false) { //kijkt of email op actief is gezet
                $errors[] = 'Er zijn problemen opgetreden die ervoor zorgen dat uw account niet geactiveerd kan worden.';
            }

            if (empty($errors) == false){
                ?>
                    <h2>Oops...</h2>
                <?php
                echo output_errors($errors);
            } else {
                header('Location: activate.php?succes');
                exit();
            }

        } else {
            header('Location: Homepagina.php');
            exit();
        }
        ?>
    </body>
</html>
