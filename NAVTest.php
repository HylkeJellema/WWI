

<html>
<link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="stylesheet" type="text/css" href="dropdownStyles.css">
    <link rel="stylesheet" type="text/css" href="NAVTest.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</html>

     <!-- NAVBAR -->


        <!--
                <a href="Login.php">
                    Login
                </a>
        -->


        <!-- <a href="detect.php">
                <img class="winkelmand" src="imgs/cam.png" height="75" width="60">
        </a> -->



        <link rel="stylesheet" type="text/css" href="dropdownStyles.css">
        <nav>
            <ul>
                <li><a class="Home" href="Homepagina.php">Home</a></li>
                <?php
                include 'categorieTest.php';
                categorieLijst();
?>
                <li><a class="Login" href="Login.php">Inloggen</a></li>


                <li>
            </ul>


        </nav>

        <br>

