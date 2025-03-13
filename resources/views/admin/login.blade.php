<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrador</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1e40af;
            --secondary-color: #64748b;
            --success-color: #22c55e;
            --background-color: #f1f5f9;
            --text-color: #1e293b;
            --error-color: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--background-color);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-color);
        }

        .login-container {
            background: white;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-icon {
            background: var(--primary-color);
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.4);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(37, 99, 235, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(37, 99, 235, 0);
            }
        }

        .login-icon i {
            font-size: 2rem;
            color: white;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary-color);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:hover {
            border-color: var(--primary-color);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .submit-btn {
            width: 100%;
            padding: 0.75rem;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background: var(--primary-dark);
        }

        .submit-btn i {
            margin-right: 0.5rem;
        }

        .alert {
            padding: 0.75rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            background: #fee2e2;
            color: var(--error-color);
            display: none;
        }

        .alert.show {
            display: block;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        .forgot-password {
            text-align: right;
            margin-top: -1rem;
            margin-bottom: 1rem;
        }

        .forgot-password a {
            color: var(--secondary-color);
            text-decoration: none;
            font-size: 0.9rem;
        }

        .forgot-password a:hover {
            color: var(--primary-color);
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 1.5rem;
            }

            .form-control {
                padding: 0.5rem 1rem 0.5rem 2.5rem;
            }

            .submit-btn {
                padding: 0.5rem;
            }
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
    <div class="login-container">
        <div class="login-header">
            <div class="login-icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <h2>Acceso Administrativo</h2>
        </div>

        <div class="alert" id="errorAlert">
            <i class="fas fa-exclamation-circle"></i>
            Credenciales incorrectas. Por favor, intente nuevamente.
        </div>

        <form method="POST" action="{{ route('admin.login.submit') }}" id="loginForm">
            @csrf
            <div class="form-group">
                <label>Correo electrónico</label>
                <div class="input-with-icon">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" class="form-control" required
                           placeholder="admin@ejemplo.com">
                </div>
            </div>

            <div class="form-group">
                <label>Contraseña</label>
                <div class="input-with-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-control" required
                           placeholder="••••••••">
                </div>
            </div>

            <button type="submit" class="submit-btn">
                <i class="fas fa-sign-in-alt"></i>
                Iniciar Sesión
            </button>

            <div class="btn-container">
               <a href="{{ url('/') }}" class="btn-custom">
                  <i class="fas fa-arrow-left"></i> Regresar a la Página de Inicio
               </a>
            </div>
        </form>

    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = document.querySelector('input[name="email"]').value;
            const password = document.querySelector('input[name="password"]').value;

            if (!email || !password) {
                e.preventDefault();
                document.getElementById('errorAlert').classList.add('show');
                setTimeout(() => {
                    document.getElementById('errorAlert').classList.remove('show');
                }, 3000);
            }
        });

        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', function() {
                if (this.value) {
                    this.classList.add('filled');
                } else {
                    this.classList.remove('filled');
                }
            });
        });
    </script>
</body>
</html>
