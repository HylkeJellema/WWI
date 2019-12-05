<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="card">
                <div class="row">
                    <div class="inner">
                        <form action="loginVerwerk.php" method="post">
                            <ul id="login">
                                <li>
                                    Username:
                                    <input type="text" name="username">
                                </li>
                                <li>
                                    Password:
                                    <input type="password" name="password">
                                </li>
                                <li>
                                    <input type="submit" value="Log in">
                                </li>
                                <li>
                                    <a href="register.php">Register</a>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>