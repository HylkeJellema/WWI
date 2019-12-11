<?php
include_once 'header.php';
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
}
?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="Style.css">
        <link rel="stylesheet" type="text/css" href="dropdownStyles.css">

    <body>
        <div class="container">
            <div class="card" style="padding-left: 20px; margin-top: 10px">
                <br>
                <h1>Login</h1>
                <div class="row">
                    <div class="inner">
                            <?php
                            if (empty($errors) == false) {
                                ?>
                                <br>
                                We tried to log you in, but....
                                <?php
                                echo output_errors($errors);
                            }
                            ?>
                        <form action="login.php" method="post">
                            <ul id="login">
                                <div class="col-md-5"> <br>
                                    Username
                                    <input type="text" name="username">
                                    <br><br>
                                </div>
                                <div class="col-md-5">
                                    Password
                                    <input type="password" name="password">
                                    <br><br>
                                </div>
                                <div class="col-md-5">
                                    <input class="btn btn-outline-secondary" type="submit" value="Log in   ">
                                    <br><br>
                                </div>
                                <div class="col-md-5">
                                    <a class="btn btn-outline-primary" href="register.php">Register</a>
                                </div>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>