<!doctype html>
<html lang="en">
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
<table id="Producten">
    <?php
        include "lijstpaginafuncties.php";
        $vraag = $_GET["search"]; 
        $conn = MaakVerbinding();
        $sql = "SELECT StockItemName, RecommendedRetailPrice FROM stockitems WHERE StockItemName LIKE '%" . $vraag . "%'";
        $zoekresultaten = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($zoekresultaten)){
            echo "<tr>";
    echo "<td>" . $row['StockItemName'] . "</td>";
    echo "<td>" . $row['RecommendedRetailPrice'] . "</td>";
    echo "</tr>";
        };
        SluitVerbinding($conn);
    ?>
</table>
</body>
</html>