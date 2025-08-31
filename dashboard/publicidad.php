<?php
include '../config/db.php';
$dashboard_content = '';
// Mensaje de éxito/error
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<script>alert("Imagen subida correctamente al carrusel.");</script>';
}
if (isset($_GET['error'])) {
    echo '<script>alert("' . htmlspecialchars($_GET['error']) . '");</script>';
}
// Procesar formulario de subida
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre']) && isset($_POST['espacio']) && $_POST['espacio'] === 'carrusel') {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $link = $conn->real_escape_string($_POST['link']);
    $espacio = 'carrusel';
    $imagen = '';
    $max_size = 2 * 1024 * 1024; // 2MB
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        if ($_FILES['imagen']['size'] > $max_size) {
            header('Location: publicidad.php?error=La imagen no debe superar los 2MB.');
            exit;
        }
        $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $nombre_img = uniqid('carrusel_') . '.' . $ext;
        $ruta_img = '../assets/img/' . $nombre_img;
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_img)) {
            $imagen = $nombre_img;
        } else {
            header('Location: publicidad.php?error=Error al guardar la imagen.');
            exit;
        }
    } else {
        header('Location: publicidad.php?error=Debes seleccionar una imagen.');
        exit;
    }
    $sql = "INSERT INTO publicidad (nombre, imagen, link, espacio) VALUES ('$nombre', '$imagen', '$link', '$espacio')";
    if ($conn->query($sql)) {
        header('Location: publicidad.php?success=1');
        exit;
    } else {
        header('Location: publicidad.php?error=Error al guardar en la base de datos.');
        exit;
    }
}
// Formulario de subida
$dashboard_content .= '<h2>Subir imagen al carrusel</h2>';
$dashboard_content .= '<form method="POST" enctype="multipart/form-data" class="mb-4">';
$dashboard_content .= '<div class="mb-3">';
$dashboard_content .= '<label for="nombre" class="form-label">Nombre</label>';
$dashboard_content .= '<input type="text" class="form-control" id="nombre" name="nombre" required>';
$dashboard_content .= '</div>';
$dashboard_content .= '<div class="mb-3">';
$dashboard_content .= '<label for="link" class="form-label">Enlace (opcional)</label>';
$dashboard_content .= '<input type="url" class="form-control" id="link" name="link">';
$dashboard_content .= '</div>';
$dashboard_content .= '<div class="mb-3">';
$dashboard_content .= '<label for="imagen" class="form-label">Imagen (máx 2MB)</label>';
$dashboard_content .= '<input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>';
$dashboard_content .= '</div>';
$dashboard_content .= '<div class="mb-3">';
$dashboard_content .= '<label for="espacio" class="form-label">Espacio</label>';
$dashboard_content .= '<input type="text" class="form-control" id="espacio" name="espacio" value="carrusel" required>';
$dashboard_content .= '</div>';
$dashboard_content .= '<input type="hidden" name="espacio" value="carrusel">';
$dashboard_content .= '<button type="submit" class="btn btn-primary">Subir al carrusel</button>';
$dashboard_content .= '</form>';
// Mostrar imágenes actuales del carrusel
$dashboard_content .= '<h3>Imágenes actuales en publicidad</h3>';
$res = $conn->query("SELECT * FROM publicidad ORDER BY id DESC");
$dashboard_content .= '<div class="row">';
while ($img = $res->fetch_assoc()) {
    $dashboard_content .= '<div class="col-md-3 mb-3">';
    $dashboard_content .= '<div class="card">';
    $dashboard_content .= '<img src="../assets/img/' . htmlspecialchars($img['imagen']) . '" class="card-img-top" style="height:120px;object-fit:cover;">';
    $dashboard_content .= '<div class="card-body">';
    $dashboard_content .= '<h6 class="card-title">' . htmlspecialchars($img['nombre']) . '</h6>';
    $dashboard_content .= '<p class="mb-1"><strong>Espacio:</strong> ' . htmlspecialchars($img['espacio']) . '</p>';
    if (!empty($img['link'])) {
        $dashboard_content .= '<a href="' . htmlspecialchars($img['link']) . '" target="_blank" class="btn btn-sm btn-info">Ver enlace</a> ';
    }
    $dashboard_content .= '<a href="publicidad.php?delete=' . $img['id'] . '" class="btn btn-sm btn-danger ms-2" onclick="return confirm(\'¿Seguro que deseas eliminar esta imagen?\')">Eliminar</a>';
    $dashboard_content .= '</div></div></div>';
}
$dashboard_content .= '</div>';
include 'layout.php';
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $res = $conn->query("SELECT imagen FROM publicidad WHERE id=$id LIMIT 1");
    if ($res && $row = $res->fetch_assoc()) {
        $img_path = '../assets/img/' . $row['imagen'];
        if (file_exists($img_path)) {
            unlink($img_path);
        }
    }
    $conn->query("DELETE FROM publicidad WHERE id=$id");
    echo '<script>window.location.href = "publicidad.php";</script>';
    exit;
}
