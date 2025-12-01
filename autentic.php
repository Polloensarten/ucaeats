<?php
session_start();

// Credenciales de acceso a la base de datos
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'ucabits';

try {
    // Conexión a la base de datos
    $conexion = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    
    if (mysqli_connect_error()) {
        throw new Exception('Fallo en la conexión de MySQL: ' . mysqli_connect_error());
    }

    // Validar si se ha enviado información
    if (!isset($_POST['username'], $_POST['password'])) {
        throw new Exception('Por favor, ingrese usuario y contraseña.');
    }

    // Evitar inyección SQL
    if ($stmt = $conexion->prepare('SELECT id_usuario, contrasena, tipo FROM cuentas WHERE nombreUsuario = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();

        // Validar si el usuario existe
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id_usuario, $contrasena, $tipo);
            $stmt->fetch();

            // Comparar contraseñas
            if ($_POST['password'] === $contrasena) {
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['username'];
                $_SESSION['id'] = $id_usuario;
                $_SESSION['tipo'] = $tipo;

                // Redirecciones según el tipo
                if ($tipo == 2) {
                    header('Location: PaginaAdmin/Admin.php');
                } else {
                    header('Location: PaginasUsuarios/UsuariosPrincipal.php');
                }
                exit;
            } else {
                throw new Exception('Contraseña incorrecta.');
            }
        } else {
            throw new Exception('Usuario no registrado.');
        }
        $stmt->close();
    } else {
        throw new Exception('No se pudo preparar la consulta.');
    }
} catch (Exception $e) {
    // Mostrar mensaje de error y redirigir al login
    echo "<script>alert('".$e->getMessage()."'); window.location.href='login.html';</script>";
    exit;
}
?>