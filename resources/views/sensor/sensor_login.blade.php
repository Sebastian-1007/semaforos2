<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .form-group input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .button-container {
            text-align: center;
            margin-top: 10px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .cancel-button {
            background-color: #dc3545;
        }
        .cancel-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Registrar Datos al Sensor</h2>
    <form method="POST" action="{{ route('sensor_store') }}">
        @csrf
        <div class="form-group">
            <input type="number" name="Numero_Estudiantes" placeholder="Número de Estudiantes" required>
        </div>
        <div class="form-group">
            <input type="date" name="Fecha" required>
            <input type="time" name="Hora" required>
        </div>
        <div class="button-container">
            <button type="submit">Guardar</button>
            <button type="button" class="cancel-button" onclick="window.location.href='{{ route('sensor.registro_sensor') }}'">Cancelar</button>
        </div>
    </form>
</div>
</body>
</html>
