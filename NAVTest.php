<html>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="stylesheet" type="text/css" href="NAVTest.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <?php

        function bovensteNAVBarretje(){



    ?>
<link rel="stylesheet" type="text/css" href="dropdownStyles.css">
    <a href="Homepagina.php">
        <img class="logo" src="imgs/wide-world-importers-logo-small.png" height="70">
    </a>

            <a href="Winkelwagen.php">
                <img class="winkelmand" src="imgs/winkelmandje.png" height="70" width="70">
            </a>

            <form class="form-inline" action="Lijstpagina.php" style="padding-top: 20px">
                <input class="form-control mr-sm-2" type="search" placeholder="Zoeken" aria-label="Search" name="search"
                style="width: 25%" style="margin-left: 90%" style="margin-right: auto">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"
                style="width: 8%" style="margin-left: auto" style="margin-right: auto">Zoeken</button>
            </form>



            <br>
    <?php
        }
    bovensteNAVBarretje();
    ?>


        <nav>
            <div style="margin: 0 auto">
            <ul>

<?php

                    function categorieLijst(){

                    include "productfuncties.php";

                    $host = "localhost";
                    $databasename = "wideworldimporters";
                    $user = "root";
                    $pass = ""; //eigen password invullen
                    $port = 3306;
                    $connection = mysqli_connect($host, $user, $pass, $databasename, $port);


                    $sql = "SELECT StockGroupName FROM stockgroups";
                    $result = mysqli_query($connection, $sql)
                    or die("Error: " . mysqli_error($connection));

                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $naam = $row["StockGroupName"];
                        //print($naam . "<br>");
                        print("<li><a href ='#'>" . $naam . "</a></li>");
                    }


                    SluitVerbinding($connection);

                }

                categorieLijst();
?>



            </ul>
</div>
        </nav>

        <br>
<div class="opmaakje">
    <form action="Lijstpagina.php">
    <input class="opmaakje2" type="search" placeholder="Zoeken" aria-label="Search" name="search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Zoeken</button>
    </form>
</div>

</html>