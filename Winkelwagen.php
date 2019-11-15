<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<nav class="navbar navbar-dark bg-light justify-content-between">
    <a class="navbar-brand"><img src="imgs/logo.png" alt="logo"></a>
    <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</nav>
<body>
<?php
include "productfuncties.php";
$conn=MaakVerbinding();
$product= ProductOphalen($conn);

?>

<br><br><br>
<div class="container">
<div class="card">
    <div class="row">
        <div class="col-sm-6">
        <h6>Artikel</h6>
        </div>
        <div class="col-sm-6">
            <h6>Prijs per stuk</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
        <a href="#"><img src="imgs/USB-Thunder-Missile-Launcher.jpg" width="320" height="200"></a>
        </div>
        <div class="col-sm-4">
            <br><br>
            <h5 class="title mb-3"><?php echo $product['naam']; ?></h5>
            <span class="currency">Prijs per stuk €</span><span class="num"><?php echo $product['price'] ?></span>

        </div>
        <div class="col-sm-4">
            <br><br>
            <h5 class="title mb-3">Prijsopgave</h5>
            <button type="button" class="btn btn-primary">Afrekenen</button>
        </div>
    </div>
</div>
</div>



</body>
</html>
