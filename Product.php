<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<nav class="navbar navbar-dark bg-light justify-content-between">
    <a class="navbar-brand"><img src="imgs/logo.png" alt="logo"></a>
    <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</nav>
<body>
<?php
include "productfuncties.php";
$con = MaakVerbinding();
$product = ProductOphalen($con);
?>

<div class="container">
    <div class="card">
        <div class="row">
            <aside class="col-sm-5 border-right">
                <article class="gallery-wrap">
                    <div class="img-big-wrap">
                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $product['Photo'] ).'"/>'; ?>
                        <div> <a href="#"><img src=""></a></div>
                    </div> <!-- slider-product.// -->
                </article> <!-- gallery-wrap .end// -->
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
                        <dd><p><?php echo $product['beschrijving'] ?></p></dd>
                    </dl>

                    <dl class="param param-feature">
                        <dt>Verzending</dt>
                        <dd>Nederland, Europa</dd>
                    </dl>

                    <div class="alert alert-success">
                        <strong>Gratis verzending!</strong> voor 23:59 besteld, morgen in huis
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-sm-5">
                            <dl class="param param-inline">
                                <dt>Aantal: </dt>
                                <div class="box">
                                    <input type="number">
                                </div>

                        </div>
                    </div>
                    <hr>
                    <a href="#" class="btn btn-lg btn-primary text-uppercase"> Buy now </a>
                    <a href="#" class="btn btn-lg btn-outline-primary text-uppercase"> <i class="fas fa-shopping-cart"></i> Add to cart </a>
                </article> <!-- card-body.// -->
            </aside> <!-- col.// -->
        </div> <!-- row.// -->
    </div> <!-- card.// -->


</div>



</body>
</html>
