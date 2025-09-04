
<?php
require_once __DIR__ . '/../config/db.php';
header('Content-Type: application/json');

// Video principal destacado
$video = [
    'src' => 'https://owncloud1692001.fasthostunlimited.com/embed/video',
    'titulo' => 'Video Destacado: Título de la Noticia Principal',
    'descripcion' => 'Descripción completa del video noticia. Este contenido ha sido embedido desde el servidor propio y representa la noticia más importante del día.',
    'fecha' => date('d/m/Y'),
    'en_vivo' => true
];

// Últimas noticias
$ultimas = [];
$sql = "SELECT n.*, c.nombre as categoria, c.color as categoria_color,
    (SELECT COUNT(*) FROM destacados d WHERE d.noticia_id = n.id) as destacados,
    (SELECT COUNT(*) FROM comentarios cm WHERE cm.noticia_id = n.id) as comentarios
    FROM noticias n LEFT JOIN categorias c ON n.categoria_id = c.id ORDER BY n.fecha DESC LIMIT 4";
$res = $conn->query($sql);
while ($row = $res->fetch_assoc()) {
        $ultimas[] = [
                'id' => $row['id'],
                'titulo' => $row['titulo'],
                'resumen' => $row['resumen'],
                'imagen' => !empty($row['imagen']) ? 'assets/img/' . $row['imagen'] : 'https://via.placeholder.com/400x250?text=Sin+Imagen',
                'categoria' => $row['categoria'],
                'categoria_color' => $row['categoria_color'],
                'destacados' => $row['destacados'],
                'comentarios' => $row['comentarios'],
                'fecha' => date('d/m/Y H:i', strtotime($row['fecha']))
        ];
}

// Noticias destacadas (simulado, puedes cambiar la consulta)
// Noticias destacadas del día (por destacados y fecha de hoy)
// Noticias destacadas del día (por cantidad de destacados y fecha de hoy)
$destacadas_dia = [];
$hoy = date('Y-m-d');
$sql = "SELECT n.*, c.nombre as categoria, c.color as categoria_color, (SELECT COUNT(*) FROM destacados d WHERE d.noticia_id = n.id) as destacados FROM noticias n LEFT JOIN categorias c ON n.categoria_id = c.id WHERE DATE(n.fecha) = '$hoy' ORDER BY destacados DESC LIMIT 3";
$res = $conn->query($sql);
while ($row = $res->fetch_assoc()) {
    $destacadas_dia[] = [
        'id' => $row['id'],
        'titulo' => $row['titulo'],
        'resumen' => $row['resumen'],
        'imagen' => !empty($row['imagen']) ? 'assets/img/' . $row['imagen'] : 'assets/img/fondo1-1.webp',
        'categoria' => $row['categoria'],
        'categoria_color' => $row['categoria_color'],
        'destacados' => $row['destacados'],
        'fecha' => date('d/m/Y H:i', strtotime($row['fecha']))
    ];
}

// Noticias más comentadas (de todas las secciones)
// Noticias más comentadas (de todas las secciones)
$mas_comentadas = [];
$sql = "SELECT n.*, c.nombre as categoria, c.color as categoria_color, (SELECT COUNT(*) FROM comentarios cm WHERE cm.noticia_id = n.id) as comentarios, (SELECT COUNT(*) FROM destacados d WHERE d.noticia_id = n.id) as destacados FROM noticias n LEFT JOIN categorias c ON n.categoria_id = c.id ORDER BY comentarios DESC LIMIT 3";
$res = $conn->query($sql);
while ($row = $res->fetch_assoc()) {
    $mas_comentadas[] = [
        'id' => $row['id'],
        'titulo' => $row['titulo'],
        'resumen' => $row['resumen'],
        'imagen' => !empty($row['imagen']) ? 'assets/img/' . $row['imagen'] : 'assets/img/fondo1-1.webp',
        'categoria' => $row['categoria'],
        'categoria_color' => $row['categoria_color'],
        'comentarios' => $row['comentarios'],
        'destacados' => $row['destacados'],
        'fecha' => date('d/m/Y H:i', strtotime($row['fecha']))
    ];
}

// Clasificación deportiva (simulado)
$clasificacion = [
    ['equipo' => 'Equipo A', 'puntos' => 42],
    ['equipo' => 'Equipo B', 'puntos' => 38],
    ['equipo' => 'Equipo C', 'puntos' => 35]
];

$conn->close();
echo json_encode([
    'video' => $video,
    'ultimas' => $ultimas,
    'destacadas_dia' => $destacadas_dia,
    'mas_comentadas' => $mas_comentadas,
    'clasificacion' => $clasificacion
]);
