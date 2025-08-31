<?php
// Página de gestión de usuarios
include '../config/db.php';
$dashboard_content = '';

// =======================
// Eliminar usuario
// =======================
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM usuarios WHERE id=$id");
    if (
        isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
    ) {
        echo json_encode(['success' => true, 'msg' => 'Usuario eliminado correctamente']);
        exit;
    }
}

// =======================
// Registro básico de usuario
// =======================
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['nombre']) &&
    isset($_POST['correo']) &&
    isset($_POST['password']) &&
    isset($_POST['rol'])
) {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rol_id = intval($_POST['rol']);

    $sql = "INSERT INTO usuarios (nombre, correo, password, rol_id) VALUES ('$nombre', '$correo', '$password', $rol_id)";
    if ($conn->query($sql)) {
        // Solo mostrar un mensaje si es AJAX
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        ) {
            $dashboard_content = '<div class="alert alert-success">Usuario registrado correctamente.</div>';
        }
    } else {
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        ) {
            $dashboard_content = '<div class="alert alert-danger">Error: ' . $conn->error . '</div>';
        }
    }
}

// =======================
// Cambiar contraseña
// =======================
if (isset($_POST['change_pass_id'])) {
    $id = intval($_POST['change_pass_id']);
    $newpass = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $conn->query("UPDATE usuarios SET password='$newpass' WHERE id=$id");
    $dashboard_content .= '<div class="alert alert-success">Contraseña actualizada.</div>';
}

// =======================
// Editar usuario
// =======================
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['edit_id']) &&
    isset($_POST['nombre']) &&
    isset($_POST['correo']) &&
    isset($_POST['rol'])
) {
    $id = intval($_POST['edit_id']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $rol_id = intval($_POST['rol']);
    $update_sql = "UPDATE usuarios SET nombre='$nombre', correo='$correo', rol_id=$rol_id";
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $update_sql .= ", password='$password'";
    }
    $update_sql .= " WHERE id=$id";
    if ($conn->query($update_sql)) {
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        ) {
            $dashboard_content = '<div class="alert alert-success">Usuario editado correctamente.</div>';
        }
    } else {
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        ) {
            $dashboard_content = '<div class="alert alert-danger">Error al editar: ' . $conn->error . '</div>';
        }
    }
}

// =======================
// Formulario de registro
// =======================
$dashboard_content .= '<h2 class="mb-4">Registrar Usuario</h2>';
$dashboard_content .= '<form class="mb-5" id="formUsuario" method="POST">';
$dashboard_content .= '<input type="hidden" id="edit_id" name="edit_id">';
$dashboard_content .= '<div class="row g-3">';
$dashboard_content .= '<div class="col-md-6">';
$dashboard_content .= '<label for="nombre" class="form-label">Nombre completo</label>';
$dashboard_content .= '<input type="text" class="form-control" id="nombre" name="nombre" required>';
$dashboard_content .= '</div>';
$dashboard_content .= '<div class="col-md-6">';
$dashboard_content .= '<label for="correo" class="form-label">Correo electrónico</label>';
$dashboard_content .= '<input type="email" class="form-control" id="correo" name="correo" required>';
$dashboard_content .= '</div>';
$dashboard_content .= '<div class="col-md-6">';
$dashboard_content .= '<label for="password" class="form-label">Contraseña</label>';
$dashboard_content .= '<input type="password" class="form-control" id="password" name="password" required>';
$dashboard_content .= '</div>';
$dashboard_content .= '<div class="col-md-6">';
$dashboard_content .= '<label for="rol" class="form-label">Rol</label>';
$dashboard_content .= '<select class="form-select" id="rol" name="rol" required>';
$dashboard_content .= '<option value="">Selecciona un rol</option>';
$roles = $conn->query("SELECT id, nombre FROM roles");
while ($rol = $roles->fetch_assoc()) {
    $dashboard_content .= '<option value="' . $rol['id'] . '">' . $rol['nombre'] . '</option>';
}
$dashboard_content .= '</select>';
$dashboard_content .= '</div>';
$dashboard_content .= '</div>';
$dashboard_content .= '<button type="submit" class="btn btn-primary mt-4" id="btnRegistrar">Registrar</button>';
$dashboard_content .= '<button type="submit" class="btn btn-info mt-4 d-none" id="btnEditar">Guardar Cambios</button>';
$dashboard_content .= '</form>';

// =======================
// Modal para permisos
// =======================
$dashboard_content .= '<div class="modal fade" id="modalPermisos" tabindex="-1" aria-labelledby="modalPermisosLabel" aria-hidden="true">';
$dashboard_content .= '<div class="modal-dialog">';
$dashboard_content .= '<div class="modal-content">';
$dashboard_content .= '<div class="modal-header">';
$dashboard_content .= '<h5 class="modal-title" id="modalPermisosLabel">Asignar Accesos al Usuario</h5>';
$dashboard_content .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
$dashboard_content .= '</div>';
$dashboard_content .= '<div class="modal-body" id="modalPermisosBody">';
$dashboard_content .= '<!-- Aquí se mostrarán los menús con iconos -->';
$dashboard_content .= '</div>';
$dashboard_content .= '<div class="modal-footer">';
$dashboard_content .= '<button type="button" class="btn btn-primary" id="guardarPermisos">Guardar</button>';
$dashboard_content .= '</div>';
$dashboard_content .= '</div>';
$dashboard_content .= '</div>';
$dashboard_content .= '</div>';

// =======================
// Lista de usuarios
// =======================
$dashboard_content .= '<h2 class="mb-4">Lista de Usuarios</h2>';
$dashboard_content .= '<div class="mb-3 input-group"><span class="input-group-text"><i class="fas fa-search"></i></span><input type="text" class="form-control" id="buscarUsuario" placeholder="Buscar usuario por nombre o correo"></div>';
$dashboard_content .= '<div class="table-responsive">';
$dashboard_content .= '<table class="table table-striped align-middle" id="tablaUsuarios">';
$dashboard_content .= '<thead class="table-dark">';
$dashboard_content .= '<tr>';
$dashboard_content .= '<th>#</th>';
$dashboard_content .= '<th>Nombre</th>';
$dashboard_content .= '<th>Correo</th>';
$dashboard_content .= '<th>Rol</th>';
$dashboard_content .= '<th>Acciones</th>';
$dashboard_content .= '</tr>';
$dashboard_content .= '</thead>';
$dashboard_content .= '<tbody>';

// Traer también rol_id para que el select funcione bien
$usuarios = $conn->query("SELECT u.id, u.nombre, u.correo, u.rol_id, r.nombre AS rol 
                          FROM usuarios u 
                          JOIN roles r ON u.rol_id = r.id");
while ($user = $usuarios->fetch_assoc()) {
    $dashboard_content .= '<tr>';
    $dashboard_content .= '<td>' . $user['id'] . '</td>';
    $dashboard_content .= '<td>' . htmlspecialchars($user['nombre']) . '</td>';
    $dashboard_content .= '<td>' . htmlspecialchars($user['correo']) . '</td>';
    $dashboard_content .= '<td>' . htmlspecialchars($user['rol']) . '</td>';
    $dashboard_content .= '<td>';
    // Permisos
    $dashboard_content .= '<button class="btn btn-sm btn-warning me-1 btnPermisos" data-id="' . $user['id'] . '" title="Permisos"><i class="fas fa-key"></i></button>';
    // Editar usuario
    $dashboard_content .= '<button class="btn btn-sm btn-info me-1 btnEditarUsuario" 
                            data-id="' . $user['id'] . '" 
                            data-nombre="' . htmlspecialchars($user['nombre']) . '" 
                            data-correo="' . htmlspecialchars($user['correo']) . '" 
                            data-rol="' . $user['rol_id'] . '" 
                            title="Editar"><i class="fas fa-edit"></i></button>';
    // Eliminar usuario
    $dashboard_content .= '<a href="?delete=' . $user['id'] . '" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm(\'¿Seguro que deseas eliminar este usuario?\')"><i class="fas fa-trash-alt"></i></a>';
    $dashboard_content .= '</td>';
    $dashboard_content .= '</tr>';
}

$dashboard_content .= '</tbody>';
$dashboard_content .= '</table>';
$dashboard_content .= '</div>';

include 'layout.php';

// =======================
// Si la petición es AJAX, imprime solo el contenido
// =======================
if (
    isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
) {
    echo $dashboard_content;
    exit;
}
