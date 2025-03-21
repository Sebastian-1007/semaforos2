<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Semáforos - Panel Administrativo</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="{{ asset('js/grafica.js') }}"></script>
    <script src="{{ asset('js/grafica2.js') }}"></script>
    <script src="{{ asset('js/grafica3.js') }}"></script>
    <script src="{{ asset('js/grafica4.js') }}"></script>

    <style>
        :root {
            --verde-semaforo: #2ecc71;
            --amarillo-semaforo: #f1c40f;
            --rojo-semaforo: #e74c3c;
            --color-primario: #2c3e50;
            --gris-claro: #f5f6fa;
            --sidebar-width: 280px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', 'Segoe UI', sans-serif;
            background: var(--gris-claro);
            color: var(--color-primario);
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: white;
            padding: 2rem 1.5rem;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            position: fixed;
            height: 100vh;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2.5rem;
        }

        .sidebar-header i {
            font-size: 2rem;
            color: var(--color-primario);
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            color: var(--color-primario);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .sidebar-nav a:hover, .sidebar-nav a.active {
            background: var(--color-primario);
            color: white;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            padding: 2rem;
        }

        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .logout-btn {
            padding: 0.8rem 1.5rem;
            border: none;
            background: var(--rojo-semaforo);
            color: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background: #c0392b;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        .semaforo-status {
            display: flex;
            gap: 1rem;
            margin: 1rem 0;
        }

        .semaforo-light {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #ddd;
        }

        .semaforo-light.active {
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        .verde.active { background: var(--verde-semaforo); }
        .amarillo.active { background: var(--amarillo-semaforo); }
        .rojo.active { background: var(--rojo-semaforo); }

        .chart-container {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            margin: 2rem 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .chart-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .chart-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .table-container {
            width: 100%;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            overflow: hidden;
            margin: 2rem 0;
        }

        .table-container th {
            background: var(--color-primario);
            color: white;
            padding: 1.2rem;
        }

        .table-container td {
            padding: 1.2rem;
            border-bottom: 1px solid #eee;
        }

        .status-badge {
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .btn-custom {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-custom:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        .btn-custom:active {
            background-color: #a71d2a;
            transform: scale(0.95);
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-traffic-light"></i>
            <h2>NovaTech</h2>
        </div>
        <nav>
            <ul class="sidebar-nav">
                <li><a href="{{ route('admin.dashboard') }}" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i> Registros</a></li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <div class="header-bar">
            <h1>Gestión y Graficas de Semáforos</h1>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn-custom btn-danger">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </button>
            </form>
        </div>

        <div class="dashboard-grid">
            <div class="card">
                <h3>Semáforos Activos</h3>
                <div class="stats-number">48</div>
                <div class="semaforo-status">
                    <div class="semaforo-light verde active"></div>
                    <div class="semaforo-light amarillo"></div>
                    <div class="semaforo-light rojo"></div>
                </div>
                <small>98% operatividad</small>
            </div>

            <div class="card">
                <h3>Usuarios Activos</h3>
                <div class="stats-number">15</div>
                <div class="text-success">↑ 2 hoy</div>
            </div>

            <div class="card">
                <h3>Incidentes Hoy</h3>
                <div class="stats-number">3</div>
                <div class="text-warning">↑ 1 respecto ayer</div>
            </div>

            <div class="card">
                <h3>Flujo Vehicular</h3>
                <div class="stats-number">12,450</div>
                <div class="text-success">↓ 5% pico máximo</div>
            </div>
        </div>

        <div class="chart-grid">
            <div class="chart-container">
                <h2>Gráfica Semaforo de Estudiantes</h2>
                <canvas id="movimientosChart" width="400" height="200"></canvas>
            </div>

            <div class="chart-container">
                <h2>Gráfica Semaforo de Vehículos 2</h2>
                <canvas id="vehiculosChart" width="400" height="200"></canvas>
            </div>

            <div class="chart-container">
                <h2>Gráfica Semaforo de Vehículos 1</h2>
                <canvas id="vehiculosChart1" width="400" height="200"></canvas>
            </div>

            <div class="chart-container">
                <h2>Gráfica Sensor de Presencia</h2>
                <canvas id="sensorChart" width="400" height="200"></canvas>
            </div>
        </div>
    </main>

</body>
</html>