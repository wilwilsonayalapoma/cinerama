<?php
// categorias.php: CRUD de Categorías
include '../config/db.php';
$dashboard_content = '';

// =======================
// Eliminar categoría
// =======================
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM categorias WHERE id=$id");
    if (
        isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
    ) {
        echo json_encode(['success' => true, 'msg' => 'Categoría eliminada correctamente']);
        exit;
    }
}

// =======================
// Registro de categoría
// =======================
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['nombre'])
) {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $color = isset($_POST['color']) ? $conn->real_escape_string($_POST['color']) : '';
    $sql = "INSERT INTO categorias (nombre, color) VALUES ('$nombre', '$color')";
    if ($conn->query($sql)) {
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        ) {
            $dashboard_content = '<div class=\"alert alert-success\">Categoría registrada correctamente.</div>';
        }
    } else {
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        ) {
            $dashboard_content = '<div class=\"alert alert-danger\">Error: ' . $conn->error . '</div>';
        }
    }
}

// =======================
// Editar categoría
// =======================
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['edit_id']) &&
    isset($_POST['nombre']) &&
    isset($_POST['color'])
) {
    $id = intval($_POST['edit_id']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $color = $conn->real_escape_string($_POST['color']);
    $sql = "UPDATE categorias SET nombre='$nombre', color='$color' WHERE id=$id";
    if ($conn->query($sql)) {
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        ) {
            $dashboard_content = '<div class=\"alert alert-success\">Categoría editada correctamente.</div>';
        }
    } else {
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        ) {
            $dashboard_content = '<div class=\"alert alert-danger\">Error al editar: ' . $conn->error . '</div>';
        }
    }
}

// =======================
// Formulario de registro de categoría
// =======================
$dashboard_content .= '<h2 class="mb-4">Registrar Categoría</h2>';
$dashboard_content .= '<form class="mb-5" id="formCategoria" method="POST">';
$dashboard_content .= '<input type="hidden" id="edit_id" name="edit_id">';
$dashboard_content .= '<div class="row g-3">';
$dashboard_content .= '<div class="col-md-6">';
$dashboard_content .= '<label for="nombre" class="form-label">Nombre</label>';
$dashboard_content .= '<input type="text" class="form-control" id="nombre" name="nombre" required>';
$dashboard_content .= '</div>';
// Campo color
$dashboard_content .= '<div class="col-md-6">';
$dashboard_content .= '<label for="color" class="form-label">Color</label>';
$dashboard_content .= '<input type="text" class="form-control" id="color" name="color" required placeholder="Ej: #FF0000 o rojo">';
$dashboard_content .= '</div>';
$dashboard_content .= '</div>';
$dashboard_content .= '<button type="submit" class="btn btn-primary mt-4" id="btnRegistrarCategoria">Registrar</button>';
$dashboard_content .= '<button type="submit" class="btn btn-info mt-4 d-none" id="btnEditarCategoria">Guardar Cambios</button>';
$dashboard_content .= '</form>';

// =======================
// Lista de categorías
// =======================
$dashboard_content .= '<h2 class="mb-4">Lista de Categorías</h2>';
$dashboard_content .= '<div class="table-responsive">';
$dashboard_content .= '<table class="table table-striped align-middle" id="tablaCategorias">';
$dashboard_content .= '<thead class="table-dark">';
$dashboard_content .= '<tr>';
$dashboard_content .= '<th>#</th>';
$dashboard_content .= '<th>Nombre</th>';
$dashboard_content .= '<th>Color</th>';
$dashboard_content .= '<th>Acciones</th>';
$dashboard_content .= '</tr>';
$dashboard_content .= '</thead>';
$dashboard_content .= '<tbody>';

$categorias = $conn->query("SELECT id, nombre, color FROM categorias");
while ($cat = $categorias->fetch_assoc()) {
    $dashboard_content .= '<tr>';
    $dashboard_content .= '<td>' . $cat['id'] . '</td>';
    $dashboard_content .= '<td>' . htmlspecialchars($cat['nombre']) . '</td>';
    $dashboard_content .= '<td><span style="background:' . htmlspecialchars($cat['color']) . ';padding:4px 12px;border-radius:8px;color:#fff;">' . htmlspecialchars($cat['color']) . '</span></td>';
    $dashboard_content .= '<td>';
    $dashboard_content .= '<button class="btn btn-sm btn-info me-1 btnEditarCategoria" data-id="' . $cat['id'] . '" data-nombre="' . htmlspecialchars($cat['nombre']) . '" data-color="' . htmlspecialchars($cat['color']) . '" title="Editar"><i class="fas fa-edit"></i></button>';
    $dashboard_content .= '<a href="?delete=' . $cat['id'] . '" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm(\'¿Seguro que deseas eliminar esta categoría?\')"><i class="fas fa-trash-alt"></i></a>';
    $dashboard_content .= '</td>';
    $dashboard_content .= '</tr>';
}

$dashboard_content .= '</tbody>';
$dashboard_content .= '</table>';
$dashboard_content .= '</div>';

include 'layout.php';

if (
    isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
) {
    echo $dashboard_content;
    exit;
}
