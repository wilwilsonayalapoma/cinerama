<?php
include_once __DIR__ . '/../config/db.php';
header('Content-Type: application/json');
$res = $conn->query("SELECT * FROM publicidad ORDER BY fecha DESC");
$imagenes = [];
while ($row = $res->fetch_assoc()) {
    $imagenes[] = [
        'id' => $row['id'],
        'imagen' => 'assets/img/' . $row['imagen'],
        'nombre' => $row['nombre'],
        'link' => $row['link']
    ];
}
echo json_encode($imagenes);
