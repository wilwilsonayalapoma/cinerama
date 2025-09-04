<?php
// noticias.php - API para CRUD de noticias
header('Content-Type: application/json');
require_once __DIR__ . '/conexion.php';

$accion = isset($_REQUEST['accion']) ? $_REQUEST['accion'] : 'listar';

switch($accion) {
  case 'listar':
  $res = $conn->query("SELECT n.id, n.titulo, n.resumen, n.contenido, n.categoria_id, c.nombre as categoria, c.color, n.usuario_id, u.nombre as usuario, n.fecha, n.imagen FROM noticias n LEFT JOIN categorias c ON n.categoria_id = c.id LEFT JOIN usuarios u ON n.usuario_id = u.id ORDER BY n.id DESC");
    $noticias = [];
    while($row = $res->fetch_assoc()) {
      $noticias[] = $row;
    }
    echo json_encode($noticias);
    break;
  case 'crear':
    $titulo = $_POST['titulo'] ?? '';
    $resumen = $_POST['resumen'] ?? '';
    $contenido = $_POST['contenido'] ?? '';
    $categoria_id = $_POST['categoria_id'] ?? '';
    $usuario_id = $_POST['usuario_id'] ?? '';
    $imagen = NULL;
    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
      $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
      $nombre_archivo = 'noticia_' . uniqid() . '.' . $ext;
      $ruta = '../assets/img/' . $nombre_archivo;
      if(move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)) {
        $imagen = $nombre_archivo;
      }
    }
    if($titulo && $contenido && $categoria_id && $usuario_id) {
      $stmt = $conn->prepare("INSERT INTO noticias (titulo, resumen, contenido, categoria_id, usuario_id, imagen) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param('sssiss', $titulo, $resumen, $contenido, $categoria_id, $usuario_id, $imagen);
      $ok = $stmt->execute();
      echo json_encode(['success' => $ok]);
    } else {
      echo json_encode(['success' => false]);
    }
    break;
  case 'editar':
    $id = $_POST['id'] ?? '';
    $titulo = $_POST['titulo'] ?? '';
    $resumen = $_POST['resumen'] ?? '';
    $contenido = $_POST['contenido'] ?? '';
    $categoria_id = $_POST['categoria_id'] ?? '';
    $usuario_id = $_POST['usuario_id'] ?? '';
    $imagen = $_POST['imagen'] ?? NULL;
    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
      $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
      $nombre_archivo = 'noticia_' . uniqid() . '.' . $ext;
      $ruta = '../assets/img/' . $nombre_archivo;
      if(move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)) {
        $imagen = $nombre_archivo;
      }
    }
    if($id && $titulo && $contenido && $categoria_id && $usuario_id) {
      $stmt = $conn->prepare("UPDATE noticias SET titulo=?, resumen=?, contenido=?, categoria_id=?, usuario_id=?, imagen=? WHERE id=?");
      $stmt->bind_param('sssissi', $titulo, $resumen, $contenido, $categoria_id, $usuario_id, $imagen, $id);
      $ok = $stmt->execute();
      echo json_encode(['success' => $ok]);
    } else {
      echo json_encode(['success' => false]);
    }
    break;
  case 'eliminar':
    $id = $_POST['id'] ?? '';
    if($id) {
      $stmt = $conn->prepare("DELETE FROM noticias WHERE id=?");
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
