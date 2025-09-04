<?php
// login.php - Procesa el login de administrador
session_start();
require_once '../config/db.php'; // Ajusta la ruta según tu estructura

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Consulta solo el usuario administrador (rol_id = 1)
    $sql = "SELECT * FROM usuarios WHERE correo = ? AND rol_id = 1 LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $correo);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_correo'] = $admin['correo'];
        header('Location: panel.php');
        exit;
    } else {
        echo '<div class="alert alert-danger">Credenciales incorrectas o no eres administrador.</div>';
    }
}
?>
