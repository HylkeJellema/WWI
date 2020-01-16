<?php
    function kortingCheck($inputcode){


    include_once 'productfuncties.php';
    $con=MaakVerbinding();
        $sql = "SELECT code,discount FROM discount_codes";
        $zoekresultaten = mysqli_query($con, $sql);

        while($row = mysqli_fetch_array($zoekresultaten)){
            if ($row['code']==$inputcode){
                $korting=$row['discount'];
                return $korting;
            }
        }

    SluitVerbinding($con);
    }
?>