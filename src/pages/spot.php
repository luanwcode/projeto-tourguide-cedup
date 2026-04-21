<?php
    session_start();
    include("../config/connect.php");

    $spot = $_REQUEST['spot'];
    

    $sql_query = "SELECT t.id_spot, t.name, t.city, t.state, t.country, t.description, t.latitude, t.longitude, MIN(p.picture) as picture FROM tourist_spot t LEFT JOIN picture_spot p ON t.id_spot = p.id_spot WHERE t.id_spot = $spot GROUP BY t.id_spot, t.name, t.city, t.state, t.country";
    $query = mysqli_query($connect, $sql_query);

    if(!$query){
        die("Bugou porra: ". mysqli_error($connect));
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

        <?php while($row = mysqli_fetch_assoc($query))
            {
        ?>
            <div class="product">

                <!-- ESQUERDA - IMAGEM -->
                <div class="image-section">
                    <img src= <?php echo' '.$row['picture'].' '; ?> alt="Produto">
                </div>
                <!-- DIREITA - INFORMAÇÕES -->
                <div class="info-section">

                    <div class="product-title">
                        <?php echo $row['name']; ?>
                    </div>

                    <div class="description">
                        <?php echo $row['description']; ?>
                    </div>

                    <div class="coordinates">
                        <?php echo $row['latitude'], $row['longitude']; ?>
                    </div>
                </div>

            </div>
        <?php } ?>
    </div>

</body>
</html>