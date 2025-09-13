<?php
// Conexión a la base de datos MySQL
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'cinerama';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    error_log('Error de conexión: ' . $conn->connect_error);
    // Para API, devolver JSON en lugar de die()
    if (php_sapi_name() !== 'cli') {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'msg' => 'Error de conexión a la base de datos']);
        exit;
    } else {
        die('Error de conexión: ' . $conn->connect_error);
    }
}

// Asegúrate de que NO HAYA espacios en blanco ni saltos de línea después de esta línea
?>