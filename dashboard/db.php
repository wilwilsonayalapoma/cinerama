<?php
// Conexión a la base de datos MySQL
$host = 'localhost';
$user = 'root'; // Cambia por tu usuario de MySQL
$pass = '';
$dbname = 'cinerama';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}
?>
