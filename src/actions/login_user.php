<?php

    session_start();
    require_once("../config/connect.php");


    //Validates the entries
    if(!isset($_POST['email']) || !isset($_POST['password'])) {
        die("Invalid data");
    }

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    //Searches for the user
    $sql = "SELECT id_user, email, name, password, role FROM users WHERE email = ?";
    $stmt = $connect->prepare($sql);

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    //Verifies if the user exists
    if(!$user){
        die("Incorrect email or password");
    }

    if(!password_verify($password, $user['password'])){
        die("Incorrect email or password");
    }

    //Creates a session for the user
    $_SESSION['id'] = $user['id_user'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];

    header("Location:../pages/homepage.php");
    exit();
    

    /*
    $email = $_POST[email];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $hash = $row['password'];

    $sql = "SELECT id_user, name, email, role FROM users WHERE email = $email AND password = $password AND status = 1";

    $cons_login = mysqli_query($connect, $sql);
    $count = mysqli_num_rows($cons_login);

    if($count > 0){
        while($user = mysqli_fetch_assoc($cons_login)){
            $_SESSION['id'] = $user['id_user'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
        }
        header("Location:../homepage.php");
    }else{
        $_SESSION['msg_error'] =
        '<div class="alert-danger alert-dissmissible fade show" role="alert">
        Login inválido! Usuário ou senha incorretos.
        <button type="button" class="btn-close" data-bs-dismiss+"alert" aria-label="Close</button> </div>';

        header("Location:login.php");
    }
    */
?>