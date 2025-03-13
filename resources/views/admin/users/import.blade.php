<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Importar usuarios desde Excel - Novatech Admin">
    <meta name="author" content="Novatech Team">
    <title>Importar Usuarios | Novatech Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --verde-semaforo: #2ecc71;
            --rojo-semaforo: #e74c3c;
            --color-primario: #2c3e50;
            --gris-claro: #f5f6fa;
            --transition-speed: 0.3s;
            --border-radius: 8px;
            --shadow-light: 0 2px 5px rgba(0,0,0,0.1);
            --shadow-hover: 0 4px 10px rgba(0,0,0,0.15);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Roboto', sans-serif; background: var(--gris-claro); color: var(--color-primario); min-height: 100vh; padding: 2rem; display: flex; flex-direction: column; align-items: center; }
        h2 { font-size: 1.75rem; font-weight: 600; margin-bottom: 2rem; display: flex; align-items: center; gap: 0.5rem; animation: fadeIn 0.5s ease-in; }
        h2 i { color: var(--color-primario); }
        .form-container { background: white; padding: 2rem; border-radius: var(--border-radius); box-shadow: var(--shadow-light); width: 100%; max-width: 500px; animation: slideInUp 0.5s ease-out; }
        .form-group { margin-bottom: 1.5rem; }
        label { display: block; font-weight: 600; margin-bottom: 0.5rem; color: var(--color-primario); }
        input[type="file"] { width: 100%; padding: 0.8rem; border: 1px solid #dfe6e9; border-radius: var(--border-radius); font-size: 0.95rem; transition: all var(--transition-speed); background: #fff; cursor: pointer; }
        input[type="file"]:focus { outline: none; border-color: var(--color-primario); box-shadow: 0 0 5px rgba(44, 62, 80, 0.3); }
        .btn { padding: 0.8rem 1.5rem; border: none; border-radius: var(--border-radius); cursor: pointer; transition: all var(--transition-speed); display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: var(--shadow-light); font-weight: 600; }
        .btn-primary { background: var(--color-primario); color: white; }
        .btn-primary:hover { background: #223548; transform: translateY(-2px); box-shadow: var(--shadow-hover); }
        .alert { padding: 1rem; border-radius: var(--border-radius); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; animation: slideInRight 0.5s ease-out; width: 100%; max-width: 500px; }
        .alert-success { background: rgba(46, 204, 113, 0.1); color: var(--verde-semaforo); }
        .alert-error { background: rgba(231, 76, 60, 0.1); color: var(--rojo-semaforo); }
        .alert i { font-size: 1.2rem; }
        @media (max-width: 576px) { body { padding: 1rem; } h2 { font-size: 1.5rem; } .form-container { padding: 1.5rem; } .btn { width: 100%; justify-content: center; } }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideInRight { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
    </style>
</head>
<body>
    <h2><i class="fas fa-file-import"></i> Importar Usuarios desde Excel</h2>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <div class="form-container">
        <form action="{{ route('admin.importar-usuarios') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="archivo"><i class="fas fa-file-excel"></i> Selecciona un archivo Excel:</label>
                <input type="file" name="archivo" id="archivo" accept=".xlsx, .xls" required>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-upload"></i> Importar Usuarios
            </button>
        </form>
    </div>
</body>
</html>