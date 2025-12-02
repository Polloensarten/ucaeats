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

// Determinar la acción a realizar
$accion = $_POST['accion'] ?? '';

switch ($accion) {
    case 'alta':
        altaCuenta($conn);
        break;
    case 'baja':
        bajaCuenta($conn);
        break;
    case 'cambio':
        cambioCuenta($conn);
        break;
    default:
        header("Location: Admin.php?error=accion_no_valida");
        exit;
}

function altaCuenta($conn) {
    // Obtener datos del formulario
    $nombreUsuario = trim($_POST['nombreUsuario'] ?? '');
    $contrasena = trim($_POST['contrasena'] ?? '');
    $numeroTelefono = trim($_POST['numeroTelefono'] ?? '');
    $tipo = trim($_POST['tipo'] ?? '');
    
    // Validar que todos los campos estén presentes
    if (empty($nombreUsuario) || empty($contrasena) || empty($numeroTelefono) || empty($tipo)) {
        header("Location: Admin.php?alta=error&mensaje=campos_incompletos");
        exit;
    }
    
    // Convertir tipo a número según la base de datos
    $tipos_map = [
        'cliente' => 1,
        'administrador' => 2,
        'vendedor' => 3
    ];
    
    $tipo_numero = $tipos_map[$tipo] ?? 0;
    if ($tipo_numero === 0) {
        header("Location: Admin.php?alta=error&mensaje=tipo_no_valido");
        exit;
    }

    // Verificar si el nombre de usuario ya existe
    $sql_check = "SELECT id_usuario FROM cuentas WHERE nombreUsuario = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $nombreUsuario);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        header("Location: Admin.php?alta=error&mensaje=usuario_existente");
        exit;
    }
    $stmt_check->close();

    // Insertar nueva cuenta (contraseña en texto plano como en el registro)
    $sql = "INSERT INTO cuentas (nombreUsuario, contrasena, numeroTelefono, tipo) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nombreUsuario, $contrasena, $numeroTelefono, $tipo_numero);

    if ($stmt->execute()) {
        header("Location: Admin.php?alta=exito");
    } else {
        header("Location: Admin.php?alta=error&mensaje=error_bd");
    }
    $stmt->close();
}

function bajaCuenta($conn) {
    $id_usuario = intval(trim($_POST['id_usuario'] ?? ''));

    if ($id_usuario <= 0) {
        header("Location: Admin.php?baja=error&mensaje=id_no_valido");
        exit;
    }

    // Verificar si la cuenta existe
    $sql_check = "SELECT id_usuario FROM cuentas WHERE id_usuario = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $id_usuario);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows === 0) {
        header("Location: Admin.php?baja=error&mensaje=cuenta_no_existe");
        exit;
    }
    $stmt_check->close();

    // Eliminar cuenta
    $sql = "DELETE FROM cuentas WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        // Redirigir dependiendo de desde dónde se llamó
        if (isset($_POST['from_table']) && $_POST['from_table'] === '1') {
            header("Location: ver_tabla.php?baja=exito");
        } else {
            header("Location: Admin.php?baja=exito");
        }
    } else {
        if (isset($_POST['from_table']) && $_POST['from_table'] === '1') {
            header("Location: ver_tabla.php?baja=error&mensaje=error_eliminar");
        } else {
            header("Location: Admin.php?baja=error&mensaje=error_eliminar");
        }
    }
    $stmt->close();
}

function cambioCuenta($conn) {
    $id_usuario = intval(trim($_POST['id_usuario'] ?? ''));
    $nueva_contrasena = trim($_POST['nueva_contrasena'] ?? '');
    $nuevo_telefono = trim($_POST['nuevo_telefono'] ?? '');
    $nuevo_tipo = trim($_POST['nuevo_tipo'] ?? '');

    if ($id_usuario <= 0) {
        header("Location: Admin.php?cambio=error&mensaje=id_no_valido");
        exit;
    }

    // Verificar si la cuenta existe
    $sql_check = "SELECT id_usuario FROM cuentas WHERE id_usuario = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $id_usuario);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows === 0) {
        header("Location: Admin.php?cambio=error&mensaje=cuenta_no_existe");
        exit;
    }
    $stmt_check->close();

    // Construir consulta dinámica
    $updates = [];
    $params = [];
    $types = "";

    if (!empty($nueva_contrasena)) {
        $updates[] = "contrasena = ?";
        $params[] = $nueva_contrasena;
        $types .= "s";
    }

    if (!empty($nuevo_telefono)) {
        $updates[] = "numeroTelefono = ?";
        $params[] = $nuevo_telefono;
        $types .= "s";
    }

    if (!empty($nuevo_tipo)) {
        $tipos_map = [
            'cliente' => 1,
            'administrador' => 2,
        ];
        
        $tipo_numero = $tipos_map[$nuevo_tipo] ?? 0;
        if ($tipo_numero === 0) {
            header("Location: Admin.php?cambio=error&mensaje=tipo_no_valido");
            exit;
        }

        $updates[] = "tipo = ?";
        $params[] = $tipo_numero;
        $types .= "i";
    }

    if (empty($updates)) {
        header("Location: Admin.php?cambio=error&mensaje=sin_cambios");
        exit;
    }

    $params[] = $id_usuario;
    $types .= "i";

    $sql = "UPDATE cuentas SET " . implode(", ", $updates) . " WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        header("Location: Admin.php?cambio=exito");
    } else {
        header("Location: Admin.php?cambio=error&mensaje=error_actualizar");
    }

    $stmt->close();
}

$conn->close();
?>