<?php
include_once 'header.php'; //betrekt header.php
login_check();
$con = MaakVerbinding();

?>

<!DOCTYPE html>
<html lang="nl">
    <head>
        <title>
            WWI de internationale groothandel
        </title>
        <link rel="stylesheet" type="text/css" href="Style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>
    <body>
    <div class="container-fluid bg-wwi" >
            <div class="container rounded">
                <div class="card">
                    <div class="card-body">


                <?php
                //wanneer de winkelwagen niet leeg is laat hij de producten zien
                if (!empty($_SESSION['cart'])) {
                    ?>
                    <div style="clear:both"></div>
                    <br/>
                    <div class="table-responsive">
                        <table class="table">
                            <h1 style="text-align: center">Dit is je bestelling</h1>

                            <thead>
                            <tr>
                                <th scope="col">Product naam</th>
                                <th scope="col">Hoeveelheid</th>
                                <th scope="col">Prijs</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $total = 0;
                            // laat gegevens zien van winkelwagen producten vanuit array
                            foreach ($_SESSION['cart'] as $key => $value) {
                                                                ?>
                                <tr>
                                    <form action="Winkelwagen.php" method="post">

                                        <td><?php echo $value['name']; ?></td>
                                        <td><?php echo $value['aantal']?></td>
                                        <td>€<?php echo round(($value['price'] * $omrekenWaarde), 2); ?></td>

                                        <td>

                                            <input type="hidden" value="<?php echo $value['id'] ?>" name="updateID">
                                        </td>


                                    </form>
                                </tr>

                                <?php
                            
                               $total = $total + ( $value['aantal'] * round(($value['price'] * $omrekenWaarde), 2));
                            }

                            ?>
                         
                            <tr>
                                <td>
                                    </td>
                                    <td style="text-align: right;">Totaal (Ex: BTW):</td>
                                <td style="text-align: left;"><?php print("€" . round(($total-($total*0.21)),2));?></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            <tr>
                                <td>
                                    </td>
                                    <td style="text-align: right;">BTW:</td>
                                <td style="text-align: left;"><?php print("€" . ($total-(round(($total-($total*0.21)),2))));?></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                <td>
                                    </td>
                                    <td style="text-align: right;">Totaal:</td>
                                <td style="text-align: left;"><?php print("€" . $total);?></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <?php
                }



                         if (empty($_SESSION['cart'])) {
                            ?>
                            <div style='padding-top: 200px;'>
                                <h1 style="text-align: center">Winkelwagen is leeg</h1></div>
                                <div style="padding-top: 100px; padding-bottom: 100px;"><a href=''
                                                                                           style='padding-bottom: 100px'>
                                        <div class="col text-center">
                                            <a class='btn btn-lg btn-light text-uppercase align-center' style="background: lightskyblue" href="Lijstpagina.php?">Verder winkelen</a>
                                        </div>
                            </div>
                            <?php
                        }else{
                             ?>
                            <caption><a class="btn btn-primary float-right" href=<?php print("betalen.php?bedrag=". $total)?>>Door naar betalen</a></caption>


                        <?php
                            }
                        ?>
                    </table>
                    </div>
                </div>

            </div>
            </div>
        </div>
    </body>
    </div>
    </div>
<?php //include __DIR__ . '/includes/footer.php'; ?>

</body>
    <br><br>
<?php

SluitVerbinding($con);
?>


</html>
