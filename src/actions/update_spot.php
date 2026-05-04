<?php


include("../config/connect.php");

$id_spot = $_POST['id_spot'];
$name = $_POST['name'];
$description = $_POST['description'];
$type = $_POST['type'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$picture = $_FILES['picture'];
$status = 1;

if ($name != "") {

    //Updates the spot fields on the spot table
    $sql_update = "UPDATE tourist_spot SET 
    name = '$name', 
    description = '$description',
    type = '$type',
    city = '$city',
    state = '$state',
    country = '$country',
    latitude = '$latitude',
    longitude = '$longitude',
    picture = '$picture',
    status = '$status'
    
    WHERE id_spot = $id_spot";

    mysqli_query($connect, $sql_update) or die("Erro ao inserir ponto");

    //Uploads the picture
    $picture = $_FILES['picture'];

    $filename = uniqid() . "_" . $picture['name'];
    $path = "../uploads/images/" . $filename;

    move_uploaded_file($picture['tmp_name'], $path);

    //Inserts the picture on the spot pictures table
    $sql2 = "INSERT INTO picture_spot (id_spot, picture)
    VALUES ('$id_spot', '$path')";

    mysqli_query($connect, $sql2) or die("Erro ao inserir imagem");

} else {
    echo "<script> window.alert('Operation denied!');
    window.location='user_register.php' </script>";
}


header("Location: ../pages/homepage.php");

?>