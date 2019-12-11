<?php
include ("init.php");

?>
<html>
<header>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="stylesheet" type="text/css" href="NAVTest.css">

</header>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-light" style="padding-bottom: 15px">
    <a href="Homepagina.php" style="padding-right: 20px">
        <img class="logo" src="imgs/wide-world-importers-logo-small.png" height="60">

    </a>
        <form class="navbar-nav mr-auto" action="Lijstpagina.php?" style="padding-top: 18px">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    <?php
    if (logged_in() == true) {
        $session_user_id = $_SESSION['user_id'];
        $user_data = user_data($con, $session_user_id);
        ?>
                <a class="span" style="padding-top: 18px">Hello, <?php echo $user_data['first_name']?>!</a>
                <a class="btn btn-lg btn-outline-primary" href="logout.php" style="margin-left: 20px; margin-top: 18px">Log uit</a>
                <a href="logout.php" style="margin-right: 18px; padding-top: 18px">
                    <img src="imgs/persoon.png" height="60" width="60">
                </a>
        <?php
    } else {
        ?>
        <a class="btn btn-lg btn-outline-primary" href="login.php" style="margin-left: 20px; margin-top: 18px">Login</a>
        <a href="login.php" style="margin-right: 10px; padding-top: 18px">
            <img src="imgs/persoon.png" height="60" width="60">
        </a>
        <?php
    }
    ?>
    <a href="Winkelwagen.php">
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
