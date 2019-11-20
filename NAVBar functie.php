<?php
    function navigatiebalkje(){
        ?>
        <div> <!-- NAVBAR -->

                <a href="Homepagina.php">
                    <img class="logo" src="imgs/wide-world-importers-logo-small.png" height="80">
                </a>
                
                <!--
                        <a href="Login.php">
                            Login
                        </a>
                -->

                <a href="Homepagina.php">
                    <img class="winkelmand" src="imgs/winkelmandje.png" height="75" width="60">
                </a>
                <br>


            <link rel="stylesheet" type="text/css" href="dropdownStyles.css">
            <nav>
                <ul>
                    <li><a class="Home" href="Homepagina.php">Home</a></li>
                    <li><a href="#">Lijst1</a>
                        <ul>
                            <li><a href="#">prod1</a></li>
                            <li><a href="#">prod2</a></li>
                            <li><a href="#">prod3</a></li>
                            <li><a href="#">prod4</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Lijst2</a>
                        <ul>
                            <li><a href="#">prod1</a></li>
                            <li><a href="#">prod2</a></li>
                            <li><a href="#">prod3</a></li>
                            <li><a href="#">prod4</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Lijst3</a>
                        <ul>
                            <li><a href="#">prod1</a></li>
                            <li><a href="#">prod2</a></li>
                            <li><a href="#">prod3</a></li>
                            <li><a href="#">prod4</a></li>
                        </ul></li>

                    <li><a class="Login" href="Login.php">Login</a></li>


                    <li>

                        <form class="form-inline">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>

                    </li>
                </ul>
            </nav>

            <br>
            <div>
        <?php
    }

?>