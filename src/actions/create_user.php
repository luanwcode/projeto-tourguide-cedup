<?php

    include("../config/connect.php");

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $status = 1;
    $role = 'user';


    $sql_insert = "INSERT INTO users (name, email, password, role, status)
    VALUES
    ('$name', '$email','$password','$role','$status')";

    if($name != "" & $email != ""){
        mysqli_query($connect, $sql_insert)
        or die("It wasn't possible to register the user");
    }else{
        echo"<script> window.alert('Operation denied!');
        window.location='user_register.php' </script>";
    }
    header("Location:../pages/login.php");
    
?>

