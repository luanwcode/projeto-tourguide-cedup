<?php 

    $email = $_POST['email'];

    $sql_verify_email = "SELECT id_user FROM users WHERE email = ?";]
    $stmt = $conn->prepare($sql_verify_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get-result();

    echo $result->num_rows > 0? "1" : "0";

?>