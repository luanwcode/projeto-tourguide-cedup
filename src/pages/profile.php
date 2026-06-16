<?php 

    //Connecting to the database to update the user register
    session_start();
    include("../config/connect.php");
    

    $user = $_GET['user'];
    $role = $_SESSION['role'];

    /*
    The first IF verifies if the user accessing the 'edit' page is an admin
    if so, he will access his own ID via the 'form=profile' or another user ID
    using the id that is in the url. Non admin users can only access their on ID
    independent of the ID value that they insert on the URL
    */
    if($role === 'admin'){

        if ($user == 'profile') {
            $id_user = $_SESSION['id'];
        }else{
            $id_user = $_REQUEST['form'];
        }

    }else{
        $id_user = $_SESSION['id'];
    }
    
    $sql_query = "SELECT * FROM users WHERE id_user = $id_user";
    $query = mysqli_query($connect, $sql_query);

    //If there is any error this will be printed on screen
    if(!$query){
        die("Query error: " . mysqli_error($connect));
    }
    

?>
<!DOCTYPE html>

<html lang="en-us">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../assets/css/profile.css">
        <link rel="stylesheet" href="./styles/stylesgeneral/stylesgeneral.scss">

        <title>Edit profile</title>

    </head>

    <body class="custom-bg-color">
        
        
        <div class="layout">


            <?php
                while($show = mysqli_fetch_assoc($query))
                {
            ?>

            <aside>
                <?php include '../includes/sidebar.php'; ?>
                <?php include '../includes/fonts.php'; ?>
            </aside>

            <div class="container">
                <h1 class="custom-success-txt-color" style="padding:10px;">  
                    Edit profile
			    </h1>

                <form class="edit_user" method="post" action="teste.php">

                    <div class="row">
                        <div class="col-3">
                            <div class="profile-container">
                                <img
                                    id="profileImage"
                                    src="../assets/media/default_pfp.png"
                                    alt="Profile picture"
                                    class="profile-image"
                                >

                                <div class="overlay" id="uploadButton">
                                    <i class="bi bi-upload"></i>
                                </div>

                                <input
                                    type="file"
                                    id="fileInput"
                                    accept="image/*"
                                    hidden
                                >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo $show['name']; ?>" >
                                <label for="floatingInput">Name</label>
                            </div>     
                            
                            <div class="col-12">
                                <input type="submit" class="btn btn-save-changes" style="color:white;"value="Save changes">
                            </div>
                        </div>
                    
                    </div>
    
                    <script>

                        //Função para verificar a força da senha
                        function checkPasswordStrength(password) {
                            let strength = 0;
                            let feedback = [];
                            
                            //Critérios de avaliação
                            if (password.length >= 8) strength += 1;
                            else feedback.push("8 caracters minimun");
                            
                            if (/[a-z]/.test(password)) strength += 1;
                            else feedback.push("Downcase letters");
                            
                            if (/[A-Z]/.test(password)) strength += 1;
                            else feedback.push("Uppercase letters");
                            
                            if (/[0-9]/.test(password)) strength += 1;
                            else feedback.push("Numbers");
                            
                            if (/[^A-Za-z0-9]/.test(password)) strength += 1;
                            else feedback.push("Special caracters");
                            
                            //Determinar a força
                            const strengthBar = document.getElementById('passwordStrengthBar');
                            const strengthText = document.getElementById('passwordStrengthText');
                            
                            let strengthClass = '';
                            let strengthMessage = '';
                            let strengthDescription = '';
                            
                            if (password.length === 0) {
                                strengthClass = '';
                                strengthMessage = '';
                                strengthDescription = '';
                                strengthBar.className = 'password-strength';
                                strengthBar.style.width = '0%';
                            } else if (strength <= 2) {
                                strengthClass = 'strength-weak';
                                strengthMessage = 'Weak';
                                strengthDescription = 'Password too vulnerable';
                                feedback = ["Add: " + feedback.slice(0, 3).join(", ")];
                            } else if (strength <= 3) {
                                strengthClass = 'strength-medium';
                                strengthMessage = 'Medium';
                                strengthDescription = 'Acceptable, but you can do better';
                                feedback = ["We suggest: " + feedback.slice(0, 2).join(", ")];
                            } else {
                                strengthClass = 'strength-strong';
                                strengthMessage = 'Strong';
                                strengthDescription = 'HELL YEAH!!';
                                feedback = ["the hackers will never see this coming!"];
                            }
                            
                            //Atualizar a barra e texto
                            if (password.length > 0) {
                                strengthBar.className = 'password-strength ' + strengthClass;
                                strengthText.className = 'strength-text ' + strengthClass.replace('strength-', 'strength-') + '-text';
                                strengthText.innerHTML = `<strong>${strengthMessage}</strong> - ${strengthDescription}<br><small>${feedback.join('')}</small>`;
                            } else {
                                strengthText.innerHTML = '';
                            }
                            
                            //Verificar se as senhas coincidem
                            checkPasswordMatch();
                        }
                        
                        //Função para verificar se as senhas coincidem
                        function checkPasswordMatch() {
                            const password = document.getElementById('password').value;
                            const confirmPassword = document.getElementById('confirmpasword').value;
                            const matchText = document.getElementById('passwordMatchText');
                            
                            if (confirmPassword.length === 0) {
                                matchText.innerHTML = '';
                                return;
                            }
                            
                            if (password === confirmPassword) {
                                matchText.innerHTML = '<span style="color: #28a745;"><i class="bi bi-check-circle"></i> Passwords match</span>';
                            } else {
                                matchText.innerHTML = '<span style="color: #dc3545;"><i class="bi bi-x-circle"></i> Passwords do not match</span>';
                            }
                        }
                        
                        // Adicionar evento de input para o campo de confirmação de senha
                        document.getElementById('confirmpassword').addEventListener('input', checkPasswordMatch);

                        // Função para alternar a visibilidade da senha
                        function togglePassword(inputId, iconId) {
                            const passwordInput = document.getElementById(inputId);
                            const icon = document.getElementById(iconId);
                            
                            if (passwordInput.type === 'password') {
                                passwordInput.type = 'text';
                                icon.classList.remove('bi-eye');
                                icon.classList.add('bi-eye-slash');
                            } else {
                                passwordInput.type = 'password';
                                icon.classList.remove('bi-eye-slash');
                                icon.classList.add('bi-eye');
                            }
                        }

                        // Adiciona os event listeners para ambos os campos
                        document.getElementById('togglePassword').addEventListener('click', function() {
                            togglePassword('password', 'togglePassword');
                        });

                        document.getElementById('toggleConfirmpassword').addEventListener('click', function() {
                            togglePassword('confirmpassword', 'toggleConfirmpassword');
                        });
                    </script>
                </div>
                
                <input type="hidden" name="id_user" value="<?php echo $show['id_user']; ?>">
            </form>
        </div>
        
        
        <?php
                }
        ?>
    </body>
</html>