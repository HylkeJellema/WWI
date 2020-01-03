<html>
<head>
    <title>World Wide Imports</title>
</head>
<body>
    <?php
//  Een enkele verbinding leggen tussen dit bestand en 'header.php'.
    include_once 'header.php';
//  Verbinding maken met de database dmv. de MaakVerbinding() functie.
    $con = MaakVerbinding();
//  Vier random producten uit de database ophalen.
    $sql = "SELECT StockItemName, RecommendedRetailPrice, StockItemID, SearchDetails, Photo FROM stockitems ORDER BY rand() LIMIT 4";
    $zoekresultaten = mysqli_query($con, $sql);
    ?>
<!--Kortingsbanner tonen.-->
    <div class="text-center">
    <a href="#"><img src="imgs/kortingsbanner.png" style="width: 100%;"></a>
    </div>
    <br><br>
    <div class="container-fluid">
        <div class="row">
            <?php
//          Terwijl er resultaten zijn die nog getoont moeten worden zal er opnieuw en opnieuw een product afgedrukt worden tot alle producten getoont worden.
            while($row = mysqli_fetch_array($zoekresultaten)){
                ?>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 text-center" style="padding-bottom: 15px;">
                    <div class="card border-info" style="width: 19rem; margin: 0 auto; height: 430px;">
                        <?php
//                      Als er een productfoto in de database staat wordt deze weergegeven, anders wordt een standaardfoto gebruikt.
                        if($row['Photo'] != "") {
                            echo '<img class="card-img-top" src="data:image/jpg;base64,' . base64_encode($row['Photo']) . '" alt="Card image cap" style="width:100%; height: 240px;"/>';
                        } else {
                            echo '<img class="card-img-top" src="imgs/ImageComingSoon.png" alt="Card image cap" style="width:100%; height: 240px;">';
                        }
                        ?>
<!--                    De productnaam, prijs en een 'meer details' worden getoont volgens het specifieke product. De prijs wordt omgerekend van dollars naar euro's.-->
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                <?php
                                echo $row['StockItemName'];
                                ?>
                            </h5>
                            <p class="card-text" style="color: orange;">
                                <?php
                                echo "€" . round(($row['RecommendedRetailPrice'] * $omrekenWaarde), 2);
                                ?>
                            </p>
                            <?php
                            echo "<a class='btn btn-outline-success mt-auto' href='Product.php?id=" . $row['StockItemID'] . "'>Meer details</a>";
                            ?>
                        </div>
                    </div>
                </div>
                <?php
//              De while-loop wordt afgesloten.
            }
            ?>
            <br>
            <br>
        </div>
    </div>
</body>
</html>
