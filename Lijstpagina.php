
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="stylesheet" type="text/css" href="dropdownStyles.css">
    <link rel="stylesheet" type="text/css" href="bottomNAV.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<?php
include "NAVBar functie.php";
navigatiebalkje();
?>

<body>
<table id="Producten" align="center" width="60%">
    <form>
    <div class="col text-center">
    <div class="btn-group text-center" role="group" aria-label="ic example">
        <a type="button" class="btn btn-outline-primary btn-sm align-center" href="Lijstpagina.php?action=AtotZ">Alfabet A - Z</a>
        <a type="button" class="btn btn-outline-primary btn-sm align-center" href="Lijstpagina.php?action=ZtotA">Alfabet Z - A</a>
        <a type="button" class="btn btn-outline-primary btn-sm align-center" href="Lijstpagina.php?action=PLtotPH">Prijs L - H</a>
        <a type="button" class="btn btn-outline-primary btn-sm align-center" href="Lijstpagina.php?action=PHtotPL">Right H - L</a>
    </div>
    </form>
    <br>
    <br>
    <?php
        if(isset($_GET['action'])) {
            if (isset($_GET['action']) == 'ZtotA') {
                ZtotA();
            }
            if (isset($_GET['action']) == 'PLtotPH') {
                PLtotPH();
            }
            if (isset($_GET['action']) == 'PHtotPL') {
                PHtotPL();
            }
            if (isset($_GET['action']) == 'AtotZ') {
                AtotZ();
            } else {
                AtotZ();
            }
        } else{
            AtotZ();
        }
    ?>
    </div>
</table>
</body>
<br><br>
<?php
include "bottomFunctie.php";
bottomFunctie();
?>


</html>
