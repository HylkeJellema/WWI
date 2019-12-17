<?php
include_once 'header.php';

if (logged_in() == true && !(empty($_SESSION['cart']))) {
    $session_user_id = $_SESSION['user_id'];
    $user_data = user_data($con, $session_user_id);
    $data = "";
    $totalprice = 0;
    foreach ($_SESSION['cart'] as $arr){
        $data .= "Naam: ".$arr['name'];
        $data .= "\n";
        $data .= "Aantal: ". $arr['aantal'];
        $data .= "\n";
        $data .= "Prijs: €".$arr['price'];
        $data .= "\n";
        $totalprice = $totalprice + ($arr['price'] * $arr['aantal']);
    }
    email($user_data['email'], 'Bestelling succesvol', "Hello " . $user_data['first_name'] . ",\n\nHieronder ziet u uw bestelling:\n\n" . $data . "\n\n Totaal: €".$totalprice . "\n\n Aflever adres: \n".$user_data['plaats']. "\n".$user_data['postcode']."\n".$user_data['straatnaam']. " ".$user_data['huisnummer']."\n\n- WorldWideImporters");
} else {
    header("Location: Homepagina.php");
}
unset($_SESSION['cart']);
?>
<html>
<head></head>

<body>
<div class="container">
    <div class="card" style="padding-left: 20px; margin-top: 10px">
        <br>
        <h1>Succes!</h1><br>
        <div class="row">
            <div class="inner">
                <div class="col-md-5" style="width:100rem">
                    Je betaling is gelukt, er is een bevestigingsmail gestuurd.
                </div><br>
                <a class="btn btn-lg btn-outline-primary" href="Homepagina.php" style="margin-left: 20px">Verder winkelen</a>
            </div>
        </div><br>
    </div>
</div>
</body>


</html>