$dashboard_content .= '<datalist id="usuariosList">';
$usuarios = $conn->query("SELECT id, nombre FROM usuarios");
while ($user = $usuarios->fetch_assoc()) {
    $dashboard_content .= '<option data-id="' . $user['id'] . '" value="' . htmlspecialchars($user['nombre']) . '">';
}
$dashboard_content .= '</datalist>';
<?php
// noticias.php: CRUD de Noticias
include '../config/db.php';
$dashboard_content = '';

// =======================
// Eliminar noticia
// =======================
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM noticias WHERE id=$id");
    if (
        isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
    ) {
        echo json_encode(['success' => true, 'msg' => 'Noticia eliminada correctamente']);
        exit;
    }
}

// =======================
// Registro de noticia
// =======================
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['titulo']) &&
    isset($_POST['contenido']) &&
    isset($_POST['categoria_id']) &&
    isset($_POST['usuario_id'])
) {
    $titulo = $conn->real_escape_string($_POST['titulo']);
    $contenido = $conn->real_escape_string($_POST['contenido']);
    $categoria_id = intval($_POST['categoria_id']);
    $usuario_id = intval($_POST['usuario_id']);
    $imagen = '';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $nombre_img = uniqid('noticia_') . '.' . $ext;
        $ruta_img = '../assets/img/' . $nombre_img;
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_img)) {
            $imagen = $nombre_img;
        }
    }
    $sql = "INSERT INTO noticias (titulo, contenido, categoria_id, usuario_id, imagen) VALUES ('$titulo', '$contenido', $categoria_id, $usuario_id, '$imagen')";
    if ($conn->query($sql)) {
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        ) {
            $dashboard_content = '<div class=\"alert alert-success\">Noticia registrada correctamente.</div>';
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
// Editar noticia
// =======================
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['edit_id']) &&
    isset($_POST['titulo']) &&
    isset($_POST['contenido']) &&
    isset($_POST['categoria_id']) &&
    isset($_POST['usuario_id'])
) {
    $id = intval($_POST['edit_id']);
    $titulo = $conn->real_escape_string($_POST['titulo']);
    $contenido = $conn->real_escape_string($_POST['contenido']);
    $categoria_id = intval($_POST['categoria_id']);
    $usuario_id = intval($_POST['usuario_id']);
    $imagen = '';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $nombre_img = uniqid('noticia_') . '.' . $ext;
        $ruta_img = '../assets/img/' . $nombre_img;
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_img)) {
            $imagen = $nombre_img;
        }
    }
    $set_img = $imagen ? ", imagen='$imagen'" : "";
    $sql = "UPDATE noticias SET titulo='$titulo', contenido='$contenido', categoria_id=$categoria_id, usuario_id=$usuario_id$set_img WHERE id=$id";
    if ($conn->query($sql)) {
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        ) {
            $dashboard_content = '<div class=\"alert alert-success\">Noticia editada correctamente.</div>';
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
// Formulario de registro de noticia
// =======================
$dashboard_content .= '<h2 class="mb-4">Registrar Noticia</h2>';
$dashboard_content .= '<form class="mb-5" id="formNoticia" method="POST" enctype="multipart/form-data">';
$dashboard_content .= '<input type="hidden" id="edit_id" name="edit_id">';
$dashboard_content .= '<div class="row g-3">';
$dashboard_content .= '<div class="col-md-6">';
$dashboard_content .= '<label for="titulo" class="form-label">Título</label>';
$dashboard_content .= '<input type="text" class="form-control" id="titulo" name="titulo" required>';
$dashboard_content .= '</div>';
$dashboard_content .= '<div class="col-md-6">';
$dashboard_content .= '<label for="categoria_id" class="form-label">Categoría</label>';
$dashboard_content .= '<select class="form-select" id="categoria_id" name="categoria_id" required>';
$dashboard_content .= '<option value="">Selecciona una categoría</option>';
$categorias = $conn->query("SELECT id, nombre FROM categorias");
while ($cat = $categorias->fetch_assoc()) {
    $dashboard_content .= '<option value="' . $cat['id'] . '">' . htmlspecialchars($cat['nombre']) . '</option>';
}
$dashboard_content .= '</select>';
$dashboard_content .= '</div>';
$dashboard_content .= '<div class="col-md-6">';
$dashboard_content .= '<label for="usuario_nombre" class="form-label">Usuario</label>';
$dashboard_content .= '<label for="usuario_id" class="form-label">Usuario</label>';
$dashboard_content .= '<select class="form-select" id="usuario_id" name="usuario_id" required>';
$dashboard_content .= '<option value="">Selecciona un usuario</option>';
$usuarios = $conn->query("SELECT id, nombre FROM usuarios");
while ($user = $usuarios->fetch_assoc()) {
    $dashboard_content .= '<option value="' . $user['id'] . '">' . htmlspecialchars($user['nombre']) . '</option>';
}
$dashboard_content .= '</select>';
$dashboard_content .= '</div>';
$dashboard_content .= '<div class="col-md-12">';
$dashboard_content .= '<label for="contenido" class="form-label">Contenido</label>';
$dashboard_content .= '<textarea class="form-control" id="contenido" name="contenido" rows="4" required></textarea>';
$dashboard_content .= '</div>';
$dashboard_content .= '<div class="col-md-12 mt-3">';
$dashboard_content .= '<label for="imagen" class="form-label">Imagen</label>';
$dashboard_content .= '<input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">';
$dashboard_content .= '</div>';
$dashboard_content .= '</div>';
$dashboard_content .= '<button type="submit" class="btn btn-primary mt-4" id="btnRegistrarNoticia">Registrar</button>';
$dashboard_content .= '<button type="submit" class="btn btn-info mt-4 d-none" id="btnEditarNoticia">Guardar Cambios</button>';
$dashboard_content .= '</form>';

// =======================
// Lista de noticias
// =======================
$dashboard_content .= '<h2 class="mb-4">Lista de Noticias</h2>';
$dashboard_content .= '<div class="table-responsive">';
$dashboard_content .= '<table class="table table-striped align-middle" id="tablaNoticias">';
$dashboard_content .= '<thead class="table-dark">';
$dashboard_content .= '<tr>';
$dashboard_content .= '<th>#</th>';
$dashboard_content .= '<th>Título</th>';
$dashboard_content .= '<th>Contenido</th>';
$dashboard_content .= '<th>Acciones</th>';
$dashboard_content .= '</tr>';
$dashboard_content .= '</thead>';
$dashboard_content .= '<tbody>';

$noticias = $conn->query("SELECT id, titulo, contenido, imagen FROM noticias");
while ($noticia = $noticias->fetch_assoc()) {
    $dashboard_content .= '<tr>';
    $dashboard_content .= '<td>' . $noticia['id'] . '</td>';
    $dashboard_content .= '<td>' . htmlspecialchars($noticia['titulo']) . '</td>';
    $dashboard_content .= '<td>' . htmlspecialchars($noticia['contenido']);
    if (!empty($noticia['imagen'])) {
        $dashboard_content .= '<br><img src="../assets/img/' . htmlspecialchars($noticia['imagen']) . '" alt="Imagen noticia" style="max-width:120px;max-height:80px;border-radius:8px;margin-top:8px;">';
    }
    $dashboard_content .= '</td>';
    $dashboard_content .= '<td>';
    $dashboard_content .= '<button class="btn btn-sm btn-info me-1 btnEditarNoticia" data-id="' . $noticia['id'] . '" data-titulo="' . htmlspecialchars($noticia['titulo']) . '" data-contenido="' . htmlspecialchars($noticia['contenido']) . '" title="Editar"><i class="fas fa-edit"></i></button>';
    $dashboard_content .= '<a href="?delete=' . $noticia['id'] . '" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm(\'¿Seguro que deseas eliminar esta noticia?\')"><i class="fas fa-trash-alt"></i></a>';
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
