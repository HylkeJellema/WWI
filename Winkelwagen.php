<?php

include_once 'header.php'; //betrekt header.php

//maakt winkelwagen array aan als er niets in staat
if (empty($_SESSION['cart'])){ //kijkt of sessie 'cart' leeg is
    $_SESSION['cart'] = array(); //maakt een array aan
}

//Controleert of er wat in winkelwagen wordt gezet en zet nodige gegevens in de winkelwagen array
if (isset($_POST['btnAddToCart'])){ //kijkt of toevoegen aan winkelmand is aangeklikt
    $productId = $_POST['btnAddToCart']; //haalt product id vanuit de post en zet het in in variabele
    if (!in_array($productId, $_SESSION['cart'])){ //kijkt of het product nog niet in winkelmand zit
        $con = MaakVerbinding();
        $queryProduct = "SELECT StockItemID, StockItemName, RecommendedRetailPrice, SearchDetails FROM stockitems WHERE StockItemID = ?"; //haalt gegevens op vanuit database waar stockitem gelijk is aan meegegeven product id
        $product = getProduct($con, $queryProduct, $productId);
        $queryVoorraad = "select quantityonhand from stockitemholdings where stockitemid = ?"; //haalt voorraad gegevens op vanuit de database waar stockitemid gelijk is aan meegegeven id
        $productVoorraad = getProductVoorraad($con, $queryVoorraad, $productId);
        $_SESSION['cart'][$productId] = array( //maakt array aan met toegevoegde producten
            'id' => $productId,
            'name' => $product['productNaam'],
            'price' => $product['productPrijs'],
            'voorraad' => $productVoorraad['voorraad'],
            'aantal' => $_POST['aantal'],
        );

    }
}

//Functie om winkelwagen leeg te maken
if (isset($_GET['action'])) {
    if ($_GET['action'] == "deleteall"){
        unset($_SESSION['cart']); //maakt sessie array leeg
    }elseif ($_GET['action'] == "delete" ){
        unset($_SESSION['cart'][$_GET['id']]); //haalt één product uit array met desbetreffende id
    }
}

//aantal in winkelwagen updaten
if (isset($_POST['update'])){
    foreach ($_SESSION['cart'] as $key => $value) {

        if ($value['id'] == $_POST['updateID']) {
            $_SESSION['cart'][$key]['aantal'] = $_POST['aantal'];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="nl">
    <head>
        <title>
            WWI de internationale groothandel
        </title>
    </head>
    <body>
    <div class="container-fluid bg-wwi" >
            <div class="container rounded">
                <div class="card" style="margin-top: 10px">
                    <div class="card-body">


                <?php
                //wanneer de winkelwagen niet leeg is laat hij de producten zien
                if (!empty($_SESSION['cart'])) {
                    ?>
                    <div style="clear:both"></div>
                    <br/>
                    <div class="table-responsive">
                        <table class="table">
                            <h1 style="text-align: center">Winkelwagen</h1>

                            <thead>
                            <tr>
                                <th scope="col">Product naam</th>
                                <th scope="col">Hoeveelheid</th>
                                <th scope="col">Prijs</th>
                                <th scope="col">Verwijder</th>
                                <th scope="col">Aantal</th>
                                <th scope="col">Update</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $total = 0;
                            // laat gegevens zien van winkelwagen producten vanuit array
                            foreach ($_SESSION['cart'] as $key => $value) {
                                                                ?>
                                <tr>
                                    <form action="Winkelwagen.php" method="post">

                                        <td><?php echo $value['name']; ?></td>
                                        <td><?php echo $value['aantal']?></td>
                                        <td>€<?php echo round(($value['price'] * $omrekenWaarde), 2); ?></td>

                                        <td><a class="btn btn-light" href="Winkelwagen.php?action=delete&id=<?php echo $value['id']; ?>">Verwijder</a></td>

                                        <td>
                                            <select class="custom-select text-center" id="aantal" name="aantal">
                                                <?php
                                                for ($i = 1; $i < 100; $i++){ //aantal selecteren van 1-100
                                                    if ($i == $value['aantal']) {
                                                        echo( "<option value='$i' selected>$i</option>");
                                                    }else{
                                                        print( "<option value='$i'>$i</option>");
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <input type="hidden" value="<?php echo $value['id'] ?>" name="updateID">
                                        </td>

                                        <td><input class="btn btn-success float-left" type="submit" value="Update" name="update" ></caption></td>

                                    </form>
                                </tr>

                                <?php
                            
                               $total = $total + ( $value['aantal'] * round(($value['price'] * $omrekenWaarde), 2));

                            }
                            ?>
                            <tr>
                                <td>
                                    </td>
                                    <td style="text-align: right;">Totaal:</td>
                                <td style="text-align: left;"><?php print("€" . $total);?></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <?php
                }



                         if (empty($_SESSION['cart'])) { //kijkt of winkelwagen leeg is
                            ?>
                            <div style='padding-top: 200px;'>
                                <h1 style="text-align: center">Winkelwagen is leeg</h1></div>
                                <div style="padding-top: 100px; padding-bottom: 100px;"><a href=''
                                                                                           style='padding-bottom: 100px'>
                                        <div class="col text-center">
                                            <a class='btn btn-success text-uppercase align-center' href="Lijstpagina.php?">Verder winkelen</a>
                                        </div>
                            </div>
                            <?php
                        }else{
                             ?>
                            <form action="Winkelwagen.php" method="get">
                                <caption>
                                    <a class='btn btn-success text-uppercase float-right' href="afrekenen.php?">AFREKENEN</a>
                                    <a class="btn btn-light float-left" href="Winkelwagen.php?action=deleteall">Verwijder alles</a>
                                    <a class='btn btn-light text-uppercase align-center' href="Lijstpagina.php?" style="margin-left: 5px;">Verder winkelen</a>
                                    <br>
                                    <br>
                        <?php
                            }
                        ?>
                    </table>
                    </div>
                        <caption></caption>
                </div>

            </div>
            </div>
        </div>
    </body>
    </div>
    </div>
<?php //include __DIR__ . '/includes/footer.php'; ?>

</body>
    <br><br>
<?php

$con = MaakVerbinding();
SluitVerbinding($con);
?>


</html>
