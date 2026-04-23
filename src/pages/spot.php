<?php
session_start();
include("../config/connect.php");

$spot = $_REQUEST['spot'];
$userRole = $_SESSION['role'] ?? null;

$sql_query = "SELECT t.id_spot, t.name, t.city, t.state, t.country, t.description, t.latitude, t.longitude, MIN(p.picture) as picture FROM tourist_spot t LEFT JOIN picture_spot p ON t.id_spot = p.id_spot WHERE t.id_spot = $spot GROUP BY t.id_spot, t.name, t.city, t.state, t.country";
$query = mysqli_query($connect, $sql_query);

if (!$query) {
    die("Bugou porra: " . mysqli_error($connect));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/spot.css" rel="stylesheet">
    <title>Produto</title>

</head>

<body>
    <?php
    include("../includes/fonts.php");
    include("../includes/sidebar.php")
        ?>

    <div class="container">

        <?php while ($row = mysqli_fetch_assoc($query)) {
            ?>
            <div class="spot">

                <!-- ESQUERDA - IMAGEM -->
                <div class="image-section">
                    <img src=<?php echo ' ' . $row['picture'] . ' '; ?> alt="Produto">
                </div>
                <!-- DIREITA - INFORMAÇÕES -->
                <div class="info-section">

                    <div class="spot-title">
                        <?php echo $row['name']; ?>

                        <?php if($userRole === 'admin'){
                            echo'
                                <a href="spot_edit.php" style="vertical-align: middle; color: black;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                </a>
                            ';
                            }
                        ?>
                    </div>

                    <div class="description">
                        <?php echo $row['description']; ?>
                    </div>

                    <div class="coordinates">
                        Coordinates: <?php echo $row['latitude'], '   ', $row['longitude']; ?>
                    </div>

                    <div class="maps-location">
                        <h2>Location</h2>

                        <?php
                        $lat = $row['latitude'];
                        $lon = $row['longitude'];
                        ?>

                        <iframe width=420" height="240" style="border:0;" loading="lazy" allowfullscreen
                            src="https://www.google.com/maps?q=<?php echo $row['latitude'] . ',' . $row['longitude']; ?>&hl=pt-BR&z=15&output=embed">
                        </iframe>
                    </div>

                </div>

            </div>
        <?php } ?>
    </div>

</body>

</html>