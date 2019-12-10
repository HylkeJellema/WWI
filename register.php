<?php
include 'init.php';

if (empty($_POST) == false) {
    $required_fields = array('username', 'password', 'password_again', 'first_name', 'email');
    foreach($_POST as $key => $value){
        if(empty($value) && in_array($key, $required_fields) == true){
            $errors[] = 'Fields marked with an asterisk are required';
            break 1;
        }
    }

    if (empty($errors) == true){
        if(user_exists($con, $_POST['username']) == true){
            $errors[] = 'Sorry, the username \'' . $_POST['username'] . '\' is already taken.';
        }
        if(preg_match("/\\s/", $_POST['username']) == true){
            $errors[] = 'Your username must not contain any spaces.';
        }
        if(strlen($_POST['password']) < 9){
            $errors[] = 'Your password must be at least 8 characters.';
        }
        if($_POST['password'] !== $_POST['password_again']){
            $errors[] = 'Your passwords do not match.';
        }
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
            $errors[] = 'A valid email address is required';
        }
        if(email_exists($con, $_POST['email']) == true) {
            $errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already in use.';
        }
    }
}

include 'NAVTest.php';

?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>

    <?php
    waza();
    ?>
    <div class="container">
        <div class="card" style="padding-left: 40px">
            <h1>Register</h1>
            <?php
            if (isset($_GET['succes']) && empty($_GET['succes'])) {
               echo 'You\'ve been registered succesfully!';
               ?>
            <div>
                <br>
                <a class='btn btn-lg btn-light align-center' style="background: lightskyblue" href="login.php">Inloggen</a>
            </div>

            <?php
            } else {
            if (empty($_POST) == false && empty($errors) == true) {
                $regiser_data = array(
                    'username' => $_POST['username'],
                    'password' => md5($_POST['password']),
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'email' => $_POST['email'],
                );

                register_user($con, $regiser_data);
                header('Location: register.php?succes');
                exit();

            } elseif (empty($errors) == false) {
                echo output_errors($errors);
            }

            ?>
            <div class="row">
                <div class="inner">
                    <form action="" method="post">
                        <ul>
                            <li>
                                Username*:<br>
                                <input type="text" name="username">
                            </li>
                            <li>
                                Password*:<br>
                                <input type="password" name="password">
                            </li>

                            <li>
                                Password again*:<br>
                                <input type="password" name="password_again">
                            </li>
                            <li>
                                First name*:<br>
                                <input type="text" name="first_name">
                            </li>
                            <li>
                                Last name:<br>
                                <input type="text" name="last_name">
                            </li>
                            <li>
                                Email*:<br>
                                <input type="text" name="email">
                            </li>
                            <br>
                            <li>
                                <input type="submit" value="Register">
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
    <?php
    }
    ?>
</html>