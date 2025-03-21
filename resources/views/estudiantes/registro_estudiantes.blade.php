<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de gestión de usuarios para administradores - Novatech">
    <meta name="author" content="Novatech Team">
    <title>Lista de Usuarios | Novatech Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --verde-semaforo: #2ecc71;
            --amarillo-semaforo: #f1c40f;
            --rojo-semaforo: #e74c3c;
            --azul-info: #3498db;
            --color-primario: #2c3e50;
            --color-secundario: #34495e;
            --gris-claro: #f5f6fa;
            --gris-medio: #95a5a6;
            --sidebar-width: 280px;
            --transition-speed: 0.3s;
            --border-radius: 8px;
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
            overflow-x: hidden;
        }

        /* Resto de tu CSS original sin cambios */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            padding: 2rem 1.5rem;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            position: fixed;
            height: 100vh;
            z-index: 1000;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2.5rem;
            animation: slideInLeft 0.5s ease-out;
        }

        .sidebar-header i {
            font-size: 2rem;
            color: var(--color-primario);
            transition: transform var(--transition-speed);
        }

        .sidebar-header:hover i {
            transform: rotate(360deg);
        }

        .sidebar-nav {
            list-style: none;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            color: var(--color-primario);
            text-decoration: none;
            border-radius: var(--border-radius);
            transition: all var(--transition-speed);
        }

        .sidebar-nav a:hover, .sidebar-nav a.active {
            background: var(--color-primario);
            color: white;
            transform: translateX(5px);
        }

        .sidebar-nav i {
            transition: transform var(--transition-speed);
        }

        .sidebar-nav a:hover i {
            transform: scale(1.2);
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
            animation: fadeIn 0.5s ease-in;
        }

        .header-bar h1 {
            font-size: 1.75rem;
            font-weight: 600;
        }

        .btn-custom {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: all var(--transition-speed);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .btn-primary:hover { background: #223548; }
        .btn-success { background: var(--verde-semaforo); color: white; }
        .btn-success:hover { background: #27ae60; }
        .btn-danger { background: var(--rojo-semaforo); color: white; }
        .btn-danger:hover { background: #c0392b; }
        .btn-warning { background: var(--amarillo-semaforo); color: var(--color-primario); }
        .btn-warning:hover { background: #d4ac0d; }
        .btn-sm { padding: 0.5rem 0.8rem; font-size: 0.9rem; }

        .table-controls {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .search-container {
            position: relative;
            flex: 1;
            min-width: 200px;
            max-width: 400px;
        }

        .search-container i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gris-medio);
        }

        .search-input {
            width: 100%;
            padding: 0.8rem 0.8rem 0.8rem 2.5rem;
            border: 1px solid #dfe6e9;
            border-radius: var(--border-radius);
            font-size: 0.95rem;
            transition: all var(--transition-speed);
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--color-primario);
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        }

        .table-actions {
            display: flex;
            gap: 0.5rem;
        }

        .table-container {
            width: 100%;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            overflow: hidden;
            margin: 0;
        }

        .users-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .users-table th, .users-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #edf2f7;
        }

        .users-table th {
            background: var(--color-primario);
            color: white;
            font-weight: 600;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .users-table th a {
            color: white;
            text-decoration: none;
        }

        .users-table th a:hover {
            color: #e0e0e0; /* Un blanco más claro al pasar el mouse, opcional */
        }

        .sortable:hover {
            background: #3d5066;
            cursor: pointer;
        }

        .sortable i.fa-sort {
            font-size: 0.8rem;
            margin-left: 0.3rem;
            opacity: 0.7;
        }

        .users-table tbody tr:hover {
            background-color: #f8fafc;
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .actions-container {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: var(--border-radius);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition-speed);
            color: white;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 8px rgba(0,0,0,0.15);
        }

        .action-btn.view { background-color: var(--color-primario); }
        .action-btn.edit { background-color: var(--amarillo-semaforo); color: var(--color-primario); }
        .action-btn.delete { background-color: var(--rojo-semaforo); }

        .badge-id {
            background: var(--color-primario);
            color: white;
            padding: 0.3rem 0.6rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .email-link, .phone-link {
            color: var(--color-primario);
            text-decoration: none;
            transition: color var(--transition-speed);
        }

        .email-link:hover, .phone-link:hover {
            color: var(--azul-info);
            text-decoration: underline;
        }

        /* Estilos originales de paginación */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .pagination {
            display: flex;
            gap: 0.3rem;
        }

        .page-btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #dfe6e9;
            background: white;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: all var(--transition-speed);
            text-decoration: none;
            color: var(--color-primario);
        }

        .page-btn:hover:not([disabled]), .page-btn.active {
            background: var(--color-primario);
            color: white;
            border-color: var(--color-primario);
        }

        .page-btn[disabled] {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Aplicar estilos a la paginación de Laravel */
        .pagination .page-item .page-link {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #dfe6e9;
            background: white;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: all var(--transition-speed);
            color: var(--color-primario);
            text-decoration: none;
            padding: 0;
        }

        .pagination .page-item.active .page-link {
            background: var(--color-primario);
            color: white;
            border-color: var(--color-primario);
        }

        .pagination .page-item .page-link:hover:not(.disabled) {
            background: var(--color-primario);
            color: white;
            border-color: var(--color-primario);
        }

        .pagination .page-item.disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1050;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 0.3s ease-out;
        }

        .modal-header {
            padding: 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #edf2f7;
        }

        .modal-header h3 {
            margin: 0;
            color: var(--color-primario);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .modal-header h3 i { color: var(--rojo-semaforo); }
        .modal-close {
            font-size: 1.5rem;
            cursor: pointer;
            color: #a0aec0;
            transition: color var(--transition-speed);
        }

        .modal-close:hover { color: var(--rojo-semaforo); }
        .modal-body { padding: 1.5rem; }
        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #edf2f7;
            display: flex;
            justify-content: flex-end;
            gap: 0.8rem;
        }

        .tooltip:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            padding: 0.5rem;
            background: var(--color-primario);
            color: white;
            border-radius: 4px;
            font-size: 0.8rem;
            white-space: nowrap;
            z-index: 1000;
            animation: fadeIn 0.2s ease-out;
        }

        .alert {
            padding: 1rem;
            border-radius: var(--border-radius);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            animation: slideInRight 0.5s ease-out;
        }

        .alert-success {
            background: rgba(46, 204, 113, 0.1);
            color: var(--verde-semaforo);
        }

        @media (max-width: 768px) {
            .sidebar { width: 80px; }
            .main-content { margin-left: 80px; padding: 1rem; }
            .sidebar-header h2, .sidebar-nav span { display: none; }
            .sidebar-nav a { justify-content: center; }
            .table-controls { flex-direction: column; }
            .search-container { max-width: 100%; }
            .users-table { display: block; }
            .users-table thead { display: none; }
            .users-table tbody, .users-table tr, .users-table td { display: block; width: 100%; }
            .users-table tr { margin-bottom: 1rem; border: 1px solid #eee; border-radius: var(--border-radius); padding: 0.5rem; }
            .users-table td { text-align: right; padding: 0.8rem; position: relative; border-bottom: 1px solid #f1f1f1; }
            .users-table td:before { content: attr(data-label); position: absolute; left: 0.8rem; top: 0.8rem; font-weight: 600; color: var(--color-primario); }
            .pagination-container { flex-direction: column; align-items: flex-start; }
        }

        @media (max-width: 576px) {
            .header-bar { flex-direction: column; gap: 1rem; align-items: flex-start; }
            .btn-custom { width: 100%; }
        }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideInLeft { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes slideInRight { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes slideInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        .users-table tr { animation: slideInUp 0.5s ease-out forwards; opacity: 0; }
        .users-table tr:nth-child(1) { animation-delay: 0.1s; }
        .users-table tr:nth-child(2) { animation-delay: 0.2s; }
        .users-table tr:nth-child(3) { animation-delay: 0.3s; }
        .users-table tr:nth-child(4) { animation-delay: 0.4s; }
        .users-table tr:nth-child(5) { animation-delay: 0.5s; }

          /* Contenedor del botón */
       .btn-download-container {
       text-align: right;
       margin-bottom: 1rem;
      }

       /* Estilos del botón */
       .btn-download {
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg,rgb(228, 252, 13),rgb(255, 238, 7)); /* Rojo atractivo */
    color: white;
    padding: 14px 20px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s, background 0.3s;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
     }

      /* Espaciado del ícono */
       .btn-download i {
    margin-right: 10px;
    font-size: 18px;
     }

   /* Efecto hover */
      .btn-download:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    background: linear-gradient(135deg, #c9302c, #a52a2a);
    }

    /* Efecto de clic */
    .btn-download:active {
    transform: scale(0.95);
    }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-users"></i>
            <h2>Novatech Admin</h2>
        </div>
        <nav>
            <ul class="sidebar-nav">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                <li><a href="{{ route('admin.users.index') }}" class="active"><i class="fas fa-users"></i><span>Usuarios</span></a></li>
                <li><a href="{{ route('sensor.registro_sensor') }}" class="active"><i class="fas fa-users"></i><span>Registro Sensor Presencia</span></a></li>
                <li><a href="{{ route('semaforo1.registro_semaforo1') }}" class="active"><i class="fas fa-users"></i><span>Registro Semaforo Vehiculos1</span></a></li>
                <li><a href="{{ route('semaforo2.registro_semaforo2') }}" class="active"><i class="fas fa-users"></i><span>Registro Semaforo Vehiculos2</span></a></li>
                <li><a href="{{ route('estudiantes.registro_estudiantes') }}" class="active"><i class="fas fa-users"></i><span>Registro Semaforo Estudiantes</span></a></li>

            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <div class="header-bar">
            <h1><i class="fas fa-users-cog"></i> Panel de Administración</h1>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn-custom btn-danger">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </button>
            </form>
        </div>

        <section class="content fade-in">
            <div style="display: flex; justify-content: space-between; margin-bottom: 1.5rem;">
                <a href="{{ route('estudiantes.estudiantes_login') }}" class="btn-custom btn-success">
                    <i class="fas fa-plus"></i> Nuevo Registro Semaforo
                </a>
                <a href="{{ route('admin.dashboard') }}" class="btn-custom btn-primary tooltip" data-tooltip="Ver estadísticas de usuarios">
                  <i class="fas fa-chart-pie"></i> Estadísticas
                </a>
            </div>

            <h2 style="margin-bottom: 1.5rem;"><i class="fas fa-list-ul"></i> Lista de Semaforo de Estudiantes</h2>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <form method="GET" action="{{ route('estudiantes.registro_estudiantes') }}">
                <div class="table-controls">
                    <div class="search-container">
                        <i class="fas fa-search"></i>
                        <input type="text" name="search" id="semaforoSearch" placeholder="Buscar semáforo..." class="search-input" value="{{ request('search') }}">
                    </div>
                    <div class="table-actions">
                        <button type="submit" class="btn-custom btn-primary btn-sm tooltip" data-tooltip="Buscar">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </div>
                </div>
              <div class="table-controls"> 
                <div class="btn-download-container">
                    <button id="downloadPdfBtn" class="btn-download">
                    <i class="fas fa-download"></i> Descargar PDF </button>
                  </div>
                  <div class="btn-download-container">
                    <button id="downloadExcelBtn" class="btn-download">
                    <i class="fas fa-download"></i> Descargar Excel </button>
                  </div>
              </div>

                <div class="table-container">
                    <table class="users-table">
                        <thead>
                            <tr>
                                <th>Número de Cambios</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="semaforosTableBody">
                            @forelse ($Estu as $item)
                                <tr class="semaforo-row">
                                    <td data-label="Número de Cambios">{{ $item['Numero_Cambios'] }}</td>
                                    <td data-label="Fecha">{{ \Carbon\Carbon::parse($item['Fecha'])->format('d/m/Y') }}</td>
                                    <td data-label="Hora">{{ $item['Hora'] }}</td>
                                    <td>
                                        <div class="actions-container">
                                            <a href="{{ route('estudiantes.detalle_estudiantes', ['Id_semaforo_estu' => $item['Id_semaforo_estu']]) }}" class="action-btn view tooltip" data-tooltip="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('estudiantes.editar_estudiantes', ['Id_semaforo_estu' => $item['Id_semaforo_estu']]) }}" class="action-btn edit tooltip" data-tooltip="Editar semáforo">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <button class="action-btn delete tooltip" 
                                                data-tooltip="Eliminar semáforo" 
                                                onclick="confirmDelete(event, '{{ route('deleteEstu', ['Id_semaforo_estu' => $item['Id_semaforo_estu']]) }}')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 2rem;">No se encontraron semáforos.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="pagination-container">
                    <div class="pagination">
                        <!-- Usar paginación de Laravel con estilos personalizados -->
                        {!! $Estu->links('custom') !!}
                    </div>
                    <div class="page-size">
                        <label>Mostrar:</label>
                        <select name="per_page" onchange="this.form.submit()">
                            <option value="5" {{ request('per_page', 5) == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                    </div>
                </div>
            </form>
        </section>
    </main>

    <!-- Modal de eliminación -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-exclamation-triangle"></i> Confirmar eliminación</h3>
                <span class="modal-close" onclick="closeDeleteModal()">×</span>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este semáforo?</p>
                <div class="warning-text" style="color: var(--rojo-semaforo); display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-exclamation-circle"></i> Esta acción no se puede deshacer
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-custom btn-secondary" onclick="closeDeleteModal()">Cancelar</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-custom btn-danger"><i class="fas fa-trash-alt"></i> Eliminar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(event, deleteUrl) {
            event.preventDefault(); // Evita que el enlace se ejecute de inmediato

            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción no se puede deshacer.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#28a745",  // Verde
                cancelButtonColor: "#dc3545",  // Rojo
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl; // Redirige al enlace de eliminación
                }
            });
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }
    </script>

    <!-- Librerías -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

     <!-- Incluye la librería jsPDF y autoTable -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>

<script>
    document.getElementById('downloadPdfBtn').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF('p', 'mm', 'a4');

        // Título del PDF
        pdf.setFontSize(18);
        pdf.setTextColor(33, 37, 41);
        pdf.setFont('helvetica', 'bold');
        pdf.text('Reporte de Semáforos Estudiantes', 14, 20);

        // Obtener los datos de la tabla
        const table = document.querySelector('.users-table');
        const headers = [];
        const rows = [];

        // Obtener los encabezados de la tabla (excluyendo la columna "Acciones")
        table.querySelectorAll('thead th').forEach((header, index) => {
            if (index < 3) { // Solo toma las primeras 3 columnas (Número de Cambios, Fecha, Hora)
                headers.push(header.innerText);
            }
        });

        // Obtener las filas de la tabla (excluyendo la columna "Acciones")
        table.querySelectorAll('tbody tr').forEach(row => {
            const rowData = [];
            row.querySelectorAll('td').forEach((cell, index) => {
                if (index < 3) { // Solo toma las primeras 3 columnas (Número de Cambios, Fecha, Hora)
                    rowData.push(cell.innerText);
                }
            });
            rows.push(rowData);
        });

        // Generar la tabla con autoTable
        pdf.autoTable({
            head: [headers], // Encabezados
            body: rows, // Datos de la tabla
            startY: 30, // Posición de inicio debajo del título
            styles: { font: 'helvetica', fontSize: 10, textColor: [33, 37, 41] },
            headStyles: { fillColor: [52, 58, 64], textColor: 255, fontStyle: 'bold' }, // Estilos para el encabezado
            alternateRowStyles: { fillColor: [248, 249, 250] }, // Filas con fondo gris claro
            margin: { left: 10, right: 10 }, // Márgenes
            tableWidth: 'auto', // Ajuste automático al tamaño del PDF
        });

        // Descargar el PDF
        pdf.save('Semaforos Estudiantes.pdf');
    });
</script>
<!-- Incluye la biblioteca xlsx -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

<script>
    document.getElementById('downloadExcelBtn').addEventListener('click', function () {
        // Obtener los datos de la tabla
        const table = document.getElementById('semaforosTableBody');
        const headers = [];
        const rows = [];

        // Obtener los encabezados de la tabla (excluyendo la columna "Acciones")
        document.querySelectorAll('.users-table thead th').forEach((header, index) => {
            if (index < 3) { // Solo toma las primeras 7 columnas
                headers.push(header.innerText);
            }
        });

        // Obtener las filas de la tabla (excluyendo la columna "Acciones")
        table.querySelectorAll('tr').forEach(row => {
            const rowData = [];
            row.querySelectorAll('td').forEach((cell, index) => {
                if (index < 3) { // Solo toma las primeras 7 columnas
                    rowData.push(cell.innerText);
                }
            });
            rows.push(rowData);
        });

        // Crear un libro de Excel y una hoja de trabajo
        const workbook = XLSX.utils.book_new();
        const worksheetData = [headers, ...rows];
        const worksheet = XLSX.utils.aoa_to_sheet(worksheetData);

        // Añadir la hoja de trabajo al libro
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Registro de Usuarios');

        // Generar el archivo Excel y descargarlo
        XLSX.writeFile(workbook, 'Registro de Semaforo de Estudiantes.xlsx');
    });
</script>
</body>
</html>