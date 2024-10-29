<?php
/*session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html"); // Redirige a la página de inicio de sesión si no está autenticado
    exit;
}*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de la Intranet de Notaría</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <header>
        <h1>Intranet de Notaría - Dashboard</h1>
    </header>

    <aside class="sidebar">
        <h3>Menú de Navegación</h3>
        <ul class="d-flex flex-column">
            <li><a href="dashboard.php">Inicio</a></li>
            <li><a href="pages/Protocolares.php">Protocolares</a></li>
            <li><a href="pages/ExtraProtocolares.php">ExtraProtocolares</a></li>
            <li><a href="#">Configuración</a></li>
            <li><a href="#">Cerrar Sesión</a></li>
        </ul>
    </aside>

    <main class="content">
        <h2>Bienvenido al Panel de Control</h2>
        <p>Accede a las herramientas y recursos administrativos de la notaría.</p>

        <!-- Contenido de la Página Principal del Dashboard -->
        <div class="dashboard-section">
            <h3>Últimos Documentos</h3>
            <p>Aquí puedes ver los documentos recientes procesados en la notaría.</p>
            <ul>
                <li>Documento 1</li>
                <li>Documento 2</li>
                <li>Documento 3</li>
            </ul>
        </div>

        <div class="dashboard-section">
            <h3>Lista de Clientes</h3>
            <p>Aquí puedes ver y gestionar la lista de clientes de la notaría.</p>
            <ul>
                <li>Cliente 1</li>
                <li>Cliente 2</li>
                <li>Cliente 3</li>
            </ul>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Notaría - Todos los derechos reservados</p>
    </footer>
</html>
