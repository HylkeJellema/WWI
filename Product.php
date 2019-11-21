<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<nav class="navbar navbar-dark bg-light justify-content-between">
    <a class="navbar-brand"><img src="imgs/logo.png" alt="logo"></a>
    <form class="form-inline" action="Lijstpagina.php">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</nav>
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
                        <div> <a href="#"><img src="imgs/USB-Thunder-Missile-Launcher.jpg"></a></div>
                    </div>
                </article>
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
                        <dd><p><?php echo $product['beschrijving'] ?> </p></dd>
                    </dl>

                    <dl class="param param-feature">
                        <div class="alert alert-success">
                            <strong>Gratis levering in heel Europa!</strong> voor 23:59 besteld, morgen in huis.
                        </div>
                    </dl>

                    <hr>
                    <div class="row">
                        <div class="col-sm-5">
                            <dl class="param param-inline">
                                <dt>Aantal: </dt>
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
</html>
