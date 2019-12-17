
<!doctype html>
<html lang="en">
<head>
</head>
<?php
include_once 'header.php';
?>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="d-flex" id="wrapper">
            <div class="border-right" id="sidebar-wrapper" style="width: 25%; margin-left: 1%; border-color: #00AEEF;">
                <div class="container">
                    <form class="form-inline" action="Lijstpagina.php" method="get">
                        <button class="btn btn-outline-primary mt-auto" style="margin: 5px;" name="sorteer" value="az" type="submit">Alfabet<br>A - Z</button>
                        <button class="btn btn-outline-primary mt-auto" style="margin: 5px;" name="sorteer" value="za" type="submit">Alfabet<br>Z - A</button>
                        <button class="btn btn-outline-primary mt-auto" style="margin: 5px;" name="sorteer" value="lh" type="submit">Prijs<br>L - H</button>
                        <button class="btn btn-outline-primary mt-auto" style="margin: 5px;" name="sorteer" value="hl" type="submit">Prijs<br>H - L</button>
                        <input type="hidden" name="search" value="<?php print($_GET["search"]); ?>">
                    </form>
                </div>
            </div>
            <div id="page-content-wrapper" style="margin-top: 10px">
                <div class="container-fluid">
                    <div class="row">
                        <?php

                        $conn = MaakVerbinding();

                        if(isset($_GET['search'])){
                            $vraag = $_GET['search'];
                        } else {
                            $vraag = "";
                        }

                        $vraag = mysqli_real_escape_string($conn, $vraag);

                        $sql =         "SELECT DISTINCT StockItemName, RecommendedRetailPrice, A.StockItemID, Photo
                                        FROM stockitems AS A
                                        INNER JOIN stockitemstockgroups AS B ON A.StockItemID = B.StockItemID
                                        INNER JOIN stockgroups AS C ON B.StockGroupID = C.StockGroupID
                                        WHERE C.StockGroupName = '" . $vraag . "'
                                        OR StockItemName LIKE '%" . $vraag . "%'
                                        OR SearchDetails LIKE '%" . $vraag . "%'
                                        ORDER BY StockItemName ASC";

                        $sqlPHtotPL =   "SELECT DISTINCT StockItemName, RecommendedRetailPrice, A.StockItemID, Photo
                                        FROM stockitems AS A
                                        INNER JOIN stockitemstockgroups AS B ON A.StockItemID = B.StockItemID
                                        INNER JOIN stockgroups AS C ON B.StockGroupID = C.StockGroupID
                                        WHERE C.StockGroupName = '" . $vraag . "'
                                        OR StockItemName LIKE '%" . $vraag . "%'
                                        OR SearchDetails LIKE '%" . $vraag . "%'
                                        ORDER BY RecommendedRetailPrice DESC";

                        $sqlPLtotPH =   "SELECT DISTINCT StockItemName, RecommendedRetailPrice, A.StockItemID, Photo
                                        FROM stockitems AS A
                                        INNER JOIN stockitemstockgroups AS B ON A.StockItemID = B.StockItemID
                                        INNER JOIN stockgroups AS C ON B.StockGroupID = C.StockGroupID
                                        WHERE C.StockGroupName = '" . $vraag . "'
                                        OR StockItemName LIKE '%" . $vraag . "%'
                                        OR SearchDetails LIKE '%" . $vraag . "%'
                                        ORDER BY RecommendedRetailPrice ASC";

                        $sqlZtotA = "SELECT DISTINCT StockItemName, RecommendedRetailPrice, A.StockItemID, Photo
                                        FROM stockitems AS A
                                        INNER JOIN stockitemstockgroups AS B ON A.StockItemID = B.StockItemID
                                        INNER JOIN stockgroups AS C ON B.StockGroupID = C.StockGroupID
                                        WHERE C.StockGroupName = '" . $vraag . "'
                                        OR StockItemName LIKE '%" . $vraag . "%'
                                        OR SearchDetails LIKE '%" . $vraag . "%'
                                        ORDER BY StockItemName DESC";

                        $sqlAtotZ = "SELECT DISTINCT StockItemName, RecommendedRetailPrice, A.StockItemID, Photo
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
                            $zoekresultaten = mysqli_query($conn, $sql);
                        }
                        $aantalResultaten = mysqli_num_rows($zoekresultaten);
                        if($aantalResultaten > 0) {
                            while ($row = mysqli_fetch_array($zoekresultaten)) {
                                ?>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 text-center"
                                     style="padding-bottom: 15px;">
                                    <div class="card" style="width: 19rem; margin: 0 auto; height: 430px; border-color: #00AEEF;">
                                        <?php
                                        if ($row['Photo'] != "") {
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
                                            echo "<a class='btn btn-outline-success mt-auto' href='Product.php?id=" . $row['StockItemID'] . "'>Meer details</a>";
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="form-inline">
                                <div class="card" style="alignment: center; margin: 1%; width: 90%; border-color: ghostwhite;">
                                    <img class="card-ig-top" src="imgs/geenproducten.png" alt="Card image cap" style="width: 100%; height: 100%;">
                                    <div class="card-body foutmeldingen">
                                        <p>Er zijn helaas geen producten gevonden.</p>
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
</div>
</body>
<br><br>
</html>