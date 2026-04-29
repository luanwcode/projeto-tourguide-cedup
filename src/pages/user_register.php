<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
		<link rel="stylesheet" href="../assets/css/user_register.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
	
        <title>Sign up</title>

    </head>

<body>
    <?php
        include("../includes/fonts.php");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <!--Emtpy left col-->
            </div>  
        <div class="col-sm-4">
            <div class="register text-center">
                <div class="container">
                    <br>
                    <h1> <b> CREATE ACC<i class="bi bi-compass"></i>UNT </b> </h1>
                    <p> Already have an account? <a href="login.php" style="color: #429fc7"><b> Sign in </b> </a></p>
                    

                    <form name="register" method="post" action="../actions/create_user.php">
                        <input class="form-control" type="name" name="name" placeholder="Your Name" required>
                        <br>
                        <input class="form-control" type="email" name="email" placeholder="exemple@gmail.com" required>
                        <br>
                        
                        <div class="row" style="justify-content: center;">

                            <div class="col-6">
                                <div class="form-floatting mb-3">
                                    <input class="form-control" type="password" name="password" id="password" placeholder="Password_123" required oninput="checkPasswordStrength(this.value)" autocomplete="off">
								        <!-- <i class="bi bi-eye" id="togglePassword"></i> -->
                                </div>

                                <!-- Password strenght indicator -->
                                    <div class="password-strength-container">
                                    <div class="password-strength" id="passwordStrengthBar"></div>
                                    <div class="strength-text" id="passwordStrengthText"></div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form floating mb-3">
                                    <input class="form-control" type="password" name="confirmpassword" id="confirmpassword" placeholder="Password_123" required autocomplete="off">
								        <!-- <i class="bi bi-eye" id="toggleConfirmPassword"></i> -->
                                </div>

                                <!-- Password match indicator -->
                                 <div class="strenght-text" id="passwordMatchText"></div>
                            </div>
                            
                        </div>

                        <br><br>

                        <input type="submit" class="btn custom-blue" style="color:white;" value="Sign up">
                        <br><br>
                    </form>

                    <script>

					//Check password strenght
					function checkPasswordStrength(password) {
						let strength = 0;
						let feedback = [];
						
						//Criterium
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
						
						//Determines the strength
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
							strengthMessage = 'Good';
							strengthDescription = 'Strong';
							feedback = ["Now thats a good password!"];
						}
						
						//Updates the feedback and the strenght level bar
						if (password.length > 0) {
							strengthBar.className = 'password-strength ' + strengthClass;
							strengthText.className = 'strength-text ' + strengthClass.replace('strength-', 'strength-') + '-text';
							strengthText.innerHTML = `<strong>${strengthMessage}</strong> - ${strengthDescription}<br><small>${feedback.join('')}</small>`;
						} else {
							strengthText.innerHTML = '';
						}
						
						//Verifies if passwords match
						checkPasswordMatch();
					}
					
					//Function that verifies if the passwords match
					function checkPasswordMatch() {
						const password = document.getElementById('password').value;
						const confirmPassword = document.getElementById('confirmpassword').value;
						const matchText = document.getElementById('passwordMatchText');
						
						if (confirmPassword.length === 0) {
							matchText.innerHTML = '';
							return;
						}
						
						if (password === confirmPassword) {
							matchText.innerHTML = '<span style="color: #20e24d;"><i class="bi bi-check-circle"></i> Passwords match</span>';
						} else {
							matchText.innerHTML = '<span style="color: #ff182f;"><i class="bi bi-x-circle"></i> Passwords do not match</span>';
						}
					}
					
					// Adicionar evento de input para o campo de confirmação de senha
					document.getElementById('confirmpassword').addEventListener('input', checkPasswordMatch);

					// Password visibility button
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

					// Event listeners for password and password confirm fields
					document.getElementById('togglePassword').addEventListener('click', function() {
						togglePassword('password', 'togglePassword');
					});

					document.getElementById('toggleConfirmpassword').addEventListener('click', function() {
						togglePassword('confirmpassword', 'toggleConfirmpassword');
					});
				</script>

                </div>
            </div>
        </div>
        <div class="col-sm4">
            <!--Empty right col-->
        </div>
    </div>


</body>