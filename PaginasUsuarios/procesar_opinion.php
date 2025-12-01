<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../Login/login.html");
    exit;
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'ucabits';

$conexion = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_error()) {
    exit('Fallo en la conexión de MySQL: ' . mysqli_connect_error());
}

if (!isset($_POST['rating'], $_POST['comment'])) {
    die('Por favor, complete la calificación y el comentario.');
}

$calificacion = intval($_POST['rating']);
$descripcion = mysqli_real_escape_string($conexion, $_POST['comment']);

// Insertar la opinión en la base de datos (solo calificacion y descripcion)
$sql = "INSERT INTO opinion (calificacion, descripcion) VALUES (?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param('is', $calificacion, $descripcion);
if ($stmt->execute()) {
    echo "<script>alert('Gracias por su opinión.'); window.location.href='UsuariosPrincipal.php';</script>";
} else {
    echo "<script>alert('Error al enviar la opinión.'); window.history.back();</script>";
}
$stmt->close();
?>