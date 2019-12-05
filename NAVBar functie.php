<?php
    function navigatiebalkje(){
        ?>
        <div>
            <a href="Homepagina.php">
                <img class="logo" src="imgs/wide-world-importers-logo-small.png" height="70">
            </a>

            <a href="Winkelwagen.php">
                <img class="winkelmand" src="imgs/winkelmandje.png" height="75" width="60">
            </a>
            <!-- <a href="detect.php">
                <img class="winkelmand" src="imgs/cam.png" height="75" width="60">
            </a> -->
            <br>
<!--            <link rel="stylesheet" type="text/css" href="dropdownStyles.css">-->
            <nav>
                <ul>
                    <li><a class="Home" href="Homepagina.php">Home</a></li>
                    <li>
                        <div class="center">
                            <form class="form-inline" action="Lijstpagina.php">
                                <?php
                                if(isset($_GET["search"])){
                                    print("<input class='form-control mr-sm-2' type='search' aria-label='Search' value='".$_GET["search"]."' name='search'>");
                                } else {
                                    print("<input class='form-control mr-sm-2' type='search' placeholder='Zoeken' aria-label='Search' name='search'>");}?>
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Zoeken</button>
                            </form>
                        </div>
                    </li>
                    <li><a class="Login" href="login.php">Inloggen</a></li>
                </ul>
            </nav>
            <br>
        <div>
        <?php
    }

?>