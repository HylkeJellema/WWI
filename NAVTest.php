

<html>
<link rel="stylesheet" type="text/css" href="Style.css">

    <link rel="stylesheet" type="text/css" href="NAVTest.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</html>

<link rel="stylesheet" type="text/css" href="dropdownStyles.css">
        <nav>
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


        </nav>

        <br>

