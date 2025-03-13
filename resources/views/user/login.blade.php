<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Inicia sesión en Novatech para acceder a tu cuenta">
    <title>Iniciar Sesión - Novatech</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome para iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: #333;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        /* Fondo animado */
        .background-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-color: #c3cfe2; /* Fallback color */
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            animation: fadeInOut 15s infinite ease-in-out;
        }

        @keyframes fadeInOut {
            0%, 100% { opacity: 0.1; }
            50% { opacity: 0.3; }
        }

        .login-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.5s ease-in-out;
            z-index: 1;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-container h1 {
            color: #007bff;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: 600;
        }

        /* Estilos mejorados para campos de formulario */
        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group input {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px 15px 12px 45px;
            width: 100%;
            font-size: 1rem;
            color: #333;
            transition: all 0.3s ease;
            height: auto;
            line-height: 1.5;
        }

        .input-group input:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
            background: #fff;
            outline: none;
        }

        .input-group label {
            position: absolute;
            left: 45px;
            top: 12px;
            font-size: 1rem;
            color: #6c757d;
            pointer-events: none;
            transition: 0.3s ease all;
        }

        .input-group input:focus ~ label,
        .input-group input:not(:placeholder-shown) ~ label {
            top: -10px;
            left: 15px;
            font-size: 0.85rem;
            background-color: white;
            padding: 0 5px;
            color: #007bff;
        }

        .input-group input::placeholder {
            color: transparent;
        }

        .input-group .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #007bff;
            font-size: 1.1rem;
            z-index: 3;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 1rem;
            cursor: pointer;
            z-index: 3;
        }

        .toggle-password:hover {
            color: #007bff;
        }

        .error-feedback {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 0.25rem;
            display: none;
        }

        .input-group.error input {
            border-color: #dc3545;
        }

        .input-group.success input {
            border-color: #28a745;
        }

        /* Botón de inicio de sesión */
        .btn-login {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #007bff;
            color: #fff;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
            font-weight: 500;
            margin-top: 1rem;
        }

        .btn-login:hover:not(:disabled) {
            background: #0056b3;
            transform: translateY(-2px);
        }

        .btn-login:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn-login:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .btn-login i {
            margin-right: 8px;
        }

        /* Recordar sesión */
        .remember-check {
            margin-bottom: 1rem;
        }

        .remember-check input {
            margin-right: 8px;
        }

        /* Enlaces */
        .login-links {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .login-links a {
            color: #007bff;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
            margin-bottom: 0.5rem;
        }

        .login-links a:hover {
            color: #0056b3;
        }

        /* Spinner de carga */
        .spinner {
            display: none;
            margin-right: 8px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Notificaciones */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1000;
        }

        .notification.show {
            opacity: 1;
        }

        .notification.success {
            border-left: 4px solid #28a745;
        }

        .notification.error {
            border-left: 4px solid #dc3545;
        }

        /* Alerta de error */
        #errorContainer {
            margin-bottom: 1.5rem;
        }
        /* Contenedor del botón */
       .btn-container {
    display: flex;
    justify-content: center;
    margin-bottom: 1.5rem;
        }

          /* Estilos del botón */
       .btn-custom {
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, #28a745, #218838);
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    text-decoration: none;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    transition: transform 0.2s, box-shadow 0.2s;
      }

     /* Espaciado del ícono */
       .btn-custom i {
    margin-right: 10px;
     }

    /* Efecto al pasar el mouse */
      .btn-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    background: linear-gradient(135deg, #218838, #1e7e34);
    }

    </style>
</head>
<body>
    <div class="background-animation"></div>
    <div class="login-container" role="main">
        <h1 id="login-title">Iniciar Sesión Usuario</h1>
        
        <!-- Contenedor para alertas del backend -->
        <div id="errorContainer" class="alert alert-danger text-center" style="display: none;" role="alert" aria-live="assertive">
            <span id="errorMessage"></span>
        </div>
        
        <form id="loginForm" method="POST" action="{{ route('user.login.submit') }}" novalidate>
            @csrf
            <!-- Correo Electrónico -->
            <div class="input-group" id="emailGroup">
                <span class="input-icon" aria-hidden="true">
                    <i class="fas fa-envelope"></i>
                </span>
                <input type="email" id="email" name="email" placeholder=" " required autocomplete="email">
                <label for="email">Correo Electrónico</label>
                <div class="error-feedback" id="emailError">Por favor, ingresa un correo válido.</div>
            </div>
            
            <!-- Contraseña -->
            <div class="input-group" id="passwordGroup">
                <span class="input-icon" aria-hidden="true">
                    <i class="fas fa-lock"></i>
                </span>
                <input type="password" id="password" name="password" placeholder=" " required autocomplete="current-password" minlength="6">
                <label for="password">Contraseña</label>
                <span class="toggle-password" id="togglePassword" role="button" tabindex="0" aria-label="Mostrar contraseña">
                    <i class="fas fa-eye"></i>
                </span>
                <div class="error-feedback" id="passwordError">La contraseña debe tener al menos 6 caracteres.</div>
            </div>
            
            <!-- Botón de Inicio de Sesión -->
            <button type="submit" id="submitButton" class="btn-login" aria-live="polite">
                <span class="spinner" id="loginSpinner" aria-hidden="true">
                    <i class="fas fa-spinner"></i>
                </span>
                <i class="fas fa-sign-in-alt"></i> Ingresar
            </button>
            
            <div class="btn-container">
               <a href="{{ url('/') }}" class="btn-custom">
                 <i class="fas fa-arrow-left"></i> Regresar a la Página de Inicio
             </a>
           </div>

            <!-- Enlaces adicionales -->
            <div class="login-links">
                <p>¿No tienes una cuenta? <a href="{{ route('user.register') }}" class="register-link">Crear cuenta nueva</a></p>
            </div>
        </form>
    </div>
    
    <!-- Notificación -->
    <div class="notification" id="notification" role="alert" aria-live="assertive"></div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elementos del DOM
            const loginForm = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const emailGroup = document.getElementById('emailGroup');
            const passwordGroup = document.getElementById('passwordGroup');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');
            const submitButton = document.getElementById('submitButton');
            const loginSpinner = document.getElementById('loginSpinner');
            const togglePassword = document.getElementById('togglePassword');
            const errorContainer = document.getElementById('errorContainer');
            const errorMessage = document.getElementById('errorMessage');
            const notification = document.getElementById('notification');
            
            // Mostrar notificación
            function showNotification(message, type) {
                notification.textContent = message;
                notification.className = 'notification ' + type;
                notification.classList.add('show');
                
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 5000);
            }
            
            // Validación en tiempo real
            function validateForm() {
                let isValid = true;
                
                // Validar email
                if (!emailInput.value.trim()) {
                    emailGroup.classList.add('error');
                    emailError.textContent = 'Este campo es obligatorio';
                    emailError.style.display = 'block';
                    isValid = false;
                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value)) {
                    emailGroup.classList.add('error');
                    emailError.textContent = 'Por favor ingresa un correo válido';
                    emailError.style.display = 'block';
                    isValid = false;
                } else {
                    emailGroup.classList.remove('error');
                    emailGroup.classList.add('success');
                    emailError.style.display = 'none';
                }
                
                // Validar contraseña
                if (!passwordInput.value) {
                    passwordGroup.classList.add('error');
                    passwordError.textContent = 'Este campo es obligatorio';
                    passwordError.style.display = 'block';
                    isValid = false;
                } else if (passwordInput.value.length < 6) {
                    passwordGroup.classList.add('error');
                    passwordError.textContent = 'La contraseña debe tener al menos 6 caracteres';
                    passwordError.style.display = 'block';
                    isValid = false;
                } else {
                    passwordGroup.classList.remove('error');
                    passwordGroup.classList.add('success');
                    passwordError.style.display = 'none';
                }
                
                // Habilitar/deshabilitar botón de envío
                submitButton.disabled = !isValid;
                return isValid;
            }
            
            // Eventos de validación
            emailInput.addEventListener('input', validateForm);
            passwordInput.addEventListener('input', validateForm);
            
            // Mostrar/Ocultar contraseña
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                togglePassword.querySelector('i').classList.toggle('fa-eye');
                togglePassword.querySelector('i').classList.toggle('fa-eye-slash');
                togglePassword.setAttribute('aria-label', 
                    type === 'password' ? 'Mostrar contraseña' : 'Ocultar contraseña');
            });
            
            // Accesibilidad para toggle password con teclado
            togglePassword.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
            
            // Envío del formulario
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (!validateForm()) {
                    return;
                }
                
                // Mostrar spinner y deshabilitar botón
                loginSpinner.style.display = 'inline-block';
                submitButton.disabled = true;
                submitButton.innerHTML = '<span class="spinner"><i class="fas fa-spinner"></i></span> Procesando...';
                
                // Simulación de envío del formulario (reemplazar con AJAX real)
                setTimeout(function() {
                    // En un caso real, aquí irían las llamadas AJAX
                    loginSpinner.style.display = 'none';
                    submitButton.disabled = false;
                    submitButton.innerHTML = '<i class="fas fa-sign-in-alt"></i> Ingresar';
                    
                    // Ejemplo de respuesta exitosa
                    showNotification('Cargando...');
                    
                    // Enviar el formulario realmente después de la simulación
                    loginForm.submit();
                }, 1500);
            });
            
            // Si hay errores enviados desde el servidor (Laravel)
            @if ($errors->has('email'))
                errorMessage.textContent = "{{ $errors->first('email') }}";
                errorContainer.style.display = 'block';
                emailGroup.classList.add('error');
            @endif
            
            @if ($errors->has('password'))
                errorMessage.textContent = "{{ $errors->first('password') }}";
                errorContainer.style.display = 'block';
                passwordGroup.classList.add('error');
            @endif
        });
    </script>
</body>
</html>