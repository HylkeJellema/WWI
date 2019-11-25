<?php

session_start();
include "productfuncties.php";
include "NAVBar functie.php";
navigatiebalkje();


//maakt winkelwagen array aan als er niets in staat
if (empty($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

//Controleert of er wat in winkelwagen wordt gezet en zet nodige gegevens in de winkelwagen array
if (isset($_POST['btnAddToCart'])){
    $productId = $_POST['btnAddToCart'];
    if (!in_array($productId, $_SESSION['cart'])){
        $con = MaakVerbinding();
        $queryProduct = "SELECT StockItemID, StockItemName, RecommendedRetailPrice, SearchDetails FROM stockitems WHERE StockItemID = ?";
        $product = getProduct($con, $queryProduct, $productId);
        $queryVoorraad = "select quantityonhand from stockitemholdings where stockitemid = ?";
        $productVoorraad = getProductVoorraad($con, $queryVoorraad, $productId);
        $_SESSION['cart'][$productId] = array(
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
        unset($_SESSION['cart']);
    }elseif ($_GET['action'] == "delete" ){
        unset($_SESSION['cart'][$_GET['id']]);
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            WWI de internationale groothandel
        </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>
    <body>


        <div class="container-fluid bg-wwi" >
            <div class="container rounded">
                <div class="card">
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
                                        <td>
                                            <?php echo $value['aantal']?>
                                        </td>
                                        <td>€<?php echo round($value['price'], 2); ?></td>

                                        <td><a class="btn btn-danger" href="Winkelwagen.php?action=delete&id=<?php echo $value['id']; ?>">Verwijder</a></td>


                                    </form>
                                </tr>
                                <?php
                                $total = $total + ( $value['aantal'] * round($value['price'], 2));

                            }

                            print("<caption>Totaal: €".$total."</caption>");

                }
                            ?>
                            </tbody>


                            <?php
                         if (empty($_SESSION['cart'])) {
                            ?>
                            <div style='padding-top: 200px;'>
                                <?php print('<h1 style="text-align: center">Winkelwagen is leeg</h1></div>');
                                ?>
                                <div style="padding-top: 100px; padding-bottom: 100px;"><a href=''
                                                                                           style='padding-bottom: 100px'>
                                        <div class="col text-center">
                                            <a class='btn btn-lg btn-primary text-uppercase align-center' href="Lijstpagina.php?">Verder winkelen</a>
                                        </div>
                                    </a></div>
                            </div>
                            <?php
                        }else{
                             ?>
                            <caption><button class="btn btn-primary text-uppercase">Afrekenen</button><a class="btn btn-danger float-right" href="Winkelwagen.php?action=deleteall">Verwijder alles</a></caption>
                        <?php
                            }
                        ?>
                    </table>
                    </div>
                </div>

            </div>
            </div>
        </div>
    </body>

    </div>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
    <br><br>
<?php
include "bottomFunctie.php";
bottomFunctie();
?>


</html>
