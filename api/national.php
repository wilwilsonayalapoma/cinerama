
<?php
require_once __DIR__ . '/../config/db.php';
header('Content-Type: application/json');

$categoria_nacional = $conn->query("SELECT id, color FROM categorias WHERE nombre = 'Nacional' LIMIT 1")->fetch_assoc();
$nacional_id = $categoria_nacional ? $categoria_nacional['id'] : 0;
$nacional_color = $categoria_nacional ? $categoria_nacional['color'] : '#293E5A';

$noticias = $conn->query("SELECT * FROM noticias WHERE categoria_id = $nacional_id ORDER BY fecha DESC LIMIT 5");
$result = [];
while ($noticia = $noticias->fetch_assoc()) {
    $destacados = $conn->query("SELECT COUNT(*) as total FROM destacados WHERE noticia_id = " . $noticia['id']);
    $total_destacados = $destacados ? $destacados->fetch_assoc()['total'] : 0;
    $result[] = [
        'id' => $noticia['id'],
        'titulo' => $noticia['titulo'],
        'resumen' => $noticia['resumen'],
        'imagen' => !empty($noticia['imagen']) ? 'assets/img/' . $noticia['imagen'] : 'https://via.placeholder.com/400x250?text=Sin+Imagen',
        'fecha' => date('d/m/Y', strtotime($noticia['fecha'])),
        'destacados' => $total_destacados,
        'categoria' => 'Nacional',
        'categoria_color' => $nacional_color
    ];
}
$conn->close();
echo json_encode($result);
