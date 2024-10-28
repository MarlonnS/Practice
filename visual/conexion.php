<?php
$serverName = "localhost";
$connectionOptions = array(
    "Database" => "IntranetNotaria",
    "Uid" => "tu_usuario",
    "PWD" => "tu_contraseña"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn) {
    echo "Conexión exitosa a SQL Server";
} else {
    echo "Error de conexión";
    die(print_r(sqlsrv_errors(), true));
}
?>
