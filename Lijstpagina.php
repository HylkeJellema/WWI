
<!doctype html>
<html lang="en">
<head>
<!--    <link rel="stylesheet" type="text/css" href="Style.css">-->
<!--    <link rel="stylesheet" type="text/css" href="dropdownStyles.css">-->
<!--    <link rel="stylesheet" type="text/css" href="bottomNAV.css">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>


<?php
include 'NAVTest.php';
waza();
include "lijstpaginafuncties.php";
include_once "productfuncties.php";
//include "NAVBar functie.php";
//navigatiebalkje();
?>
<!--<nav class="navbar navbar-light justify-content-between" style="background-color: #EAE9E9; margin-bottom: 15px;">-->
<!--    <a href="Homepagina.php">-->
<!--        <img class="float-left" src="imgs/wide-world-importers-logo-small.png" height="70">-->
<!--    </a>-->
<!--    <form class="form-inline" method="get">-->
<!--        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">-->
<!--        <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>-->
<!--    </form>-->
<!--    <a class="btn btn-outline-secondary" href="Login.php" style="margin-left: 10px; margin-right: 10px;">-->
<!--        Inloggen-->
<!--    </a>-->
<!--    <a href="Winkelwagen.php">-->
<!--        <img class="float-right" src="imgs/winkelmandje.png" height="70" width="70">-->
<!--    </a>-->
<!--</nav>-->
<body>
    <div class="row">
        <div class="d-flex" id="wrapper">
            <div class="border-right" id="sidebar-wrapper" style="width: 25%; margin-left: 40px;">
                <div class="container">
                    <form class="form-inline" action="Lijstpagina.php" method="get">
                        <button class="btn btn-outline-info mt-auto" style="margin-bottom: 15px;" name="sorteer" value="az" type="submit">Alfabet A - Z</button>
                        <button class="btn btn-outline-info mt-auto" style="margin-bottom: 15px;" name="sorteer" value="za" type="submit">Alfabet Z - A</button>
                        <button class="btn btn-outline-info mt-auto" style="margin-bottom: 15px;" name="sorteer" value="lh" type="submit">Prijs L - H</button>
                        <button class="btn btn-outline-info mt-auto" style="margin-bottom: 15px;" name="sorteer" value="hl" type="submit">Prijs H - L</button>
                        <input type="hidden" name="search" value="<?php print($_GET["search"]); ?>">
                    </form>
                </div>
            </div>
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <?php

                        $conn = MaakVerbinding();

                        if(isset($_GET['search'])){
                            $vraag = $_GET['search'];
                        } else {
                            $vraag = "";
                        }

                        //$sql = "SELECT StockGroupName FROM stockgroups";
                        //$result = mysqli_query($conn, $sql)
                        //or die("Error: " . mysqli_error($conn));
                        //while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                        //    $categorie = $row["StockGroupName"];
                        //    if(isset($_GET["$categorie"])){
                        //        $cat = $categorie;
                        //    }
                        //}

                        $sql =         "SELECT StockItemName, RecommendedRetailPrice, A.StockItemID, Photo
                                        FROM stockitems AS A
                                        INNER JOIN stockitemstockgroups AS B ON A.StockItemID = B.StockItemID
                                        INNER JOIN stockgroups AS C ON B.StockGroupID = C.StockGroupID
                                        WHERE C.StockGroupName = '" . $vraag . "'
                                        OR StockItemName LIKE '%" . $vraag . "%'
                                        OR SearchDetails LIKE '%" . $vraag . "%'
                                        ORDER BY StockItemName ASC";

                        $sqlPHtotPL =   "SELECT StockItemName, RecommendedRetailPrice, A.StockItemID, Photo
                                        FROM stockitems AS A
                                        INNER JOIN stockitemstockgroups AS B ON A.StockItemID = B.StockItemID
                                        INNER JOIN stockgroups AS C ON B.StockGroupID = C.StockGroupID
                                        WHERE C.StockGroupName = '" . $vraag . "'
                                        OR StockItemName LIKE '%" . $vraag . "%'
                                        OR SearchDetails LIKE '%" . $vraag . "%'
                                        ORDER BY RecommendedRetailPrice DESC";

                        $sqlPLtotPH =   "SELECT StockItemName, RecommendedRetailPrice, A.StockItemID, Photo
                                        FROM stockitems AS A
                                        INNER JOIN stockitemstockgroups AS B ON A.StockItemID = B.StockItemID
                                        INNER JOIN stockgroups AS C ON B.StockGroupID = C.StockGroupID
                                        WHERE C.StockGroupName = '" . $vraag . "'
                                        OR StockItemName LIKE '%" . $vraag . "%'
                                        OR SearchDetails LIKE '%" . $vraag . "%'
                                        ORDER BY RecommendedRetailPrice ASC";

                        $sqlZtotA = "SELECT StockItemName, RecommendedRetailPrice, A.StockItemID, Photo
                                        FROM stockitems AS A
                                        INNER JOIN stockitemstockgroups AS B ON A.StockItemID = B.StockItemID
                                        INNER JOIN stockgroups AS C ON B.StockGroupID = C.StockGroupID
                                        WHERE C.StockGroupName = '" . $vraag . "'
                                        OR StockItemName LIKE '%" . $vraag . "%'
                                        OR SearchDetails LIKE '%" . $vraag . "%'
                                        ORDER BY StockItemName DESC";

                        $sqlAtotZ = "SELECT StockItemName, RecommendedRetailPrice, A.StockItemID, Photo
                                        FROM stockitems AS A
                                        INNER JOIN stockitemstockgroups AS B ON A.StockItemID = B.StockItemID
                                        INNER JOIN stockgroups AS C ON B.StockGroupID = C.StockGroupID
                                        WHERE C.StockGroupName = '" . $vraag . "'
                                        OR StockItemName LIKE '%" . $vraag . "%'
                                        OR SearchDetails LIKE '%" . $vraag . "%'
                                        ORDER BY StockItemName ASC";

                        if(isset($_GET["sorteer"])){
                            if($_GET["sorteer"]=="az"){
                                $zoekresultaten = mysqli_query($conn, $sqlAtotZ);}
                            elseif($_GET["sorteer"]=="za"){
                                $zoekresultaten = mysqli_query($conn, $sqlZtotA);}
                            elseif($_GET["sorteer"]=="hl"){
                                $zoekresultaten = mysqli_query($conn, $sqlPHtotPL);}
                            elseif($_GET["sorteer"]=="lh"){
                                $zoekresultaten = mysqli_query($conn, $sqlPLtotPH);}
                        } else {
                            //    if(isset($_GET["$cat"])){
                            //        $zoekresultaten = mysqli_query($conn, $sqlCategorie);
                            //    } else {
                            //        $zoekresultaten = mysqli_query($conn, $sql);
                            //    }
                            $zoekresultaten = mysqli_query($conn, $sql);
                        }
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
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<br><br>
<?php
/*include "bottomFunctie.php";
bottomFunctie();*/
?>
</html>