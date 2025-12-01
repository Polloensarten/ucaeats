<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'ucabits';

$conexion = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_error()) {
    exit('Fallo en la conexión de MySQL: ' . mysqli_connect_error());
}

if (!isset($_POST['usuario'], $_POST['password'], $_POST['telefono'])) {
    exit('Por favor, complete el formulario.');
}

// Validar y limpiar datos
$usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
$password = mysqli_real_escape_string($conexion, $_POST['password']);
$telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
$tipo = 1; // Por defecto, tipo cliente

// Verificar si el usuario ya existe
if ($stmt = $conexion->prepare('SELECT id_usuario FROM cuentas WHERE nombreUsuario = ?')) {
    $stmt->bind_param('s', $usuario);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo "<script>alert('El usuario ya existe.'); window.history.back();</script>";
    } else {
        // Insertar nuevo usuario
        if ($stmt = $conexion->prepare('INSERT INTO cuentas (nombreUsuario, contrasena, numeroTelefono, tipo) VALUES (?, ?, ?, ?)')) {
            $stmt->bind_param('sssi', $usuario, $password, $telefono, $tipo);
            $stmt->execute();
            echo "<script>alert('Registro exitoso.'); window.location.href='login.html';</script>";
        } else {
            echo "<script>alert('Error al registrar.'); window.history.back();</script>";
        }
    }
    $stmt->close();
} else {
    echo "<script>alert('Error en la consulta.'); window.history.back();</script>";
}
?>