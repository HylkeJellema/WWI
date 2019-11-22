<?php

session_start();
include "productfuncties.php";

<<<<<<< Updated upstream
include "NAVBar functie.php";
navigatiebalkje();

if (empty($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}


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
            'aantal' => $_POST['aantal']
=======
$product_ids = array();
$id = $_GET('productid', 'number');
$updateid = $_POST('updateid', 'number');

//update de hoeveelheid van 1 product in de winkelwagen
if (null !== $_POST('quantity', 'number') and $_POST('quantity', 'number') > 0 and $_POST('quantity', 'number') < $_SESSION['shopping_cart'][$_POST('updateid', 'number')]['voorraad'] and $_POST('quantity', 'number') != "") {
    $_SESSION['shopping_cart'][$updateid]['quantity'] = $_POST('quantity', 'number');
}

if ($_GET('productid', 'number')) {
    //maakt array wanneer $id nog niet in de array $product_ids staat
    if (!in_array($id, $product_ids) and $id != "" and sqliexists('select * from stockitems where stockitemid = ?', array($id))) {
        $voorraad = sqlselect("select stockitemid, quantityonhand from stockitemholdings where stockitemid = ?", array($id));
        $stockdata = sqlselect("select * from stockitems where stockitemid = ?", array($id));
        $_SESSION['shopping_cart'][$id] = array
        (
            'id' => $id,
            'name' => $stockdata[0]['StockItemName'],
            'price' => $stockdata[0]['RecommendedRetailPrice'],
            'quantity' => 1,
            'voorraad' => $voorraad[0]['quantityonhand']
>>>>>>> Stashed changes
        );

    }
}

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

                            foreach ($_SESSION['cart'] as $key => $value) {
                                ?>
                                <tr>
                                    <form action="Winkelwagen.php" method="post">

                                        <td><?php echo $value['name']; ?></td>
                                        <td>
                                            <?php echo $value['aantal']?>
                                        </td>
                                        <td>€<?php echo $value['price']; ?></td>

                                        <td><a class="btn btn-danger" href="Winkelwagen.php?action=delete&id=<?php echo $value['id']; ?>">Verwijder</a></td>


                                    </form>
                                </tr>
                                <?php
                                $total = $total + ( $value['aantal'] * $value['price']);

                            }

                            print("<caption>Totaal: €".$total."</caption>");

                }
                            ?>
                            </tbody>


                            <?php
                         if (count($_SESSION['cart']) == 0) {
                            ?>
                            <div style='padding-top: 200px;'>
                                <?php print('<h1 style="text-align: center">Winkelwagen is leeg</h1></div>');
                                ?>
                                <div style="padding-top: 100px; padding-bottom: 100px;"><a href=''
                                                                                           style='padding-bottom: 100px'>
                                        <div class="col text-center">
                                            <button class='btn btn-lg btn-primary text-uppercase align-center'>Verder winkelen</button>

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

</html>
