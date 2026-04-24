<?php
    session_start();
    include("../config/connect.php");

    $userRole = $_SESSION['role'];
    $spotId = $_REQUEST['spot'];

    if($userRole != 'admin'){
        echo'ACCESS DENIED!';
    }

    $sql_query = "SELECT t.id_spot, t.name, t.city, t.state, t.country, t.type, t.latitude, t.longitude, MIN(p.picture) as picture FROM tourist_spot t LEFT JOIN picture_spot p ON t.id_spot = p.id_spot GROUP BY t.id_spot, t.name, t.city, t.state, t.country";
    $query = mysqli_query($connect, $sql_query);
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <title>Edit spot</title>

</head>

<body class="custom-bg-color">

    <div class="content" style="padding: 20px">

        <h1 class="custom-success-txt-color"> Edit spot </h1>

        <br>

        <?php
            while($row = mysqli_fetch_assoc($query))
            {
        ?>

        <form class="client_register" method="post" action="../actions/update_spot.php" enctype="multipart/form-data">

            <div class="row">

                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="floatingInput"
                            placeholder="name@example.com" value="<?php echo $row['name']; ?>">
                        <label for="floatingInput">Name</label>
                    </div>
                </div>

                <div class="col-8">
                    <div class="form-floating mb-3">
                        <input type="text" name="description" class="form-control" id="floatingInput"
                            placeholder="name@example.com" value="<?php echo $row['description']; ?>" autocomplete="off">
                        <label for="floatingInput">Description</label>
                    </div>
                </div>

                <div class="col-3">
                    <div class="form-floating mb-3">
                            <select class="form-select" name="type" id="type">
								<option selected>Select the spot type</option>
								<option value="Natural">Natural</option>
                                <option value="Cultural">Cultural</option>
                                <option value="Entertainement">Entertainement</option>
                                <option value="Religious">Religious</option>
							</select>
						<label for="floatingSelect">Type</label>
                    </div>       
                </div>

                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" name="city" class="form-control" id="floatingInput"
                            placeholder="name@example.com" value="<?php echo $row['city']; ?>">
                        <label for="floatingInput">City</label>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" name="state" class="form-control" id="floatingInput"
                            placeholder="name@example.com" value="<?php echo $row['state']; ?>">
                        <label for="floatingInput">State</label>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" name="country" class="form-control" id="floatingInput"
                            placeholder="name@example.com" value="<?php echo $row['country']; ?>">
                        <label for="floatingInput">Country</label>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" name="latitude" class="form-control" id="floatingInput"
                            placeholder="name@example.com" value="<?php echo $row['latitude']; ?>">
                        <label for="floatingInput">Latitude</label>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" name="longitude" class="form-control" id="floatingInput"
                            placeholder="name@example.com" value="<?php echo $row['longitude']; ?>">
                        <label for="floatingInput">Longitude</label>
                    </div>
                </div>

                <input type="file" id="picture" name="picture" accept="image/*">
                <img id="previewImage" src="" alt="Image Preview" style="width: 200px; height: auto;">

                <div class="col-12">
                    <button type="input" class="btn btn-success">Resgiter spot</button>
                </div>

            </div>
        </form>
        <?php
            }
        ?>
    </div>
    
</body>

</html>