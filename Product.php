<html>
<head>
</head>
<?php
include_once 'header.php';
$con = MaakVerbinding();
$product = ProductOphalen($con);
$voorraad = VoorraadOphalen($con);
?>

<body>
<div class="container">
    <div class="card" style="margin-top: 10px">
        <div class="row">
            <div class="card-body left" style="text-align: center">
                <a href="#">
                    <?php
                    if($product['Photo'] != "") {
                        echo ('<img src="data:image/jpg;base64,'.base64_encode($product["Photo"]).'" style="width:80%; padding-bottom: 15px;">');
                    } else {
                        echo '<img src="imgs/ImageComingSoon.jpg" width="320" height="240" style="padding-bottom: 15px;">';
                    }
                    ?>
                </a>
                <br>
                <video width="320" height="240" controls>
                    <source src='video/<?php echo $product['nummer'] ?>/productvideo.mp4' type='video/mp4'>
                    <source src="video/placeholder.mp4" type="video/mp4">
                    Het videoformat wordt niet ondersteund door Uw webbrowser.
                </video>
            </div>
            <article class="card-body right">
                <h3 class="title mb-3" style="width: 32rem;">
                    <?php echo $product['naam']; ?>
                </h3>
                <p class="price-detail-wrap">
                    <span class="price h3 text-warning">
                        <span class="currency">€</span><span class="num"><?php echo round(($product['price'] * $omrekenWaarde), 2) ?></span>
                    </span>
                </p>
                <dl class="item-property" style="width: 32rem;">
                    <dt>Beschrijving</dt>
                    <dd><p><?php echo $product['beschrijving'] ?></p></dd>
                    <?php
                    if ($product['koelProduct'] == TRUE){
                        ?>
                        <dt>Dit product is een gekoeld product</dt>
                        <dd>Dit product wordt gekoeld geleverd</dd>
                        <dd>Dit product bij 2-5 graden bewaren</dd>
                        <?php
                        }
                    ?>
                </dl>
                <dl class="param param-feature">
                    <dt>Verzending</dt>
                    <dd>Nederland, Europa</dd>
                    <dl class="param param-feature">
                        <?php
                            if ($voorraad['voorraad'] > 0){
                        ?>
                        <div class="alert alert-success">
                            <strong>Gratis levering in heel Nederland!</strong> voor 23:59 besteld, morgen in huis.
                        </div>
                        <?php
                            } else {
                        ?>
                        <div class="alert alert-warning">
                            <strong>Leverdatum onbekend.</strong>
                        </div>
                        <?php
                            }
                        ?>
                    </dl>
                    <hr>
                    <form method="post" action="Winkelwagen.php">
                        <div class="row">
                            <div class="col-sm-5">
                                <dl class="param param-inline">
                                    <dt>Aantal: </dt>
                                    <div class="form-group">
                                        <select class="custom-select text-center" id="aantal" name="aantal">
                                            <?php
                                            for ($i = 1; $i < 100; $i++){
                                                print( "<option value='$i'>$i</option>");
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </dl>
                            </div>
                            <div class="col-sm-6"><br>
                                <strong><?php ($voorraad['voorraad'] . " "); ?></strong>
                                <?php
                                    if ($voorraad['voorraad'] > 0){
                                ?>
                                <div class="alert alert-success">
                                    <strong>Op voorraad✔</strong>
                                </div>
                                <?php
                                    } else {
                                ?>
                                <div class="alert alert-warning" role="alert">
                                    <strong> Niet op voorraad!</strong>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <hr>
                        <button value="<?php echo $product['nummer'] ?>" id="btnAddToCart" name="btnAddToCart" type="submit" class="btn btn-lg btn-outline-success text-uppercase">
                            Aan mand toevoegen
                        </button>
                    </form>
                </dl>
            </article>
        </div>
    </div>
</body>
<br><br>
<?php

    SluitVerbinding($con);
?>

</html>
