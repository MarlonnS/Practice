<?php
// Configuración de la base de datos
$host = 'localhost';  // Cambia esto si usas un host diferente
$dbname = 'usuarios';
$username = 'root'; // Cambia por tu usuario de MySQL
$password = 'GroverMorales109#'; // Cambia por tu contraseña de MySQL

// Crear conexión con la base de datos usando MySQLi
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
