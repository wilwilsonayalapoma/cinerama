<?php
// conexion.php para admin
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'cinerama';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    error_log('Error de conexión: ' . $conn->connect_error);
    die('Error de conexión: ' . $conn->connect_error);
}
?>
