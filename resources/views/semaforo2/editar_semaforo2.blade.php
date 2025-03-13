<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Editar Registro">
    <title>Editar Usuario</title>
    <!-- Estilos externos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2b4162;
            --primary-dark: #1a2a40;
            --secondary-color: #12100e;
        }
        h2 {
            color: var(--primary-color);
            margin: 2rem 0;
            font-weight: 600;
            animation: fadeIn 1s ease-in-out;
        }
        .form-group {
            margin-bottom: 1.5rem;
            animation: slideIn 0.8s ease-in-out;
        }
        .form-group label {
            font-weight: 500;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .form-control {
            border-radius: 8px;
            padding: 0.75rem;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 5px rgba(43, 65, 98, 0.3);
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
            transform: translateY(-2px);
        }
        .alert {
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            animation: fadeIn 0.8s ease-in-out;
        }
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body>

    <!-- Contenido principal -->
<div class="container mt-5">
    <h2 class="mb-4">
        <i class="bi bi-pencil-square"></i> Editar Registro Sensor de Vehículos 2
    </h2>
    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Mensaje de error -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form method="POST" action="{{ route('semaforo2_update', $Sema2['Id_semaforo2']) }}" class="row g-3">
        @csrf
        @method('PUT')
        <!-- Número de Cambios -->
        <div class="col-md-6">
            <label for="Numero_Cambios" class="form-label">Número de Cambios</label>
            <input type="number" class="form-control" id="Numero_Cambios" name="Numero_Cambios" value="{{ $Sema2['Numero_Cambios'] }}" required>
        </div>
        <!-- Fecha -->
        <div class="col-md-6">
            <label for="Fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="Fecha" name="Fecha" value="{{ \Carbon\Carbon::parse($Sema2['Fecha'])->format('Y-m-d') }}" required>
        </div>
        <!-- Hora -->
        <div class="col-md-6">
            <label for="Hora" class="form-label">Hora</label>
            <input type="time" class="form-control" id="Hora" name="Hora" value="{{ $Sema2['Hora'] }}" required>
        </div>
        <!-- Botones -->
        <div class="col-12 d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Actualizar
            </button>
            <a href="{{ route('semaforo2.registro_semaforo2') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </form>
</div>
    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
