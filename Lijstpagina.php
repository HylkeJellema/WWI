
<!doctype html>
<html lang="en">
<head>
</head>
<?php
// Een enkele verbinding leggen tussen dit bestand en 'header.php'.
include_once 'header.php';
?>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex" id="wrapper">
<!--                Een sidebar waarin de sorteerknoppen zitten. Deze worden meegenomen door meerdere zoekopdrachten omdat er een form om de knoppen heen zit.-->
                <div class="border-right" id="sidebar-wrapper" style="width: 25%; margin-left: 1%; border-color: #00AEEF;">
                    <div class="container">
                        <form class="form-inline" action="Lijstpagina.php" method="get">
                            <button class="btn btn-outline-primary mt-auto" style="margin: 5px;" name="sorteer" value="az" type="submit">Alfabet<br>A - Z</button>
                            <button class="btn btn-outline-primary mt-auto" style="margin: 5px;" name="sorteer" value="za" type="submit">Alfabet<br>Z - A</button>
                            <button class="btn btn-outline-primary mt-auto" style="margin: 5px;" name="sorteer" value="lh" type="submit">Prijs<br>L - H</button>
                            <button class="btn btn-outline-primary mt-auto" style="margin: 5px;" name="sorteer" value="hl" type="submit">Prijs<br>H - L</button>
<!--                            Onderstaand een verborgen input. Deze zorgt ervoor dat de zoekopdracht niet vergeten wordt wanneer je op een filterknop drukt en de pagina opnieuw inlaadt.-->
                            <input type="hidden" name="search" value="<?php print($_GET["search"]); ?>">
                        </form>
                    </div>
                </div>
                <div id="page-content-wrapper" style="margin-top: 10px">
                    <div class="container-fluid">
                        <div class="row">
                            <?php
//                          Verbinding maken met de database dmv. de MaakVerbinding() functie.
                            $conn = MaakVerbinding();
//                          Als er een zoekopdracht is wordt deze gebruikt in de SLQ-query's vanaf regel 42. Als deze er niet is wordt elk product uit de database gehaald.
                            if(isset($_GET['search'])){
                                $vraag = $_GET['search'];
                            } else {
                                $vraag = "";
                            }
//                          Voorkom SQL-injecties door karakters die ze mogelijk maken uit de zoekopdracht te filteren.
                            $vraag = mysqli_real_escape_string($conn, $vraag);
//                          Onderstaand alle SQL-query's om gegevens uit de database te halen.
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
//                          Als een sorteerknop geactiveerd is dan wordt de bijbehorende query met "ORDER BY ..." gebruikt om resultaten uit een database te halen. Anders worden de gegevens zonder invloed van een sorteerknop getoont.
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
//                          Het aantal resultaten wordt berekend en opgeslagen in variabele $aantalResultaten.
                            $aantalResultaten = mysqli_num_rows($zoekresultaten);
//                          Als $aantalResultaten géén 0 is, worden de resultaten getoont. Anders wordt getoont dat er geen resultaten zijn.
                            if($aantalResultaten > 0) {
//                              Terwijl er resultaten zijn die nog getoont moeten worden zal er opnieuw en opnieuw een product afgedrukt worden tot alle producten getoont worden.
                                while ($row = mysqli_fetch_array($zoekresultaten)) {
                                    ?>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 text-center" style="padding-bottom: 15px;">
<!--                                    Er wordt een kaartje gemaakt waarop de content van een product wordt weergegeven.-->
                                        <div class="card" style="width: 19rem; margin: 0 auto; height: 430px; border-color: #00AEEF;">
                                            <?php
//                                          Als er een productfoto in de database staat wordt deze weergegeven, anders wordt een standaardfoto gebruikt.
                                            if ($row['Photo'] != "") {
                                                echo '<img class="card-img-top" src="data:image/jpg;base64,' . base64_encode($row['Photo']) . '" alt="Card image cap" style="width:100%; height: 240px;"/>';
                                            } else {
                                                echo '<img class="card-img-top" src="imgs/ImageComingSoon.png" alt="Card image cap" style="width:100%; height: 240px;">';
                                            }
                                            ?>
<!--                                        De productnaam, prijs en een 'meer details' worden getoont volgens het specifieke product. De prijs wordt omgerekend van dollars naar euro's.-->
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