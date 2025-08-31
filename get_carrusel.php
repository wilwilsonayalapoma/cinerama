<?php
// get_carrusel.php: Devuelve las imágenes del carrusel desde la base de datos
include_once __DIR__ . '/config/db.php';
$res = $conn->query("SELECT * FROM publicidad WHERE espacio = 'carrusel' ORDER BY id DESC");
$carrusel = [];
while ($img = $res->fetch_assoc()) {
    $carrusel[] = [
        'imagen' => 'assets/img/' . $img['imagen'],
        'link' => $img['link'],
        'nombre' => $img['nombre']
    ];
}
header('Content-Type: application/json');
echo json_encode($carrusel);
