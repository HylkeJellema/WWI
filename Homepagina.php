<html>
<head>
    <title>World Wide Imports</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="stylesheet" type="text/css" href="dropdownStyles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<?php

use MongoDB\BSON\MaxKey;

include 'init.php';
    //include 'NAVBar functie.php';
    //navigatiebalkje();
    include 'NAVTest.php';
    waza();
    ?>

<?php
/*if (logged_in() == true){
    echo 'logged in!';
} else {
    echo 'nog niet ingelogd';
}
*/?>

<div class="text-center">
<a href="#"><img src="imgs/kortingsbanner.png" style="width: 75%"></a>
</div>

<!-- producten komen nog bradda -->
<br><br>


<?php
$con = MaakVerbinding();
$sql = "SELECT StockItemName, RecommendedRetailPrice, StockItemID, SearchDetails, Photo FROM stockitems ORDER BY rand() LIMIT 4";
$zoekresultaten = mysqli_query($con, $sql);
?>

<div class="row">
    <?php
    while($row = mysqli_fetch_array($zoekresultaten)){
        ?>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 text-center" style="padding-bottom: 15px;">
            <div class="card border-info" style="width: 19rem; margin: 0 auto; height: 430px;">
                <?php
                if($row['Photo'] != "") {
                    echo '<img class="card-img-top" src="data:image/jpg;base64,' . base64_encode($row['Photo']) . '" alt="Card image cap" style="width:100%; height: 240px;"/>';
                } else {
                    echo '<img class="card-img-top" src="imgs/ImageComingSoon.png" alt="Card image cap" style="width:100%; height: 240px;">';
                }
                ?>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">
                        <?php
                        echo $row['StockItemName'];
                        ?>
                    </h5>
                    <p class="card-text" style="color: orange;">
                        <?php
                        echo "€" . round(($row['RecommendedRetailPrice'] * 0.91), 2);
                        ?>
                    </p>
                    <?php
                    echo "<a class='btn btn-outline-info mt-auto' href='Product.php?id=" . $row['StockItemID'] . "'>Meer details</a>";
                    ?>
                </div>
            </div>
        </div>

        <?php
        //stap2:
    }
    ?>

<br><br>
<?php
/*include "bottomFunctie.php";
    bottomFunctie();*/
?>
</body>
</html>
