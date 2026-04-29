<?php

//Testing
include("../config/connect.php");

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

    //Insert the spot on the spot table
    $sql = "INSERT INTO tourist_spot (name, description, type, city, state, country, latitude, longitude, status)
    VALUES ('$name', '$description','$type','$city','$state','$country','$latitude','$longitude','$status')";

    mysqli_query($connect, $sql) or die("Erro ao inserir ponto");

    //Gets the id
    $id_spot = $connect->insert_id;

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