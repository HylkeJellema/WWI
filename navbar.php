<nav class="navbar navbar-light bg-light justify-content-between">
    <a class="navbar-brand">Navbar</a>
    <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</nav>


<!--Lijstpagina navbar-->

<nav class="navbar navbar-light justify-content-between" style="background-color: #DDDDDD;">
    <a href="Homepagina.php">
        <img class="float-left" src="imgs/wide-world-importers-logo-small.png" height="70">
    </a>
    <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
    <form class="form-inline" action="Lijstpagina.php" method="get">
        <div class="btn-group btn-group-toggle" role="group">
            <button class="btn btn-outline-secondary" name="sorteer" value="az" type="submit">Alfabet A - Z</button>
            <button class="btn btn-outline-secondary" name="sorteer" value="za" type="submit">Alfabet Z - A</button>
            <button class="btn btn-outline-secondary" name="sorteer" value="lh" type="submit">Prijs L - H</button>
            <button class="btn btn-outline-secondary" name="sorteer" value="hl" type="submit">Prijs H - L</button>
        </div>
        <input type="hidden" name="search" value="<?php print($_GET["search"]); ?>
    </form>
    <a class="btn btn-outline-secondary" href="Login.php" style="margin-left: 100px; margin-right: 10px;">Inloggen</a>
    <a href="Winkelwagen.php">
        <img class="float-right" src="imgs/winkelmandje.png" height="70" width="70">
    </a>
</nav>