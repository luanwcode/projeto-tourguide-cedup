<?php


include("../config/connect.php");

$id_user = $_POST['id_user'];
$name = $_POST['name'];
$pictureInput = $_FILES['pictureInput'];
$picture = $_FILES['pictureInput']['name'];
$status = 1;

echo "\n", $picture;
if ($name != "") {

    //Updates the user fields on the user table
    $sql_update = "UPDATE users SET 
    name = '$name', 
    status = '$status'
    WHERE id_user= $id_user";


    mysqli_query($connect, $sql_update) or die("Error while editing your profile");


    $sql_verify = "SELECT picture FROM user WHERE id_user = $id_user";

    if(isset($_FILES['pictureInput']) && $_FILES['pictureInput']['error'] == 0){

        /*
        $sql_old_picture = "SELECT picture FROM users WHERE id_user = $id_user";
        $result = $connect->query($sql_old_picture);
        
        $row = mysqli_fetch_assoc($result);
            
        $old_picture = $row['picture'];
        */

        $sql_old_pfp = "SELECT picture FROM users WHERE id_user = $id_user";

        //Deletes the file
        if(file_exists($sql_old_pfp)){
            unlink($sql_old_pfp);
        }

        //Overwrites the old picture path inserting the new one
        $connect->query("UPDATE users SET picture = '$picture' WHERE id_user = $id_user");

        $filename = uniqid() . "_" . $_FILES['pictureInput']['name'];
        $path = "../uploads/profile_pictures/" . $filename;

        move_uploaded_file($_FILES['pictureInput']['tmp_name'], $path);
    }

} else {
    echo "<script> window.alert('Operation denied!');
    window.location='user_register.php' </script>";
}

header("Location: profile.php?user=profile");
exit;

?>