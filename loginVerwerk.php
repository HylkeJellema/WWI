<?php
include 'init.php';

$con = MaakVerbinding();

if (empty($_POST) == false) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) === true || empty($password) == true) {
        $errors[] = 'You need to enter a username and password';
    } elseif (user_exists($con, $username) == false) {
        $errors[] = 'We can\'t find that username. Have you registered? ';
    } elseif (user_active($con, $username) == false) {
        $errors[] = 'You haven\'t activated your account!';
    } else {

        if (strlen($password) > 32) {
            $errors[] = 'Password is too long';
        }

        $login = login($con, $username, $password);

        if ($login == false) {
            $errors[] = 'That username/password combination is incorrect';
        } else {
            $_SESSION['user_id'] = $login;
            header("location: Homepagina.php");
            exit();
        }

    }
<<<<<<< Updated upstream

    print_r($errors);
=======
} else {
    $errors[] = 'No data received';
>>>>>>> Stashed changes
}

if (empty($errors) == false) {
?>
    <h2>We tried to log you in, but....</h2>
<?php
    echo output_errors($errors);
}
?>
