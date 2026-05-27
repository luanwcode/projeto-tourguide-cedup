<?php 

    include("../config/connect.php");

    $userName = $_POST['userName'];
    $comment = $_POST['comment'];
    $id_spot = $_POST['id_spot'];

    if ($userName != ""){
        $sql = "INSERT INTO comment_spot (id_spot, name_user, comment) 
        VALUES ('$id_spot', '$userName', '$comment')";
        
        mysqli_query($connect, $sql) or die ("Error when posting comment");
    }

    header("Location: ../pages/spot.php?spot= $id_spot");
?>