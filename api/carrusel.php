<?php
header('Content-Type: application/json');
require_once '../config/db.php'; // Ajusta la ruta si es necesario

// Conexión
$conn = getDbConnection();

// Consulta: solo imágenes del espacio 'carrusel'
$sql = "SELECT nombre, imagen, link FROM publicidad WHERE espacio = 'carrusel' ORDER BY id DESC";
$result = $conn->query($sql);

$carrusel = [];
while ($row = $result->fetch_assoc()) {
    $carrusel[] = [
        'titulo' => $row['nombre'],
        'imagen' => $row['imagen'],
        'descripcion' => $row['link'] ? '<a href=\'' . $row['link'] . '\' target=\'_blank\'>Ver más</a>' : '',
        'link' => $row['link']
    ];
}

$conn->close();
echo json_encode($carrusel);
