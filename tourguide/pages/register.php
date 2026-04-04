<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
	

		<style>
			.password-strength {
				height: 5px;
				margin-top: 5px;
				border-radius: 3px;
				transition: all 0.3s ease;
			}
			
			.strength-weak {
				background-color: #dc3545;
				width: 33%;
			}
			
			.strength-medium {
				background-color: #ffc107;
				width: 66%;
			}
			
			.strength-strong {
				background-color: #28a745;
				width: 100%;
			}
			
			.strength-text {
				font-size: 0.875rem;
				margin-top: 3px;
				font-weight: 500;
			}
			
			.strength-weak-text {
				color: #dc3545;
			}
			
			.strength-medium-text {
				color: #ffc107;
			}
			
			.strength-strong-text {
				color: #28a745;
			}

			
		</style>

        <title>Register</title>

    </head>

    <body class="custom-bg-color">

        <div class="content" style="padding: 20px">

            <h1 class="custom-success-txt-color">  Client Registration </h1>
            
            <br>

            <form class="client_register" method="post" action="../actions/create_user.php">

                <div class="row">

                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Name</label>
                        </div>            
                    </div>

                    <div class="col-8">
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" autocomplete="off">
                            <label for="floatingInput">Email address</label>
                        </div>  
                    </div>
                </div>

                <!-- div for user password and password confirmation -->

                <div class=row>
                    <div class="col-3">
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control" id="password" required oninput="checkPasswordStrength(this.value)" required autocomplete="off">
                            <label for="floatingInput">Password</label>
                            <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer; z-index: 5;">
								<i class="bi bi-eye" id="togglePassword"></i>
							</span>
						</div>

						<!-- Indicador de força da senha -->
						<div class="password-strength-container">
							<div class="password-strength" id="passwordStrengthBar"></div>
							<div class="strength-text" id="passwordStrengthText"></div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-floating mb-3">
                            <input type="password" name="confirmpassword" class="form-control" id="confirmpassword" required autocomplete="off">
                            <label for="confirmpassword">Confirm password</label>
                            <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer; z-index: 5;">
								<i class="bi bi-eye" id="toggleConfirmpassword"></i>
							</span>
                        </div>
                        <!-- Indicador de correspondência de senha -->
						<div class="strength-text" id="passwordMatchText"></div>

                        <div class="col-12">
                            <button type="input" class="btn btn-success">Create your account</button>
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
						const confirmPassword = document.getElementById('confirmpassword').value;
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
        </form>
    </body>
</html>