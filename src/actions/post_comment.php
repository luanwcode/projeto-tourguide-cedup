<?php 

    include("../config/connect.php");

    $userId = $_POST['userId'];
    $comment = $_POST['comment'];
    $id_spot = $_POST['id_spot'];

    if ($userId != ""){
        $sql = "INSERT INTO comment_spot (id_spot, id_user, comment) 
        VALUES ('$id_spot', '$userId', '$comment')";
        
        mysqli_query($connect, $sql) or die ("Error when posting comment");
    }

    header("Location: ../pages/spot.php?spot= $id_spot");
?>