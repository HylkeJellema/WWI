<<<<<<< Updated upstream
<html>
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
=======
>>>>>>> Stashed changes
<?php
include 'productfuncties.php';
$con = MaakVerbinding();

if (!isset($_SESSION['deliverytime'])) {
    $_SESSION['deliverytime'] = 1;
}

$product_ids = array();
$id = sanitize_get('productid', 'number');
$updateid = sanitize_post('updateid', 'number');

//update de hoeveelheid van 1 product in de winkelwagen
if (null !== sanitize_post('quantity', 'number') and sanitize_post('quantity', 'number') > 0 and sanitize_post('quantity', 'number') < $_SESSION['shopping_cart'][sanitize_post('updateid', 'number')]['voorraad'] and sanitize_post('quantity', 'number') != "") {
    $_SESSION['shopping_cart'][$updateid]['quantity'] = sanitize_post('quantity', 'number');
}

if (sanitize_get('productid', 'number')) {
    //maakt array wanneer $id nog niet in de array $product_ids staat
    if (!in_array($id, $product_ids) and $id != "" and sqlexists('select * from stockitems where stockitemid = ?', array($id))) {
        $voorraad = sqlselect("select stockitemid, quantityonhand from stockitemholdings where stockitemid = ?", array($id));
        $stockdata = sqlselect("select * from stockitems where stockitemid = ?", array($id));
        $_SESSION['shopping_cart'][$id] = array
        (
            'id' => $id,
            'name' => $stockdata[0]['StockItemName'],
            'price' => $stockdata[0]['RecommendedRetailPrice'],
            'quantity' => 1,
            'voorraad' => $voorraad[0]['quantityonhand']
        );
    }
    $count = count($_SESSION['shopping_cart']);
    //$product_ids array haalt alle id's op uit de sessie array
    $product_ids = array_column($_SESSION['shopping_cart'], 'id');
};

if (sanitize_get('action', 'string') == 'delete') {
    //verwijdert specifiek product van de winkelwagen
    unset($_SESSION['shopping_cart'][sanitize_get('id', 'number')]);
}

if (sanitize_get('action', 'string') == 'deleteall') {
    //verwijdert hele winkelwagen
    unset($_SESSION['shopping_cart']);
}

if (isset($_POST['update'])) {
    foreach ($_SESSION['shopping_cart'] as $key => $value) {
        if ($key != 'totalcost') {
            // zet de hoeveelheid weer terug naar 1 wanneer iemand de hoeveelhied negatief te krijgen
            if ("quantity" < 1) {
                $value['quantity'] = 1;
            }
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>
        WWI de internationale groothandel
    </title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/shop-homepage.css"/>

</head>
<body>
<?php include __DIR__ . '/includes/header.php'; ?>

<div class="container-fluid bg-wwi" >
    <div class="container bg-light rounded">
        <?php
        unset($_SESSION['shopping_cart']['totalcost']);
        //wanneer de winkelwagen niet leeg is laat hij de producten zien
        if (!empty($_SESSION['shopping_cart'])) {
        ?>
        <div style="clear:both"></div>
        <br/>
        <h1 style="text-align: center">Winkelwagen</h1>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th colspan="12"><h3>Details</h3></th>
                </tr>
                <tr>
                    <th class="col-3">Product naam</th>
                    <th class="col-1">Voorraad</th>
                    <th class="col-2">Hoeveelheid</th>
                    <th class="col-2">Prijs</th>
                    <th class="col-2">Totaal</th>
                    <th class="col-1">Update</th>
                    <th class="col-1">Actie</th>
                </tr>
                <?php
                $total = 0;

                foreach ($_SESSION['shopping_cart'] as $key => $value) {
                    if ($key != 'totalcost') {
                        ?>
                        <tr>
                            <form action="cart.php" method="post">

                                <td><?php echo $value['name']; ?></td>
                                <td><?php
                                    // checkt of het product op voorraad is
                                    $huidig_voorraad = $value['voorraad'];
                                    if ($huidig_voorraad > 99) {
                                        $huidig_voorraad = '99+';
                                    } elseif ($huidig_voorraad <= 0) {
                                        $huidig_voorraad = 'Niet op Voorraad';
                                    }
                                    echo $huidig_voorraad;
                                    ?></td>
                                <td><input class="form-control" type="number" name="quantity" min='1'
                                           value="<?php echo $value['quantity'] ?>"></td>
                                <td>€<?php echo $value['price']; ?></td>
                                <td>€<?php echo number_format($value['quantity'] * $value['price'], 2); ?></td>
                                <td>
                                    <input type="hidden" value="<?php echo $key; ?>" name="updateid">
                                    <row>
                                        <button class="btn btn-info" type="submit" name="update">Update
                                        </button>
                                </td>
                            </form>
                            <td>
                                <a class="btn btn-danger" href="cart.php?action=delete&id=<?php echo $key; ?>">Verwijder
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                    $total = $total + ($value['quantity'] * $value['price']);
                    $_SESSION['totalcost'] = $total;
                }
                ?>
                <tr>
                    <td colspan="3" style="text-align: right">Totaal</td>
                    <td>

                    <td>€<?php echo number_format($total, 2); ?></td>
                    <td>
                    <td><a class="btn btn-danger float-right" href="cart.php?action=deleteall">Verwijder alles</a></td>
                </tr>
                <td colspan="12">
                    <?php
                    //wanneer er producten in de winkelwagen zitten dan wordt pas de afreken knop laten zien anders niet
                    if (isset($_SESSION['shopping_cart'])) {
                        if (count($_SESSION['shopping_cart']) > 0) {
                            ?>
                            <br>
                            <form action="paypage.php" method="post">
                                <input type="hidden" name="ProcessID" value="1">
                                <button class="btn btn-info col-12">Afrekenen</button>
                            </form>
                            <br>
                            <?php
                        }
                    }
                    ?>
                </td>
                </tr>
                <?php
                } else {
                    ?>
                    <div style='padding-top: 200px;'>
                        <?php print('<h1 style="text-align: center">Winkelwagen is leeg</h1></div>');
                        ?>
                        <div style="padding-top: 100px; padding-bottom: 100px;"><a href='index.php'
                                                                                   style='padding-bottom: 100px'>
                                <button class='btn btn-info offset-5 col-2'>Verder winkelen</button>
                            </a></div>
                    </div>
                    <?php
                }
                ?>
            </table>
        </div>

    </div>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
<<<<<<< Updated upstream
<br><br>
<?php
include "bottomFunctie.php";
bottomFunctie();
?>

=======
>>>>>>> Stashed changes

</html>
