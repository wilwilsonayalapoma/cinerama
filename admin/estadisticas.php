<?php
// estadisticas.php - Devuelve resumenes visuales para el panel
header('Content-Type: application/json');
require_once __DIR__ . '/conexion.php';

$res = $conn->query('SELECT (SELECT COUNT(*) FROM usuarios) as usuarios, (SELECT COUNT(*) FROM noticias) as noticias, (SELECT COUNT(*) FROM comentarios) as comentarios, (SELECT COUNT(*) FROM categorias) as categorias, (SELECT COUNT(*) FROM publicidad) as publicidad');
$row = $res->fetch_assoc();
echo json_encode($row);
