<?php
include_once __DIR__ . '/../config/db.php';
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['correo']) && isset($_POST['password'])) {
    $correo = $conn->real_escape_string($_POST['correo']);
    $password = $_POST['password'];
    $res = $conn->query("SELECT id, nombre, correo, password, rol_id FROM usuarios WHERE correo='$correo' LIMIT 1");
    if ($res && $res->num_rows > 0) {
        $user = $res->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            echo json_encode([
                'success' => true,
                'id' => $user['id'],
                'nombre' => $user['nombre'],
                'correo' => $user['correo'],
                'rol_id' => $user['rol_id']
            ]);
            exit;
        }
    }
    echo json_encode(['success' => false, 'msg' => 'Credenciales incorrectas']);
    exit;
}
echo json_encode(['success' => false, 'msg' => 'Datos incompletos']);
