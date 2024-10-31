<?php
session_start();
include("../conexion.php"); // Incluye la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['documento'])) {
    // Obtener detalles del archivo
    $fileName = $_FILES['documento']['name'];
    $fileType = $_FILES['documento']['type'];
    $fileTempPath = $_FILES['documento']['tmp_name'];

    // Verificar si el archivo se subió correctamente
    if (is_uploaded_file($fileTempPath)) {
        // Leer el contenido del archivo en binario
        $fileContent = file_get_contents($fileTempPath);
        
        if ($fileContent === false) {
            echo "<div class='alert alert-danger'>Error al leer el contenido del archivo.</div>";
            exit;
        }

        // Preparar la consulta para insertar el archivo en la base de datos
        $sql = "INSERT INTO documentos (nombre_archivo, tipo_archivo, contenido) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Enlace de parámetros (usamos 'ssb' para 'string, string, binary')
            $stmt->bind_param("ssb", $fileName, $fileType, $fileContent);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Archivo subido correctamente.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error al ejecutar la consulta: " . $stmt->error . "</div>";
            }

            $stmt->close();
        } else {
            echo "<div class='alert alert-danger'>Error en la preparación de la consulta: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Error en la subida del archivo. Intente nuevamente.</div>";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Protocolares - Intranet de Notaría</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <header>
        <h1>Intranet de Notaría - Protocolares</h1>
    </header>

    <aside class="sidebar">
        <h3>Menú</h3>
        <ul class="d-flex flex-column">
            <li><a href="../dashboard.php">Inicio</a></li>
            <li><a href="Protocolares.php">Protocolares</a></li>
            <li><a href="ExtraProtocolares.php">ExtraProtocolares</a></li>
            <li><a href="#">Reportes</a></li>
            <li><a href="logout.php">Cerrar sesión</a></li>
        </ul>
    </aside>

    <main class="content">
        <h2>Cargar Documentos Protocolares</h2>
        <form action="Protocolares.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="documento">Seleccionar documento:</label>
                <input type="file" class="form-control" name="documento" required>
            </div>
            <button type="submit" class="btn btn-primary">Subir Documento</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Notaría - Todos los derechos reservados</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
