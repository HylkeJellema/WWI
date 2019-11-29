
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="stylesheet" type="text/css" href="dropdownStyles.css">
    <link rel="stylesheet" type="text/css" href="bottomNAV.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<?php
include "NAVBar functie.php";
include "lijstpaginafuncties.php";
navigatiebalkje();
?>
<body>
<div class="row">
    <div class="col text-center">
        <div class="btn-group text-center" role="group" aria-label="ic example">
            <a type="button" class="btn btn-outline-primary btn-sm align-center" href="Lijstpagina.php?action=AtotZ">Alfabet A - Z</a>
            <a type="button" class="btn btn-outline-primary btn-sm align-center" href="Lijstpagina.php?action=ZtotA">Alfabet Z - A</a>
            <a type="button" class="btn btn-outline-primary btn-sm align-center" href="Lijstpagina.php?action=PLtotPH">Prijs L - H</a>
            <a type="button" class="btn btn-outline-primary btn-sm align-center" href="Lijstpagina.php?action=PHtotPL">Right H - L</a>
        </div>
    </div>
</div>
<br>
<?php

if (isset($_GET['search'])){
    $vraag = $_GET['search'];
} else {
    $vraag = "";
}
$conn = MaakVerbinding();
$sql = "SELECT StockItemName, RecommendedRetailPrice, StockItemID, SearchDetails FROM stockitems WHERE SearchDetails LIKE '%" . $vraag . "%' OR StockItemName LIKE '%" . $vraag . "%'";
$zoekresultaten = mysqli_query($conn, $sql);
?>

<div class="row">
<?php

while($row = mysqli_fetch_array($zoekresultaten)){
    ?>
    <div class="col-xs-6 col-sm-5 col-md-5 col-lg-4 col-xl-3 text-center" style="padding-bottom: 15px;">
<<<<<<< Updated upstream
        <div class="card border-primary" style="width: 21rem; margin: 0 auto; height: 430px;">
=======
        <div class="card border-primary" style="width: 21rem; margin: 0 auto; height: 430px">
>>>>>>> Stashed changes
            <img class="card-img-top" src="imgs/ImageComingSoon.png" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">
                    <?php
                    echo $row['StockItemName'];
                    ?>
                </h5>
                <p class="card-text">
                    <?php
                    echo "€" . round(($row['RecommendedRetailPrice'] * 0.91), 2);
                    ?>
                </p>
                <?php
                echo "<a class='btn btn-outline-primary btn-sm' href='Product.php?id=" . $row['StockItemID'] . "'>Meer details</a>";
                echo "<a class='btn btn-outline-danger btn-sm text-right' href='Winkelwagen.php?id=" . $row['StockItemID'] . "'>Koop nu</a>";
                ?>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
</div>

</body>
<br><br>
<?php
include "bottomFunctie.php";
bottomFunctie();
?>
</html>