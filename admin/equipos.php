<?php
// equipos.php - API para CRUD de equipos deportivos
header('Content-Type: application/json');
require_once __DIR__ . '/conexion.php';

$accion = $_REQUEST['accion'] ?? 'listar';

switch($accion) {
  case 'reset_puntos':
    session_start();
    $rol = $_SESSION['admin_rol'] ?? '';
    if ($rol === 'Administrador' || $rol === 'Editor') {
      $ok = $conn->query("UPDATE equipos SET puntos=0");
      echo json_encode(['success' => $ok]);
    } else {
      echo json_encode(['success' => false, 'error' => 'No autorizado']);
    }
    break;
  case 'listar':
    $res = $conn->query("SELECT id, nombre, puntos FROM equipos ORDER BY puntos DESC, nombre ASC");
    $equipos = [];
    while($row = $res->fetch_assoc()) {
      $equipos[] = $row;
    }
    echo json_encode($equipos);
    break;
  case 'crear':
    $nombre = $_POST['nombre'] ?? '';
    $puntos = $_POST['puntos'] ?? 0;
    if($nombre !== '') {
      $stmt = $conn->prepare("INSERT INTO equipos (nombre, puntos) VALUES (?, ?)");
      $stmt->bind_param('si', $nombre, $puntos);
      $ok = $stmt->execute();
      echo json_encode(['success' => $ok]);
    } else {
      echo json_encode(['success' => false]);
    }
    break;
  case 'actualizar':
    $id = $_POST['id'] ?? '';
    $puntos = $_POST['puntos'] ?? 0;
    if($id !== '') {
      $stmt = $conn->prepare("UPDATE equipos SET puntos=? WHERE id=?");
      $stmt->bind_param('ii', $puntos, $id);
      $ok = $stmt->execute();
      echo json_encode(['success' => $ok]);
    } else {
      echo json_encode(['success' => false]);
    }
    break;
  case 'eliminar':
    $id = $_POST['id'] ?? '';
    if($id !== '') {
      $stmt = $conn->prepare("DELETE FROM equipos WHERE id=?");
      $stmt->bind_param('i', $id);
      $ok = $stmt->execute();
      echo json_encode(['success' => $ok]);
    } else {
      echo json_encode(['success' => false]);
    }
    break;
  default:
    echo json_encode([]);
}
