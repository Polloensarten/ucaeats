<?php
session_start();

// Verificar si es administrador
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 2) {
    header("Location: ../Login/login.html");
    exit;
}

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ucabits";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para obtener todos los usuarios
$sql = "SELECT id_usuario, nombreUsuario, numeroTelefono, tipo FROM cuentas ORDER BY id_usuario ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Tabla de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .table-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
            margin-top: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .tipo-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
        .tipo-1 { background-color: #e3f2fd; color: #1976d2; }
        .tipo-2 { background-color: #ffebee; color: #d32f2f; }
        .tipo-3 { background-color: #f3e5f5; color: #7b1fa2; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Tabla de Usuarios</h1>
            <div>
                <a href="Admin.php" class="btn btn-primary">Volver al Admin</a>
                <a href="../Login/CerrarSesion.php" class="btn btn-danger">Cerrar Sesión</a>
            </div>
        </div>

        <div class="table-container">
            <?php if ($result->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre de Usuario</th>
                                <th>Teléfono</th>
                                <th>Tipo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id_usuario']); ?></td>
                                    <td><?php echo htmlspecialchars($row['nombreUsuario']); ?></td>
                                    <td><?php echo htmlspecialchars($row['numeroTelefono']); ?></td>
                                    <td>
                                        <?php 
                                        $tipo_texto = '';
                                        $tipo_class = '';
                                        switch($row['tipo']) {
                                            case 1:
                                                $tipo_texto = 'Cliente';
                                                $tipo_class = 'tipo-1';
                                                break;
                                            case 2:
                                                $tipo_texto = 'Administrador';
                                                $tipo_class = 'tipo-2';
                                                break;
                                            case 3:
                                                $tipo_texto = 'Vendedor';
                                                $tipo_class = 'tipo-3';
                                                break;
                                            default:
                                                $tipo_texto = 'Desconocido';
                                                $tipo_class = 'tipo-1';
                                        }
                                        ?>
                                        <span class="tipo-badge <?php echo $tipo_class; ?>">
                                            <?php echo $tipo_texto; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" 
                                                onclick="editarUsuario(<?php echo $row['id_usuario']; ?>)">
                                            Editar
                                        </button>
                                        <button class="btn btn-sm btn-danger" 
                                                onclick="eliminarUsuario(<?php echo $row['id_usuario']; ?>)">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-3">
                    <p><strong>Total de usuarios:</strong> <?php echo $result->num_rows; ?></p>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center">
                    <h4>No hay usuarios registrados</h4>
                    <p>No se encontraron usuarios en la base de datos.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function editarUsuario(id) {
            if (confirm('¿Estás seguro de que quieres editar este usuario?')) {
                // Aquí podrías redirigir a una página de edición o abrir un modal
                alert('Funcionalidad de edición para el usuario ID: ' + id);
                // window.location.href = 'editar_usuario.php?id=' + id;
            }
        }

        function eliminarUsuario(id) {
    if (confirm('¿Estás seguro de que quieres eliminar este usuario? Esta acción no se puede deshacer.')) {
        // Enviar formulario para eliminar
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'procesar_admin.php';
        
        const accionInput = document.createElement('input');
        accionInput.type = 'hidden';
        accionInput.name = 'accion';
        accionInput.value = 'baja';
        
        const idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'id_usuario';
        idInput.value = id;
        
        const fromTableInput = document.createElement('input');
        fromTableInput.type = 'hidden';
        fromTableInput.name = 'from_table';
        fromTableInput.value = '1';
        
        form.appendChild(accionInput);
        form.appendChild(idInput);
        form.appendChild(fromTableInput);
        document.body.appendChild(form);
        form.submit();
    }
}
        // Mostrar mensajes de éxito/error si vienen por URL
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('baja') === 'exito') {
                alert('Usuario eliminado correctamente');
                // Limpiar parámetros de URL
                window.history.replaceState({}, document.title, window.location.pathname);
            } else if (urlParams.get('baja') === 'error') {
                const mensaje = urlParams.get('mensaje') || 'Error desconocido';
                alert('Error al eliminar usuario: ' + mensaje);
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>