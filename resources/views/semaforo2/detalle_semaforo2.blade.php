<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Semaforo de Vehiculos2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h1 class="text-center text-success">Detalle del Semaforo de Vehiculos2</h1>
        <ul class="list-group list-group-flush text-center mt-3">
            <li class="list-group-item fs-5 fw-bold">
                <?= $Sema2['Numero_Cambios'] . ' ' . $Sema2['Fecha'] . ' ' . $Sema2['Hora'] ?>
            </li>
        </ul>
        <div class="text-center mt-3">
        <a href="{{ route('semaforo2.registro_semaforo2') }}">
        <button type="button" class="btn btn-primary">Regresar</button>
        </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
