<?php 
    session_start();
    
    function createGuestSession(): void{
        $_SESSION['role'] = 'guest';
        $_SESSION['name'] = 'Guest';
        $_SESSION['picture'] = null;
    }

    function createUserSession($user){
        $_SESSION['id'] = $user['id_user'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['picture'] = $user['picture'];
    }
?>