<?php
session_start();

// Credenciales de acceso a la base de datos
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'ucabits';

// Conexión a la base de datos
$conexion = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_error()) {
    exit('Fallo en la conexión de MySQL: ' . mysqli_connect_error());
}

// Validar si se ha enviado información
if (!isset($_POST['username'], $_POST['password'])) {
    // Si no hay datos, redirigir al login
    header('Location: login.html');
    exit;
}

// Evitar inyección SQL
if ($stmt = $conexion->prepare('SELECT id_usuario, contrasena FROM cuentas WHERE nombreUsuario = ?')) {

    // Parámetro de enlace
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    // Validar si el usuario existe
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_usuario, $contrasena);
        $stmt->fetch();

        // Comparar contraseñas (aquí sin hash, pero se recomienda usar password_hash)
        if ($_POST['password'] === $contrasena) {

            // Crear sesión
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id_usuario;

            // Redirigir al panel principal
            header('Location: PaginasUsuarios\UsuariosPrincipal.php');
            exit;
        } else {
            // Contraseña incorrecta
            header('Location: login.html');
            exit;
        }
    } else {
        // Usuario no encontrado
        header('Location: login.html');
        exit;
    }
}

    $stmt->close();
?>
