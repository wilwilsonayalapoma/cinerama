<?php
// Script de verificación de la tabla usuarios y roles
include '../config/db.php';

$errores = [];

// Verificar estructura de la tabla usuarios
$res = $conn->query("SHOW CREATE TABLE usuarios");
$row = $res->fetch_assoc();
echo "<h3>CREATE TABLE usuarios</h3><pre>" . htmlspecialchars($row['Create Table']) . "</pre>";
if (strpos($row['Create Table'], 'AUTO_INCREMENT') === false) {
    $errores[] = "El campo 'id' de la tabla 'usuarios' NO tiene AUTO_INCREMENT. Ejecuta:<br><code>ALTER TABLE usuarios MODIFY id int(11) NOT NULL AUTO_INCREMENT;</code>";
}

// Verificar roles
$res = $conn->query("SELECT id, nombre FROM roles");
$roles = [];
while ($r = $res->fetch_assoc()) {
    $roles[] = $r['nombre'];
}
echo "<h3>Roles existentes</h3><ul>";
foreach ($roles as $rol) {
    echo "<li>" . htmlspecialchars($rol) . "</li>";
}
echo "</ul>";
if (count($roles) == 0) {
    $errores[] = "No hay roles en la tabla 'roles'. Inserta al menos uno.";
}

// Mostrar errores
if ($errores) {
    echo "<h3 style='color:red'>Problemas detectados:</h3><ul>";
    foreach ($errores as $err) {
        echo "<li>" . $err . "</li>";
    }
    echo "</ul>";
} else {
    echo "<h3 style='color:green'>La estructura de la base de datos es correcta para registrar usuarios.</h3>";
}
?>
