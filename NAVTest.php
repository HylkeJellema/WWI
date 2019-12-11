<html>
    <head>

    </head>
    <body>
            <?php
                function waza(){
                    ?>
                    <link rel="stylesheet" type="text/css" href="Style.css">
                    <link rel="stylesheet" type="text/css" href="NAVTest.css">
                    <link rel="stylesheet" type="text/css" href="dropdownStyles.css">
                    <div class="span" style="background-color: #EAE9E9">
                        <a href="Homepagina.php">
                            <img class="logo" src="imgs/wide-world-importers-logo-small.png" height="70">
                        </a>
                        <div style="text-align: right">
                            <a href="Winkelwagen.php">
                                <img class="winkelmand" src="imgs/winkelmandje.png" height="60" width="60">
                            </a>
                        </div>
                        <form class="form-inline" method="get">
                            <div style="margin-left: 30%; margin-right: 30%; margin-bottom: 10px; margin-top: 10px;">
                                <input class="form-control mr-sm-2" type="search" placeholder="Zoeken" aria-label="Search" name="search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Zoeken</button>
                            </div>
                        </form>
                        <div class="form-inline">
                            <a href="login.php">

                        <?php
                        function nogeentje()
                        {
                            ?>
                                <form class="form-inline" method="get" action="Lijstpagina.php?">
                                    <div style="margin-left: 30%; margin-right: 30%; margin-bottom: 10px; margin-top: 10px;">
                                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" >Search</button>
                                    </div>
                                </form>
                            </div>
                        <?php }

                        nogeentje();
                        ?>

                        <?php
                    }

                    bovensteNAVBarretje();
                    ?>
                    <nav style="background-color: #00AEEF;">
                        <div style="text-align: center; border-top: 2px solid white;">
                            <ul>
                                <?php
                                    include_once 'init.php';
                                    $conn = MaakVerbinding();

                                    $sql = "SELECT StockGroupName FROM stockgroups";
                                    $result = mysqli_query($conn, $sql)
                                    or die("Error: " . mysqli_error($conn));
                                    ?>
                                    <form method="GET" action="Lijstpagina.php">
                                        <?php
                                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            $categorie = $row["StockGroupName"];
                                            echo("<button class='btn btn-outline-light btn-md' style='margin-top: 10px; margin-left: 5px; margin-right: 5px;' name='search' value='$categorie'>" . $categorie . "</button>");
                                        }
                                        ?>
                                    </form>
                                    <?php
                                    SluitVerbinding($conn);
                                ?>
                            </ul>
                        </div>

                    </nav>
                    <br>
                    <?php
                }
            ?>
    </body>
</html>