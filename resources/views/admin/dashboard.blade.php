<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Semáforos - Panel Administrativo</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    background-color: #dc3545; /* Rojo Bootstrap */
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
    background-color: #c82333; /* Rojo más oscuro al pasar el mouse */
    transform: scale(1.05);
   }

    .btn-custom:active {
    background-color: #a71d2a; /* Rojo aún más oscuro al hacer clic */
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
                <li><a href="#"><i class="fas fa-clock"></i> Tiempos</a></li>
                <li><a href="#"><i class="fas fa-exclamation-triangle"></i> Alertas</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Configuración</a></li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <div class="header-bar">
            <h1>Gestión de Semáforos</h1>
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

        <div class="dashboard-grid">
            <div class="chart-container">
                <canvas id="trafficFlowChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="userActivityChart"></canvas>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Última Actividad</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>USR-001</td>
                        <td>Juan Pérez</td>
                        <td>Administrador</td>
                        <td><span class="status-badge verde active">Activo</span></td>
                        <td>09:15 AM</td>
                    </tr>
                    <tr>
                        <td>USR-002</td>
                        <td>María Gómez</td>
                        <td>Técnico</td>
                        <td><span class="status-badge amarillo active">Inactivo</span></td>
                        <td>Ayer 14:30</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ubicación</th>
                        <th>Estado</th>
                        <th>Última Actualización</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>SF-001</td>
                        <td>Av. Principal esq. Calle 5</td>
                        <td><span class="status-badge verde active">Operativo</span></td>
                        <td>08:45 AM</td>
                        <td><i class="fas fa-cog"></i></td>
                    </tr>
                    <tr>
                        <td>SF-002</td>
                        <td>Plaza Central</td>
                        <td><span class="status-badge amarillo active">Mantenimiento</span></td>
                        <td>07:30 AM</td>
                        <td><i class="fas fa-cog"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        // Supongamos que tienes los datos de la tabla en un array de objetos
const datosTabla = [
    { Id_semaforo_estu: 1, Numero_Cambios: 1500, Fecha: '2023-10-01', Hora: '06:00' },
    { Id_semaforo_estu: 2, Numero_Cambios: 3200, Fecha: '2023-10-01', Hora: '09:00' },
    { Id_semaforo_estu: 3, Numero_Cambios: 2800, Fecha: '2023-10-01', Hora: '12:00' },
    { Id_semaforo_estu: 4, Numero_Cambios: 3400, Fecha: '2023-10-01', Hora: '15:00' },
    { Id_semaforo_estu: 5, Numero_Cambios: 4200, Fecha: '2023-10-01', Hora: '18:00' },
    { Id_semaforo_estu: 6, Numero_Cambios: 2300, Fecha: '2023-10-01', Hora: '21:00' }
];

// Extraer las horas y el número de cambios
const labels = datosTabla.map(item => item.Hora);
const data = datosTabla.map(item => item.Numero_Cambios);

// Obtener el contexto del gráfico
const trafficCtx = document.getElementById('trafficFlowChart').getContext('2d');

// Crear el gráfico con los datos de la tabla
new Chart(trafficCtx, {
    type: 'line',
    data: {
        labels: labels, // Usar las horas como etiquetas
        datasets: [{
            label: 'Vehículos por hora',
            data: data, // Usar el número de cambios como datos
            borderColor: '#2c3e50',
            backgroundColor: 'rgba(44, 62, 80, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Flujo Vehicular Diario'
            }
        }
    }
});

        // Gráfico de actividad de usuarios
        const userCtx = document.getElementById('userActivityChart').getContext('2d');
        new Chart(userCtx, {
            type: 'bar',
            data: {
                labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
                datasets: [{
                    label: 'Sesiones de Usuarios',
                    data: [25, 32, 28, 35, 40, 15, 10],
                    backgroundColor: 'rgba(46, 204, 113, 0.8)',
                    borderColor: '#2ecc71',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Actividad de Usuarios por Día'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>