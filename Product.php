<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="stylesheet" type="text/css" href="dropdownStyles.css">
    <link rel="stylesheet" type="text/css" href="bottomNAV.css">
</head>

<?php
    include "NAVBar functie.php";
        navigatiebalkje();
?>

<body>
<?php
include "productfuncties.php";
$con = MaakVerbinding();
$product = ProductOphalen($con);
$voorraad = VoorraadOphalen($con);
?>

<div class="container">
    <div class="card">
        <div class="row">
            <aside class="col-sm-5 border-right">
                <article class="gallery-wrap">
                    <div class="img-big-wrap">
<<<<<<< HEAD
                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $product['Photo'] ).'"/>'; ?>
                        <div> <a href="#"><img src=""></a></div>
                    </div> <!-- slider-product.// -->
                </article> <!-- gallery-wrap .end// -->
=======
                        <div> <a href="#"><img src="imgs/USB-Thunder-Missile-Launcher.jpg"></a></div>
                    </div>
                </article>
>>>>>>> master
            </aside>
            <aside class="col-sm-7">
                <article class="card-body p-5">
                    <h3 class="title mb-3"><?php echo $product['naam']; ?></h3>

                    <p class="price-detail-wrap">
	<span class="price h3 text-warning">
		<span class="currency">€</span><span class="num"><?php echo $product['price'] ?></span>
	</span>

                    </p>
                    <dl class="item-property">
                        <dt>Beschrijving</dt>
<<<<<<< HEAD
                        <dd><p><?php echo $product['beschrijving'] ?></p></dd>
                    </dl>

                    <dl class="param param-feature">
                        <dt>Verzending</dt>
                        <dd>Nederland, Europa</dd>
=======
                        <dd><p><?php echo $product['beschrijving'] ?> </p></dd>
                    </dl>

                    <dl class="param param-feature">
                        <div class="alert alert-success">
                            <strong>Gratis levering in heel Europa!</strong> voor 23:59 besteld, morgen in huis.
                        </div>
>>>>>>> master
                    </dl>

                    <div class="alert alert-success">
                        <strong>Gratis verzending!</strong> voor 23:59 besteld, morgen in huis
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-sm-5">
                            <dl class="param param-inline">
                                <dt>Aantal: </dt>
<<<<<<< HEAD
                                <div class="box">
                                    <input type="number">
                                </div>
=======
                                <dd>
                                    <div class="box">
                                        <input type="number">
                                    </div>
                                </dd>

                        </div>
                        <div class="col-sm-6"><br>
                                    <strong><?php ($voorraad['voorraad'] . " "); ?></strong>
                            <div class="alert alert-success">
                                <strong>direct leverbaar ✔</strong>
                            </div>
                            </dl>
                        </div>
                        <div class="col-sm-7">
>>>>>>> master

                        </div>
                    </div>
                    <hr>
                    <a href="#" class="btn btn-lg btn-primary text-uppercase"> Koop nu </a>
                    <a href="Winkelwagen.php?" class="btn btn-lg btn-outline-primary text-uppercase"> <i class="fas fa-shopping-cart"></i> Aan mand toevoegen </a>
                </article>
            </aside>
        </div>
    </div>


</div>


</body>
<br><br>
<?php
    include "bottomFunctie.php";
        bottomFunctie();
?>

</html>
