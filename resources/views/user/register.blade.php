<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario - Novatech</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome para iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }
        .form-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            width: 100%;
            max-width: 800px;
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .form-container h2 {
            color: #007bff;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: 600;
        }
        .form-container input {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px 15px 12px 45px;
            width: 100%;
            font-size: 1rem;
            color: #333;
            transition: all 0.3s ease;
            outline: none;
        }
        .form-container input:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
            background: #fff;
        }
        .form-container .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .form-container .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #007bff;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }
        .form-container button {
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
        }
        .form-container button:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }
        .form-container button:active {
            transform: translateY(0);
        }
        .form-container button i {
            margin-right: 8px;
        }
        .form-container .row {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
        }
        .form-container .col {
            flex: 1;
            min-width: 250px;
        }
        /* Indicador de validación */
        .validation-indicator {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
            color: #ccc;
            transition: color 0.3s ease;
        }
        .valid .validation-indicator {
            color: #28a745;
        }
        .invalid .validation-indicator {
            color: #dc3545;
        }
        /* Efecto de sombra al pasar el cursor sobre el formulario */
        .form-container:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
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
    justify-content: center;
    width: 100%; /* Hace que el botón tenga el mismo ancho que el de "Registrarse" */
    max-width: 900px; /* Ajusta el ancho máximo para que no sea demasiado grande */
    background: linear-gradient(135deg, #28a745, #218838);
    color: white;
    padding: 14px 0; /* Ajustado para que coincida con la altura del otro botón */
    border-radius: 8px;
    font-size: 18px; /* Aumentado para coincidir con el tamaño del texto */
    font-weight: bold;
    text-decoration: none;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    transition: transform 0.2s, box-shadow 0.2s;
     }

      /* Espaciado del ícono */
      .btn-custom i {
    margin-right: 50px;
    font-size: 20px; /* Asegura que el icono sea del tamaño adecuado */
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
<div class="form-container">
    <h2>Registro de Usuario</h2>
    <form method="POST" action="{{ route('user.register.submit') }}" id="registerForm">
        @csrf
        <div class="row">
            <!-- Columna Izquierda -->
            <div class="col">
                <!-- Nombre -->
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
                    <i class="fas fa-check validation-indicator"></i>
                    <span class="error-message" id="nombreError"></span>
                    <small class="form-text text-muted">Solo letras y espacios.</small>
                </div>
                <!-- Apellido Paterno -->
                <div class="input-group">
                    <i class="fas fa-id-card"></i>
                    <input type="text" name="app" id="app" placeholder="Apellido Paterno" required>
                    <i class="fas fa-check validation-indicator"></i>
                    <span class="error-message" id="appError"></span>
                    <small class="form-text text-muted">Solo letras y espacios.</small>
                </div>
                <!-- Apellido Materno -->
                <div class="input-group">
                    <i class="fas fa-id-card"></i>
                    <input type="text" name="apm" id="apm" placeholder="Apellido Materno" required>
                    <i class="fas fa-check validation-indicator"></i>
                    <span class="error-message" id="apmError"></span>
                    <small class="form-text text-muted">Solo letras y espacios.</small>
                </div>
                <!-- Fecha de Nacimiento -->
                <div class="input-group">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="date" name="fn" required>
                    <i class="fas fa-check validation-indicator"></i>
                </div>
            </div>
            <!-- Columna Derecha -->
            <div class="col">
                <!-- Teléfono -->
                <div class="input-group">
                    <i class="fas fa-phone"></i>
                    <input type="text" name="telefono" placeholder="Teléfono" required>
                    <i class="fas fa-check validation-indicator"></i>
                    <small class="form-text text-muted">Formato: 123-456-7890.</small>
                </div>
                <!-- Correo Electrónico -->
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" placeholder="Correo Electrónico" required>
                    <i class="fas fa-check validation-indicator"></i>
                    <span class="error-message" id="emailError"></span>
                    <small class="form-text text-muted">Ejemplo: usuario@dominio.com.</small>
                </div>
                <!-- Contraseña -->
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Contraseña" required>
                    <i class="fas fa-check validation-indicator"></i>
                    <span class="error-message" id="passwordError"></span>
                    <small class="form-text text-muted">1-16 caracteres, al menos una mayúscula, una minúscula, un número y un carácter especial.</small>
                </div>
                <!-- Confirmar Contraseña -->
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmar Contraseña" required>
                    <i class="fas fa-check validation-indicator"></i>
                    <span class="error-message" id="passwordConfirmationError"></span>
                    <small class="form-text text-muted">Las contraseñas deben coincidir.</small>
                </div>
            </div>
        </div>
        <!-- Botón de Registro -->
        <button type="submit">
            <i class="fas fa-user-plus"></i> Registrarse
        </button>

        <div class="btn-container">
        <a href="{{ url('/') }}" class="btn-custom">
        <i class="fas fa-arrow-left"></i> Regresar a la Página de Inicio
        </a>
        </div>


        <!-- Enlaces adicionales -->
        <div class="login-links">
            <p>¿Ya tienes una cuenta? <a href="{{ route('user.login') }}" class="login-link">Iniciar sesión</a></p>
        </div>

        
    </form>
</div>

<script>
document.getElementById('registerForm').addEventListener('submit', function(event) {
    let isValid = true;

    // Validación de Nombres (no aceptar caracteres especiales)
    const nombre = document.getElementById('nombre').value;
    const nombreRegex = /^[a-zA-Z\s]+$/;
    if (!nombreRegex.test(nombre)) {
        document.getElementById('nombreError').textContent = 'El nombre no puede contener caracteres especiales.';
        isValid = false;
    } else {
        document.getElementById('nombreError').textContent = '';
    }

    // Validación de Apellidos (no aceptar caracteres especiales)
    const app = document.getElementById('app').value;
    const apm = document.getElementById('apm').value;
    if (!nombreRegex.test(app)) {
        document.getElementById('appError').textContent = 'El apellido paterno no puede contener caracteres especiales.';
        isValid = false;
    } else {
        document.getElementById('appError').textContent = '';
    }
    if (!nombreRegex.test(apm)) {
        document.getElementById('apmError').textContent = 'El apellido materno no puede contener caracteres especiales.';
        isValid = false;
    } else {
        document.getElementById('apmError').textContent = '';
    }

    // Validación de Correo Electrónico
    const email = document.getElementById('email').value;
    const emailRegex = /^[a-zA-Z][a-zA-Z0-9-._]*@[a-zA-Z0-9-._]+\.[a-zA-Z]{2,3}$/;
    if (!emailRegex.test(email)) {
        document.getElementById('emailError').textContent = 'El correo electrónico no es válido.';
        isValid = false;
    } else {
        document.getElementById('emailError').textContent = '';
    }

    // Validación de Contraseña
    const password = document.getElementById('password').value;
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{1,16}$/;
    if (!passwordRegex.test(password)) {
        document.getElementById('passwordError').textContent = 'Contraseña no valida';
        isValid = false;
    } else {
        document.getElementById('passwordError').textContent = '';
    }

    // Validación de Confirmación de Contraseña
    const passwordConfirmation = document.getElementById('password_confirmation').value;
    if (password !== passwordConfirmation) {
        document.getElementById('passwordConfirmationError').textContent = 'Las contraseñas no coinciden.';
        isValid = false;
    } else {
        document.getElementById('passwordConfirmationError').textContent = '';
    }

    if (!isValid) {
        event.preventDefault();
    }
});

// Validaciones en tiempo real
document.getElementById('nombre').addEventListener('input', function() {
    const nombreRegex = /^[a-zA-Z\s]+$/;
    if (!nombreRegex.test(this.value)) {
        document.getElementById('nombreError').textContent = 'El nombre no puede contener caracteres especiales.';
    } else {
        document.getElementById('nombreError').textContent = '';
    }
});

document.getElementById('app').addEventListener('input', function() {
    const nombreRegex = /^[a-zA-Z\s]+$/;
    if (!nombreRegex.test(this.value)) {
        document.getElementById('appError').textContent = 'El apellido paterno no puede contener caracteres especiales.';
    } else {
        document.getElementById('appError').textContent = '';
    }
});

document.getElementById('apm').addEventListener('input', function() {
    const nombreRegex = /^[a-zA-Z\s]+$/;
    if (!nombreRegex.test(this.value)) {
        document.getElementById('apmError').textContent = 'El apellido materno no puede contener caracteres especiales.';
    } else {
        document.getElementById('apmError').textContent = '';
    }
});

document.getElementById('email').addEventListener('input', function() {
    const emailRegex = /^[a-zA-Z][a-zA-Z0-9-._]*@[a-zA-Z0-9-._]+\.[a-zA-Z]{2,3}$/;
    if (!emailRegex.test(this.value)) {
        document.getElementById('emailError').textContent = 'El correo electrónico no es válido.';
    } else {
        document.getElementById('emailError').textContent = '';
    }
});

document.getElementById('password').addEventListener('input', function() {
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{1,16}$/;
    if (!passwordRegex.test(this.value)) {
        document.getElementById('passwordError').textContent = 'Contraseña no valida';
    } else {
        document.getElementById('passwordError').textContent = '';
    }
});

document.getElementById('password_confirmation').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    if (this.value !== password) {
        document.getElementById('passwordConfirmationError').textContent = 'Las contraseñas no coinciden.';
    } else {
        document.getElementById('passwordConfirmationError').textContent = '';
    }
});
</script>

</body>
</html>
