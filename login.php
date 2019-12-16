<?php
include_once 'header.php';
$con = MaakVerbinding();
if (empty($_POST) == false) {
    $username = $_POST['username'];
    $username = mysqli_real_escape_string($con, $username);
    $password = $_POST['password'];
    $password = mysqli_real_escape_string($con, $password);

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
            logged_in_redirect();
            exit();
        }

    }
}
?>
<html>
<head></head>

    <body>
        <div class="container">
            <div class="card" style="padding-left: 20px; margin-top: 10px">
                <br>
                <h1>Inloggen</h1>
                <div class="row">
                    <div class="inner">
                            <?php
                            if (empty($errors) == false) {
                                ?>
                                <br>
                                We hebben geprobeerd je in te loggen, maar....
                                <?php
                                echo output_errors($errors);
                            }
                            ?>
                        <form action="login.php" method="post">
                            <ul id="login">
                                <div class="col-md-5" style="width:22rem"> <br>
                                    Gebruikersnaam
                                    <input type="text" name="username">
                                    <br><br>
                                </div>
                                <div class="col-md-5">
                                    Wachtwoord
                                    <input type="password" name="password">
                                    <br><br>
                                </div>
                                <div class="col-md-5">
                                    <input class="btn btn-outline-secondary" type="submit" value="Log in   ">
                                    <br><br>
                                </div>
                                <div class="col-md-5">
                                    <a class="btn btn-lg btn-outline-primary text-uppercase" href="register.php">Register</a>
                                </div>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>