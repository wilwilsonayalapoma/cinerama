<?php
// publicidad.php - API para CRUD de publicidad
header('Content-Type: application/json');
require_once __DIR__ . '/conexion.php';

$accion = isset($_REQUEST['accion']) ? $_REQUEST['accion'] : 'listar';

switch($accion) {
  case 'listar':
    $res = $conn->query("SELECT id, nombre, imagen, link, espacio FROM publicidad ORDER BY id DESC");
    $publicidad = [];
    while($row = $res->fetch_assoc()) {
      $publicidad[] = $row;
    }
    echo json_encode($publicidad);
    break;
  case 'crear':
    $nombre = $_POST['nombre'] ?? '';
    $link = $_POST['link'] ?? '';
    $espacio = $_POST['espacio'] ?? '';
    $imagen = NULL;
    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
      $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
      $nombre_archivo = 'publicidad_' . uniqid() . '.' . $ext;
      $ruta = '../assets/img/' . $nombre_archivo;
      if(move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)) {
        $imagen = $nombre_archivo;
      }
    }
    if($nombre && $espacio) {
      $stmt = $conn->prepare("INSERT INTO publicidad (nombre, imagen, link, espacio) VALUES (?, ?, ?, ?)");
      $stmt->bind_param('ssss', $nombre, $imagen, $link, $espacio);
      $ok = $stmt->execute();
      echo json_encode(['success' => $ok]);
    } else {
      echo json_encode(['success' => false]);
    }
    break;
  case 'editar':
    $id = $_POST['id'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $link = $_POST['link'] ?? '';
    $espacio = $_POST['espacio'] ?? '';
    $imagen = $_POST['imagen'] ?? NULL;
    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
      $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
      $nombre_archivo = 'publicidad_' . uniqid() . '.' . $ext;
      $ruta = '../assets/img/' . $nombre_archivo;
      if(move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)) {
        $imagen = $nombre_archivo;
      }
    }
    if($id && $nombre && $espacio) {
      $stmt = $conn->prepare("UPDATE publicidad SET nombre=?, imagen=?, link=?, espacio=? WHERE id=?");
      $stmt->bind_param('ssssi', $nombre, $imagen, $link, $espacio, $id);
      $ok = $stmt->execute();
      echo json_encode(['success' => $ok]);
    } else {
      echo json_encode(['success' => false]);
    }
    break;
  case 'eliminar':
    $id = $_POST['id'] ?? '';
    if($id) {
      $stmt = $conn->prepare("DELETE FROM publicidad WHERE id=?");
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
?>
