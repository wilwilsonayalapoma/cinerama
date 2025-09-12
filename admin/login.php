<?php
// login.php - Procesa el login de administrador
session_start();
require_once '../config/db.php'; // Ajusta la ruta según tu estructura

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Consulta usuario por correo
    $sql = "SELECT * FROM usuarios WHERE correo = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $correo);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin['password'])) {
        // Solo permitir acceso a Administrador o Editor
        $rol_nombre = '';
        if (isset($admin['rol_id'])) {
            if ($admin['rol_id'] == 1) $rol_nombre = 'Administrador';
            elseif ($admin['rol_id'] == 2) $rol_nombre = 'Editor';
            elseif ($admin['rol_id'] == 3) $rol_nombre = 'Usuario';
        }
        if ($rol_nombre === 'Administrador' || $rol_nombre === 'Editor') {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_correo'] = $admin['correo'];
            $_SESSION['admin_rol'] = $rol_nombre;
            header('Location: panel.php');
            exit;
        } else {
            echo '<div class="alert alert-danger">No tienes permisos para acceder al panel.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Credenciales incorrectas.</div>';
    }
}
?>
