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
navigatiebalkje();
?>

<body>
<table id="Producten">
    <?php
        include "lijstpaginafuncties.php";
        if(isset($_GET["search"]) == true) {
            $vraag = $_GET["search"];                                                                                           //  Deze $_GET pakt de zoekopdracht en stopt deze in $vraag.
            $conn = MaakVerbinding();
            //$sql2 = "SELECT StockItemName, RecommendedRetailPrice FROM stockitems WHERE StockItemName LIKE '%" . $vraag . "%'";     // Deze sql functie is exclusief de optie om te zoeken op bedrijf.
            $sql = "SELECT StockItemName, RecommendedRetailPrice, StockItemID FROM stockitems JOIN suppliers ON stockitems.SupplierID = suppliers.SupplierID WHERE SupplierName LIKE '%" . $vraag . "%' OR StockItemName LIKE '%" . $vraag . "%'";
            $zoekresultaten = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($zoekresultaten)) {
                echo "<tr>";
                echo "<td><img src='imgs/ImageComingSoon.png' width='120' height='80'></td>";
                echo "<td>" . $row['StockItemName'] . "</td>";
                echo "<td>" . $row['RecommendedRetailPrice'] . "</td>";
                echo "<td><a href='Product.php?id=" . $row['StockItemID'] . "'>Meer details</a>";
                echo "</tr>";
            }
            SluitVerbinding($conn);
        } else {
            $conn = MaakVerbinding();

            $sqlAlles = "SELECT StockItemName, RecommendedRetailPrice, StockItemID FROM stockitems";

            $zoekresultaten = mysqli_query($conn, $sqlAlles);
            while ($row = mysqli_fetch_array($zoekresultaten)) {
                echo "<tr>";
                echo "<td><img src='imgs/ImageComingSoon.png' width='120' height='80'></td>";
                echo "<td>" . $row['StockItemName'] . "</td>";
                echo "<td>" . $row['RecommendedRetailPrice'] . "</td>";
                echo "<td><a href='Product.php?id=" . $row['StockItemID'] . "'>Meer details</a>";
                echo "</tr>";
            }

            SluitVerbinding($conn);
        }
    ?>
</table>
</body>
<br><br>
<?php
include "bottomFunctie.php";
bottomFunctie();
?>


</html>
