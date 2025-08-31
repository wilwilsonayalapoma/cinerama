<?php
// guardar_permisos.php: Recibe los permisos seleccionados y los guarda en la base de datos
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = intval($_POST['usuario_id']);
    $menus = isset($_POST['menus']) ? $_POST['menus'] : [];
    // Elimina permisos anteriores
    $conn->query("DELETE FROM rol_menu WHERE rol_id = (SELECT rol_id FROM usuarios WHERE id = $usuario_id)");
    // Inserta nuevos permisos
    foreach ($menus as $menu_id) {
        $conn->query("INSERT INTO rol_menu (rol_id, menu_id) VALUES ((SELECT rol_id FROM usuarios WHERE id = $usuario_id), $menu_id)");
    }
    echo json_encode(['success' => true]);
    exit;
}
?>
