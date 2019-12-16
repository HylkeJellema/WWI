<?php
include_once 'header.php';
if (logged_in() == true) {
    $session_user_id = $_SESSION['user_id'];
    $user_data = user_data($con, $session_user_id);

    email($user_data['email'], 'Bestelling succesvol', "Hello " . $_POST['first_name'] . ",\n\nHieronder ziet u uw bestelling:\n\n- WorldWideImporters");
}

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