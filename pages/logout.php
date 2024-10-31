<?php
// Iniciar la sesión
session_start();

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión actual
session_destroy();

// Redirigir al usuario a la página de inicio de sesión (por ejemplo, "index.php")
header("Location: ../index.html");
exit;
?>