<?php
// buscar_usuario.php: Devuelve usuarios por nombre para autocompletar
include '../config/db.php';
header('Content-Type: application/json');

$term = isset($_GET['term']) ? $conn->real_escape_string($_GET['term']) : '';
$usuarios = [];
if ($term !== '') {
    $res = $conn->query("SELECT id, nombre FROM usuarios WHERE nombre LIKE '%$term%' LIMIT 10");
    while ($row = $res->fetch_assoc()) {
        $usuarios[] = [
            'id' => $row['id'],
            'label' => $row['nombre'],
            'value' => $row['nombre']
        ];
    }
}
echo json_encode($usuarios);
