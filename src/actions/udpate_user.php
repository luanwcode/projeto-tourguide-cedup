<?php


include("../config/connect.php");

$id_user = $_POST['id_user'];
$name = $_POST['name'];
$description = $_POST['description'];
$picture = $_FILES['picture'];
$id_picture = $_POST['id_picture'];
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
    status = '$status'
    WHERE id_spot = $id_spot";


    mysqli_query($connect, $sql_update) or die("Error while inserting a spot");


    $sql_verify = "SELECT picture FROM picture_spot WHERE id_picture = $id_picture";

    

    if(isset($_FILES['picture']) && $_FILES['picture']['error'] == 0){

        $id_picture = $_POST['id_picture'];
        $id_spot = $_POST['id_spot'];

        $sql_old_picture = "SELECT * FROM picture_spot WHERE id_picture = $id_picture";
        $result = $connect->query($sql_old_picture);
        
        if($row = mysqli_fetch_assoc($result)){
            
            $old_picture = $row['picture'];

            //Deletes the file
            if(file_exists($old_picture)){
                unlink($old_picture);
            }

            //Deletes from the database
            $connect->query("DELETE FROM picture_spot WHERE id_picture = $id_picture");
        }

        //Uploads the new picture
        $picture = $_FILES['picture'];

        $filename = uniqid() . "_" . $picture['name'];
        $path = "../uploads/images/" . $filename;

        move_uploaded_file($picture['tmp_name'], $path);

        //Inserts the picture on the spot pictures table
        $sql2 = "INSERT INTO picture_spot (id_spot, picture)
        VALUES ('$id_spot', '$path')";

        mysqli_query($connect, $sql2) or die("Erro ao inserir imagem");
    }

} else {
    echo "<script> window.alert('Operation denied!');
    window.location='user_register.php' </script>";
}

header("Location: ../pages/spot_edit.php?spot=".$id_spot);
exit;

?>