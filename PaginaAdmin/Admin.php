<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Admin.css">
   

<div class="card">
    <h2>Administración</h2>

    <button onclick="abrir('popup-alta')">Alta</button>
    <button onclick="abrir('popup-baja')">Baja</button>
    <button onclick="abrir('popup-cambio')">Cambio</button>
    <a href="CerrarSesion.php"><button class="btn btn-danger"><i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar Sesión</button></a>
</div>

<!-- Modal Alta -->
<dialog id="popup-alta">
    <h3>Alta de Cuenta</h3>
    <?php
    if (isset($_GET['alta']) && $_GET['alta'] === 'exito') {
        echo '<div class="mensaje exito">Cuenta agregada correctamente</div>';
    } elseif (isset($_GET['alta']) && $_GET['alta'] === 'error') {
        $mensaje = $_GET['mensaje'] ?? 'Error desconocido';
        echo '<div class="mensaje error">Error: ' . htmlspecialchars($mensaje) . '</div>';
    }
    ?>
<form method="POST" action="procesar_admin.php" class="formulario">
    <input type="text" name="nombreUsuario" placeholder="Nombre de Usuario" required>
    <input type="text" name="contrasena" placeholder="Contraseña" required>
    <input type="tel" name="numeroTelefono" placeholder="Número de Teléfono" required>
    <select name="tipo" required>
        <option value="">Seleccionar tipo</option>
        <option value="cliente">Cliente</option>
        <option value="administrador">Administrador</option>
    </select>
    <input type="hidden" name="accion" value="alta">
    <button type="submit">Guardar</button>
</form>
    <button class="cerrar" onclick="cerrar('popup-alta')">Cerrar</button>
</dialog>

<!-- Modal Baja -->
<dialog id="popup-baja">
    <h3>Baja de Cuenta</h3>
    <?php
    if (isset($_GET['baja']) && $_GET['baja'] === 'exito') {
        echo '<div class="mensaje exito">Cuenta eliminada correctamente</div>';
    } elseif (isset($_GET['baja']) && $_GET['baja'] === 'error') {
        $mensaje = $_GET['mensaje'] ?? 'Error desconocido';
        echo '<div class="mensaje error">Error: ' . htmlspecialchars($mensaje) . '</div>';
    }
    ?>
    <form method="POST" action="procesar_admin.php" class="formulario">
        <input type="text" name="id_usuario" placeholder="ID de usuario" required>
        <input type="hidden" name="accion" value="baja">
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>
    <button class="cerrar" onclick="cerrar('popup-baja')">Cerrar</button>
</dialog>

<!-- Modal Cambio -->
<dialog id="popup-cambio">
    <h3>Cambio de Cuenta</h3>
    <?php
    if (isset($_GET['cambio']) && $_GET['cambio'] === 'exito') {
        echo '<div class="mensaje exito">Cuenta actualizada correctamente</div>';
    } elseif (isset($_GET['cambio']) && $_GET['cambio'] === 'error') {
        $mensaje = $_GET['mensaje'] ?? 'Error desconocido';
        echo '<div class="mensaje error">Error: ' . htmlspecialchars($mensaje) . '</div>';
    }
    ?>
    <form method="POST" action="procesar_admin.php" class="formulario">
        <input type="text" name="id_usuario" placeholder="ID de usuario a modificar" required>
        <input type="password" name="nueva_contrasena" placeholder="Nueva contraseña (dejar vacío para no cambiar)">
        <input type="tel" name="nuevo_telefono" placeholder="Nuevo teléfono (dejar vacío para no cambiar)">
        <select name="nuevo_tipo">
            <option value="">Seleccionar nuevo tipo (opcional)</option>
            <option value="cliente">Cliente</option>
            <option value="administrador">Administrador</option>
            <option value="vendedor">Vendedor</option>
        </select>
        <input type="hidden" name="accion" value="cambio">
        <button type="submit">Actualizar</button>
    </form>
    <button class="cerrar" onclick="cerrar('popup-cambio')">Cerrar</button>
</dialog>

<script>
    function abrir(id) {
        document.getElementById(id).showModal();
    }

    function cerrar(id) {
        document.getElementById(id).close();
        // Limpiar parámetros de URL al cerrar
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.pathname);
        }
    }

    // Cerrar modales al hacer clic fuera de ellos
    document.addEventListener('DOMContentLoaded', function() {
        const modals = document.querySelectorAll('dialog');
        modals.forEach(modal => {
            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.close();
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.pathname);
                    }
                }
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a8d9f3784b.js" crossorigin="anonymous"></script>
</body>
</html>