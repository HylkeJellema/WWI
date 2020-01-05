<?php
include 'init.php';

$con = MaakVerbinding();

if (empty($_POST) == false) { //kijkt of er op de login knop is geklikt
    $username = $_POST['username'];
    $username = mysqli_real_escape_string($con, $username);
    $password = $_POST['password'];
    $password = mysqli_real_escape_string($con, $password);

    if (empty($username) === true || empty($password) == true) { //kijkt of velden zijn leeggelaten
        $errors[] = 'You need to enter a username and password';
    } elseif (user_exists($con, $username) == false) { //kijkt of de username bestaat
        $errors[] = 'We can\'t find that username. Have you registered? ';
    } elseif (user_active($con, $username) == false) { //kijkt of een gebruiker actief is
        $errors[] = 'You haven\'t activated your account!';
    } else {

        if (strlen($password) > 32) { //kijkt of wachtwoord niet langer is dan 32 tekens
            $errors[] = 'Password is too long';
        }

        $login = login($con, $username, $password);

        if ($login == false) { //kijkt of login gegevens correct zijn
            $errors[] = 'That username/password combination is incorrect';
        } else {
            $_SESSION['user_id'] = $login;
            header("location: Homepagina.php");
            exit();
        }

    }
    
} else {
    $errors[] = 'No data received';
}

if (empty($errors) == false) {
?>
    <h2>We tried to log you in, but....</h2>
<?php
    echo output_errors($errors);
}
?>
