<html>

<?php
    include "productfuncties.php";
?>

    <link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="stylesheet" type="text/css" href="NAVTest.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    -->
    <?php
        function bovensteNAVBarretje(){
    ?>
<link rel="stylesheet" type="text/css" href="dropdownStyles.css">
    <a href="Homepagina.php">
        <img class="logo" src="imgs/wide-world-importers-logo-small.png" height="70">
    </a>
    <a href="Winkelwagen.php">
        <img class="winkelmand" src="imgs/winkelmandje.png" height="60" width="60">
    </a>
    <?php
        function nogeentje(){
    ?>
    <div class="opmaakje">
        <form method="get" action="Lijstpagina.php">
            <input class="opmaakje2" type="search" placeholder="Zoeken" aria-label="Search" name="search">
            <button class="button" type="submit">Zoeken</button>
        </form>
    </div>
    <?php }
        nogeentje();
    ?>
    <br>
    <?php
        }
    bovensteNAVBarretje();
    ?>
    <nav>
        <div style="margin: 0 auto;">
            <ul>
                <?php
                    function categorieLijst(){
                        $conn = MaakVerbinding();

                        $sql = "SELECT StockGroupName FROM stockgroups";
                        $result = mysqli_query($conn, $sql)
                        or die("Error: " . mysqli_error($conn));
                ?>
                            <form method="GET" action="Lijstpagina.php">
                <?php
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        $categorie = $row["StockGroupName"];
                                        echo("<button class='categorieButton' name='" . $categorie . "' value='$categorie'>" . $categorie . "</button>");
                                    }
                ?>
                            </form>
                <?php
                    SluitVerbinding($conn);
                }
                categorieLijst();
                ?>
            </ul>
        </div>
    </nav>
    <br>
</html>