<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html"); // Redirige a la página de inicio de sesión si no está autenticado
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de la Intranet de Notaría</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Intranet de Notaría - Dashboard</h1>
    </header>

    <main>
        <section class="sidebar">
            <h3>Menú de Navegación</h3>
            <ul>
                <li><a href="dashboard.php">Inicio</a></li>
                <li><a href="documentos.php">Documentos</a></li>
                <li><a href="clientes.php">Clientes</a></li>
                <li><a href="configuracion.php">Configuración</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </section>

        <section class="content">
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
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Notaría - Todos los derechos reservados</p>
    </footer>
</body>
</html>
