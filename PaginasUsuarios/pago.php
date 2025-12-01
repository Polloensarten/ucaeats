<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../Login/login.html");
    exit;
}

// Aquí podrías procesar el pago y vaciar el carrito
// Por simplicidad, vaciamos el carrito y mostramos un mensaje
unset($_SESSION['carrito']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pago Exitoso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .success-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
        }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">¡Pago exitoso!</h4>
            <p>Gracias por su compra. Su pedido ha sido procesado correctamente.</p>
            <hr>
            <p class="mb-0">Será redirigido automáticamente a la página principal en 5 segundos.</p>
        </div>
        <a href="../PaginasUsuarios/UsuariosPrincipal.php" class="btn btn-primary mt-3">Volver ahora</a>
    </div>

    <script>
        // Redirigir después de 5 segundos
        setTimeout(function() {
            window.location.href = '../PaginasUsuarios/UsuariosPrincipal.php';
        }, 5000);
    </script>
</body>
</html>