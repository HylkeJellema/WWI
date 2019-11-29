<?php
    function navigatiebalkje(){
        ?>
        <div> <!-- NAVBAR -->

                <a href="Homepagina.php">
                    <img class="logo" src="imgs/wide-world-importers-logo-small.png" height="70">
                </a>
                
                <!--
                        <a href="Login.php">
                            Login
                        </a>
                -->

                <a href="Winkelwagen.php">
                    <img class="winkelmand" src="imgs/winkelmandje.png" height="75" width="60">
                </a>
                <!-- <a href="detect.php">
                        <img class="winkelmand" src="imgs/cam.png" height="75" width="60">
                </a> -->
                <br>


            <link rel="stylesheet" type="text/css" href="dropdownStyles.css">
            <nav>
                <ul>
                    <li><a class="Home" href="Homepagina.php">Home</a></li>
                    <li><a href="#">Categorieën</a>
                        <ul>
                            <li><a href="#">Novelty Items</a></li>
                            <li><a href="#">Clothing</a></li>
                            <li><a href="#">Mugs</a></li>
                            <li><a href="#">T-Shirts</a></li>
                            <li><a href="#">Airline Novelties</a></li>
                            <li><a href="#">Computing Novelties</a></li>
                            <li><a href="#">USB Novelties</a></li>
                            <li><a href="#">Furry Footwear</a></li>
                            <li><a href="#">Toys</a></li>
                            <li><a href="#">Packaging Materials</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Aanbiedingen</a>
                        <ul>
                            <li><a href="#">prod1</a></li>
                            <li><a href="#">prod2</a></li>
                            <li><a href="#">prod3</a></li>
                            <li><a href="#">prod4</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Zakelijk</a>
                        <ul>
                            <li><a href="#">prod1</a></li>
                            <li><a href="#">prod2</a></li>
                            <li><a href="#">prod3</a></li>
                            <li><a href="#">prod4</a></li>
                        </ul></li>

                    <li><a class="Login" href="Login.php">Inloggen</a></li>


                    <li>

                        <form class="form-inline" action="Lijstpagina.php">
                            <input class="form-control mr-sm-2" type="search" placeholder="Zoeken" aria-label="Search" name="search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Zoeken</button>
                        </form>
                        

                    </li>
                </ul>
            </nav>

            <br>
            <div>
        <?php
    }

?>