<?php
session_start(); // Inicia o reanuda la sesión
session_destroy(); // Destruye la sesión
header("Location: ../login.html"); // Redirige a la página de inicio
exit();
?>