<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <title>Login</title>

</head>
    <style>
    body
    {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
	}

	a
	{
		text-decoration: none;
	}

    #video 
    {
        position: fixed;
        right: 0;
        bottom: 0;
        min-width: 100%;
        min-height: 100%;
    }
    
    .login
    {
        color: white;
        background-color: rgba(0,0,0, 0.7);
        box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);   
        border-radius: 25px;
        position: relative;
        text-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1);
    }

</style>

<body class="custom-bg-color">
    <video autoplay muted id="video">
        <source src="./media/bgvideo2.mp4" type="video/mp4">
    </video>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <!--Coluna vazia na esquerda-->
            </div>  
        <div class="col-sm-4">
            <div class="login text-center">
                <div class="container">
                    <br>
                    <!--<img src="./media/logotipo.png" class="img-fluid" width="200px">-->
                    <h1> T<i class="bi bi-compass"></i>URGUIDE</i></h1>

                    

                    <form name="login" method="post" action="../actions/login_user.php">
                        <input class="form-control" type="email" name="email" placeholder="exemple@gmail.com" required>
                        <br>
                        <input class="form-control" type="password" name="password" placeholder="Password_123" required>
                        <br> <br>
                        <input type="submit" class="btn custom-success-color" style="color:white;" value="Login">
                        <br><br>
                        <p style="color:white">Do not have an account? click <a href="homepage.php">here</a>!</p>
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