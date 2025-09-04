<?php
// roles.php - API para obtener los nombres de los roles
require_once '../config/db.php';
header('Content-Type: application/json');

$sql = "SELECT id, nombre FROM roles";
$res = $conn->query($sql);
$roles = [];
while ($row = $res->fetch_assoc()) {
    $roles[$row['id']] = $row['nombre'];
}
$conn->close();
echo json_encode($roles);
?>
