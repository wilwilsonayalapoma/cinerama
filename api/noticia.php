<?php
include_once __DIR__ . '/../config/db.php';
header('Content-Type: application/json');
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
    $sql = "SELECT n.*, c.nombre as categoria, c.color as categoria_color, u.nombre as autor FROM noticias n LEFT JOIN categorias c ON n.categoria_id = c.id LEFT JOIN usuarios u ON n.usuario_id = u.id WHERE n.id = $id LIMIT 1";
    $res = $conn->query($sql);
    if ($res && $res->num_rows > 0) {
        $noticia = $res->fetch_assoc();
        $destacados = $conn->query("SELECT COUNT(*) as total FROM destacados WHERE noticia_id = $id");
        $total_destacados = $destacados ? $destacados->fetch_assoc()['total'] : 0;
        $comentarios = [];
        $res_com = $conn->query("SELECT c.comentario, c.fecha, u.nombre as autor FROM comentarios c LEFT JOIN usuarios u ON c.usuario_id = u.id WHERE c.noticia_id = $id ORDER BY c.fecha DESC");
        while ($row = $res_com->fetch_assoc()) {
            $comentarios[] = $row;
        }
        echo json_encode([
            'id' => $noticia['id'],
            'titulo' => $noticia['titulo'],
            'contenido' => $noticia['contenido'],
            'imagen' => !empty($noticia['imagen']) ? 'assets/img/' . $noticia['imagen'] : 'https://via.placeholder.com/400x250?text=Sin+Imagen',
            'fecha' => $noticia['fecha'],
            'autor' => $noticia['autor'],
            'categoria' => $noticia['categoria'],
            'categoria_color' => $noticia['categoria_color'],
            'destacados' => $total_destacados,
            'comentarios' => $comentarios
        ]);
        exit;
    }
}
echo json_encode(['error' => 'Noticia no encontrada']);
