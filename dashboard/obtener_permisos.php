<?php
// obtener_permisos.php: Devuelve los menús asignados al usuario
include '../config/db.php';
header('Content-Type: application/json');

$usuario_id = isset($_GET['usuario_id']) ? intval($_GET['usuario_id']) : 0;
$menus_asignados = [];
if ($usuario_id > 0) {
    $sql = "SELECT menu_id FROM rol_menu WHERE rol_id = (SELECT rol_id FROM usuarios WHERE id = $usuario_id)";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $menus_asignados[] = strval($row['menu_id']);
    }
}
echo json_encode(['menus_asignados' => $menus_asignados]);
