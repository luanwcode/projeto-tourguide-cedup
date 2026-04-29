<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/login.css">
    <title>Login</title>
</head>

<body>
    <?php
        include("../includes/fonts.php");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <!--Coluna vazia na esquerda-->
            </div>  
        <div class="col-sm-4">
            <div class="login text-center">
                <div class="container">
                    <br>
                    <h1> <b> T<i class="bi bi-compass"></i>URGUIDE</i> </b> </h1>

                    

                    <form name="login" method="post" action="../actions/login_user.php">
                        <input class="form-control" type="email" name="email" placeholder="exemple@gmail.com" required>
                        <br>
                        <input class="form-control" type="password" name="password" placeholder="Password_123" required>
                        <br> <br>
                        <input type="submit" class="btn custom-blue" style="color:white;" value="Login">
                        <br><br>
                        <p style="color:white">Do not have an account? click <b><a href="user_register.php" style="color: #429fc7">here</a></b>!</p>
                        <p style="color:white">Or log-in as a <b><a href="homepage.php" style="color: #429fc7">guest</a></b></p>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm4">
            <!--Coluna vazia na direita-->
        </div>
    </div>


</body>
</html>