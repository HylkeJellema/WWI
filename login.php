<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <body>
        <div class="container">
            <div class="card">
                <div class="row">
                    <div class="inner">
                        <form action="loginVerwerk.php" method="post">
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