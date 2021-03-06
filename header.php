<?php
include ("init.php"); //betrekt init.php
$omrekenWaarde = 0.91; //valuta van euro
?>
<html>
<header>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="stylesheet" type="text/css" href="NAVTest.css">
</header>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-light" style="padding-bottom: 10px">
    <a href="Homepagina.php" style="padding-right: 20px">
        <img class="logo" src="imgs/wide-world-importers-logo-small.png" height="60">

    </a>
        <form class="navbar-nav mr-auto" action="Lijstpagina.php?">
            <input class="form-control mr-sm-2" type="search" placeholder="Zoeken" aria-label="Search" name="search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Zoeken</button>
        </form>
    <?php
    if (logged_in() == true) { //checkt of er ingelogd is
        $session_user_id = $_SESSION['user_id']; //zet de sessie id in een variabele
        $user_data = user_data($con, $session_user_id); //zet de gebruikers gegevens in variabele
        ?>
                <a class="span">Hello, <?php echo $user_data['first_name']?>!</a>
                <a class="btn btn btn-outline-primary" href="logout.php" style="margin-left: 20px;">Uitloggen</a>
                <a href="logout.php" style="margin-right: 18px; padding-top: 10px">
                    <img src="imgs/persoon.png" height="60" width="60">
                </a>
        <?php
    } else {
        ?>
        <a class="btn btn btn-outline-primary" href="login.php" style="margin-left: 20px">Inloggen</a>
        <a href="login.php" style="margin-right: 10px">
            <img src="imgs/persoon.png" height="60" width="60">
        </a>
        <?php
    }
    ?>
    <a href="Winkelwagen.php" style="padding-bottom: 10px">
        <img class="winkelmand" src="imgs/winkelmand.png" height="60" width="60">
    </a>
</nav>
<div style="text-align: center; border-top: 2px solid white; background-color: #00AEEF;border-bottom: 1px solid white">
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
                echo("<button class='btn btn-outline-light btn-md' style='margin-top: 15px; margin-left: 5px; margin-right: 5px;' name='search' value='$categorie'>" . $categorie . "</button>");
            }
            ?>
        </form>
        <?php
        SluitVerbinding($conn);
        ?>
    </ul>
</div>
</body>
</html>
