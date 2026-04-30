<?php
    session_start();
    include('../config/connect.php');
    
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        die("Access denied!");
    }

    $userRole = $_SESSION['role'];
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
    <link rel="stylesheet" href="../assets/css/spot_register.css">
    <title>Login</title>
</head>

<body>
    <div class="layout">
        <aside>
            <?php
                include("../includes/fonts.php");
                include("../includes/sidebar.php");
            ?>
        </aside>
        
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <!-- Empty left column -->
                </div>
                <div class="col-sm-6">
                    <div class="spotRegister text-center">
                        <div class="container">
                            <br>
                            <h1> <b> SP<i class="bi bi-compass"></i>T REGISTER</i> </b> </h1>

                            <div class="content" style="padding: 10px">

                                <br>

                                <form class="client_register" method="post" action="../actions/create_spot.php"
                                    enctype="multipart/form-data">

                                    <div class="row">

                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="name" class="form-control" id="floatingInput"
                                                    placeholder="name@example.com">
                                                <label for="floatingInput">Name</label>
                                            </div>
                                        </div>

                                        <div class="col-6">
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
                                                <input type="text" name="description" class="form-control"
                                                    id="floatingInput" placeholder="name@example.com" autocomplete="off">
                                                <label for="floatingInput">Description</label>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="city" class="form-control" id="floatingInput"
                                                    placeholder="name@example.com">
                                                <label for="floatingInput">City</label>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="state" class="form-control" id="floatingInput"
                                                    placeholder="name@example.com">
                                                <label for="floatingInput">State</label>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="country" class="form-control" id="floatingInput"
                                                    placeholder="name@example.com">
                                                <label for="floatingInput">Country</label>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="latitude" class="form-control" id="floatingInput"
                                                    placeholder="name@example.com">
                                                <label for="floatingInput">Latitude</label>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="longitude" class="form-control" id="floatingInput"
                                                    placeholder="name@example.com">
                                                <label for="floatingInput">Longitude</label>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <!-- Empty col to centralize the preview -->
                                        </div>
                                        <div class="col-6">
                                            <div class="uploadPreview">
                                                <img id="preview" src="../assets/media/preview.png" alt="Image Preview">
                                            </div>
                                            <br>
                                        </div>

                                        <div class="col-3">
                                            <!-- Empty col to centralize the preview -->
                                        </div>

                                        <div class="col-12">
                                            <label class="uploadBtn">
                                                <i class="bi bi-upload"></i>
                                                <input type="file" id="fileInput" name="picture" accept="image/*">
                                            </label>
                                        </div>

                                        <br><br><br>

                                        <div class="col-12">
                                            <button type="input" class="btn custom-blue">Register spot</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <!-- Empty right column -->
                </div>
            </div>
        </div>
    </div>

    <script>
        const input = document.getElementById('fileInput');
        const preview = document.getElementById('preview');

        let currentURL = null;

        input.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;

            if (!file.type.startsWith('image/')) {
                alert('Invalid file');
                return;
            }

            // limpa URL anterior
            if (currentURL) {
                URL.revokeObjectURL(currentURL);
            }

            currentURL = URL.createObjectURL(file);

            preview.src = currentURL;
            preview.style.display = 'block';
        });
    </script>


</body>

</html>