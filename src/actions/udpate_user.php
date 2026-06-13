<?php


include("../config/connect.php");

$id_user = $_POST['id_user'];
$name = $_POST['name'];
$picture = $_FILES['picture'];
$id_picture = $_POST['id_picture'];
$status = 1;

if ($name != "") {

    //Updates the spot fields on the spot table
    $sql_update = "UPDATE tourist_spot SET 
    name = '$name', 
    description = '$description',
    status = '$status'
    WHERE id_user= $id_user";


    mysqli_query($connect, $sql_update) or die("Error while editing your profile");


    $sql_verify = "SELECT picture FROM user WHERE id_user = $id_user";

    

    if(isset($_FILES['picture']) && $_FILES['picture']['error'] == 0){

        $id_picture = $_POST['id_picture'];
        $id_spot = $_POST['id_spot'];

        $sql_old_picture = "SELECT picture FROM users WHERE id_user = $id_user";
        $result = $connect->query($sql_old_picture);
        
        if($row = mysqli_fetch_assoc($result)){
            
            $old_picture = $row['picture'];

            //Deletes the file
            if(file_exists($old_picture)){
                unlink($old_picture);
            }

            //Deletes from the database
            $connect->query("DELETE picture FROM users WHERE id_user = $id_user");
        }

        //Uploads the new picture
        $picture = $_FILES['picture'];

        $filename = uniqid() . "_" . $picture['name'];
        $path = "../uploads/profile_pictures/" . $filename;

        move_uploaded_file($picture['tmp_name'], $path);

        //Inserts the picture on the spot pictures table
        $sql2 = "INSERT INTO users (picture)
        VALUES ('$picture')";

        mysqli_query($connect, $sql2) or die("Error while editing your profile");
    }

} else {
    echo "<script> window.alert('Operation denied!');
    window.location='user_register.php' </script>";
}

header("Location: ../pages/profile.php?user=profile");
exit;

?>