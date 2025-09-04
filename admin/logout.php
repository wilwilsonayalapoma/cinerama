<?php
// logout.php - Cierra la sesión del administrador
session_start();
session_destroy();
header('Location: index.php');
exit;
?>
