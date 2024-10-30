<?php
session_start();
include("../conexion.php"); // Incluye tu archivo de conexión a MySQL


// Definir constantes para la API de OneDrive
define('CLIENT_ID', 'TU_CLIENT_ID');
define('CLIENT_SECRET', 'TU_CLIENT_SECRET');
define('REDIRECT_URI', 'TU_REDIRECT_URI');
define('SCOPE', 'Files.ReadWrite');

$accessToken = ''; // Variable para el token de acceso

// Manejar la respuesta del inicio de sesión de OneDrive
if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // Solicitar el token de acceso
    $url = 'https://login.microsoftonline.com/common/oauth2/v2.0/token';
    $data = [
        'client_id' => CLIENT_ID,
        'client_secret' => CLIENT_SECRET,
        'code' => $code,
        'redirect_uri' => REDIRECT_URI,
        'grant_type' => 'authorization_code',
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $tokenData = json_decode($response);
    $accessToken = $tokenData->access_token;
}

// Manejar la subida de archivos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['documento'])) {
    $filePath = $_FILES['documento']['tmp_name'];
    $fileName = $_FILES['documento']['name'];

    // Subir archivo a OneDrive
    $uploadUrl = 'https://graph.microsoft.com/v1.0/me/drive/root:/' . $fileName . ':/content';
    $options = [
        'http' => [
            'header' => "Authorization: Bearer $accessToken\r\n" .
                        "Content-Type: application/octet-stream\r\n",
            'method' => 'PUT',
            'content' => file_get_contents($filePath),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($uploadUrl, false, $context);

    if ($result) {
        // Inserción en la base de datos
        $rutaArchivo = 'https://onedrive.live.com/?cid=YOUR_CID&resid=' . urlencode($fileName); // Reemplaza con la URL de acceso real
        $stmt = $conn->prepare("INSERT INTO documentos (nombre_archivo, ruta_archivo) VALUES (?, ?)");
        $stmt->bind_param("ss", $fileName, $rutaArchivo);
        $stmt->execute();
        $stmt->close();

        echo "<div class='alert alert-success'>El archivo se ha subido correctamente y registrado en la base de datos.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error al subir el archivo.</div>";
    }
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
            <li><a href="dashboard.php">Inicio</a></li>
            <li><a href="pages/Protocolares.php">Protocolares</a></li>
            <li><a href="pages/ExtraProtocolares.php">ExtraProtocolares</a></li>
            <li><a href="#">Reportes</a></li>
            <li><a href="#">Cerrar sesión</a></li>
        </ul>
    </aside>

    <main class="content">
        <h2>Cargar Documentos Protocolares</h2>
        <form action="" method="post" enctype="multipart/form-data">
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
