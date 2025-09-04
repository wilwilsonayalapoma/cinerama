<?php
// panel.php - Panel principal del administrador
session_start();
if (!isset($_SESSION['admin_id'])) {
  header('Location: index.php');
  exit;
}

// Obtener estadísticas para los cards
$stats = [];
// Aquí deberías agregar código para obtener las estadísticas reales desde tu base de datos
// Ejemplo: 
// $stats['usuarios'] = obtenerCantidadUsuarios();
// $stats['noticias'] = obtenerCantidadNoticias();
// etc.
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Administración</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="stylesheet" href="../css/style.css" />
  <style>
    body {
      background: url('../assets/img/fondo1-1.webp') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
    }
    .admin-panel-card {
      background: rgba(41, 62, 90, 0.85);
      border-radius: 18px;
      box-shadow: 0 4px 24px rgba(41, 62, 90, 0.25);
      color: #fff;
      margin-top: 40px;
    }
    .admin-panel-card h2, .admin-panel-card p {
      color: #fff;
    }
    .navbar {
      background: rgba(41, 62, 90, 0.95) !important;
      border-bottom: 2px solid #e67e22;
    }
    .navbar .navbar-brand {
      color: #e67e22 !important;
      font-weight: bold;
    }
    .navbar .btn-outline-light {
      border-color: #e67e22;
      color: #e67e22;
    }
    .navbar .btn-outline-light:hover {
      background: #e67e22;
      color: #fff;
    }
    .table-responsive {
      max-height: 70vh;
      overflow-y: auto;
    }
    @media (max-width: 768px) {
      .container-fluid {
        padding-left: 10px;
        padding-right: 10px;
      }
      .col-md-3, .col-md-9 {
        padding-left: 5px;
        padding-right: 5px;
      }
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-dark">
    <div class="container-fluid">
      <div class="d-flex align-items-center">
        <img src="../assets/img/sin-fondo.png" alt="Logo" style="height:40px;object-fit:contain;margin-right:16px;">
        <span class="navbar-brand mb-0 h1">Panel de Administración</span>
      </div>
      <a href="logout.php" class="btn btn-outline-light">Cerrar sesión</a>
    </div>
  </nav>
  
  <div class="container-fluid">
    <div class="row">
      <!-- Menú lateral -->
      <div class="col-md-3 col-lg-2 pt-4">
        <div class="card admin-panel-card shadow-lg mb-4">
          <div class="card-body p-0">
            <ul class="nav flex-column nav-pills" id="adminMenu">
              <li class="nav-item mb-1"><a class="nav-link active" href="#dashboard"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
              <li class="nav-item mb-1"><a class="nav-link" href="#usuarios"><i class="fas fa-user-friends me-2"></i>Usuarios</a></li>
              <li class="nav-item mb-1"><a class="nav-link" href="#usuarios_s"><i class="fas fa-user-shield me-2"></i>Usuarios_s</a></li>
              <li class="nav-item mb-1"><a class="nav-link" href="#suscriptores"><i class="fas fa-envelope-open-text me-2"></i>Suscriptores</a></li>
              <li class="nav-item mb-1"><a class="nav-link" href="#publicidad"><i class="fas fa-bullhorn me-2"></i>Publicidad</a></li>
              <li class="nav-item mb-1"><a class="nav-link" href="#noticias"><i class="fas fa-newspaper me-2"></i>Noticias</a></li>
              <li class="nav-item mb-1"><a class="nav-link" href="#comentarios"><i class="fas fa-comments me-2"></i>Comentarios</a></li>
              <li class="nav-item mb-1"><a class="nav-link" href="#categorias"><i class="fas fa-tags me-2"></i>Categorías</a></li>
              <li class="nav-item mb-1"><a class="nav-link" href="#estadisticas"><i class="fas fa-chart-bar me-2"></i>Estadísticas</a></li>
            </ul>
          </div>
        </div>
      </div>
      
      <!-- Contenido principal -->
      <div class="col-md-9 col-lg-10 pt-4">
        <!-- Cards de resumen -->
        <div class="row mb-4">
          <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-lg text-center h-100" style="background:rgba(255,255,255,0.15);color:#fff;">
              <div class="card-body">
                <h5 class="card-title"><i class="fas fa-users"></i> Usuarios</h5>
                <h2 id="usuarios-count"><?php echo $stats['usuarios'] ?? '--'; ?></h2>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-lg text-center h-100" style="background:rgba(255,255,255,0.15);color:#fff;">
              <div class="card-body">
                <h5 class="card-title"><i class="fas fa-newspaper"></i> Noticias</h5>
                <h2 id="noticias-count"><?php echo $stats['noticias'] ?? '--'; ?></h2>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-lg text-center h-100" style="background:rgba(255,255,255,0.15);color:#fff;">
              <div class="card-body">
                <h5 class="card-title"><i class="fas fa-comments"></i> Comentarios</h5>
                <h2 id="comentarios-count"><?php echo $stats['comentarios'] ?? '--'; ?></h2>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-lg text-center h-100" style="background:rgba(255,255,255,0.15);color:#fff;">
              <div class="card-body">
                <h5 class="card-title"><i class="fas fa-star"></i> Destacados</h5>
                <h2 id="destacados-count"><?php echo $stats['destacados'] ?? '--'; ?></h2>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Listados y formularios -->
        <div class="card admin-panel-card shadow-lg mb-4">
          <div class="card-body" id="adminContent">
            <h2 class="mb-3">Bienvenido, <?php echo htmlspecialchars($_SESSION['admin_correo']); ?>!</h2>
            <p>Selecciona una opción del menú para gestionar el sistema.</p>
          </div>
        </div>
        
        <!-- Modal fijo para crear/editar usuario -->
        <div class='modal fade' id='usuarioModal' tabindex='-1' aria-labelledby='usuarioModalLabel' aria-hidden='true'>
          <div class='modal-dialog'>
            <div class='modal-content' style='background:rgba(41,62,90,0.95);color:#fff;'>
              <div class='modal-header'>
                <h5 class='modal-title' id='usuarioModalLabel'>Usuario</h5>
                <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal' aria-label='Cerrar'></button>
              </div>
              <form id='formUsuario'>
                <div class='modal-body'>
                  <input type='hidden' id='usuarioId' name='id'>
                  <div class='mb-3'>
                    <label for='usuarioNombre' class='form-label'>Nombre</label>
                    <input type='text' class='form-control' id='usuarioNombre' name='nombre' required>
                  </div>
                  <div class='mb-3'>
                    <label for='usuarioCorreo' class='form-label'>Correo</label>
                    <input type='email' class='form-control' id='usuarioCorreo' name='correo' required>
                  </div>
                  <div class='mb-3'>
                    <label for='usuarioPassword' class='form-label'>Contraseña</label>
                    <input type='password' class='form-control' id='usuarioPassword' name='password' placeholder='Solo para crear o cambiar'>
                    <div class="form-text">Dejar en blanco para mantener la contraseña actual</div>
                  </div>
                  <div class='mb-3'>
                    <label for='usuarioRol' class='form-label'>Rol</label>
                    <select class='form-select' id='usuarioRol' name='rol_id' required></select>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                  <button type='submit' class='btn btn-primary'>Guardar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        
        <!-- Toast container -->
        <div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index:1060;"></div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  $(document).ready(function() {
    // Función para mostrar toasts
    function mostrarToast(mensaje, tipo = "success") {
      const toastId = "toast-" + Date.now();
      const toastHtml = `
        <div id="${toastId}" class="toast align-items-center text-bg-${tipo} border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="d-flex">
            <div class="toast-body">${mensaje}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
      `;
      $("#toast-container").append(toastHtml);
      const toastEl = document.getElementById(toastId);
      const toast = new bootstrap.Toast(toastEl, { delay: 3500 });
      toast.show();
      toastEl.addEventListener("hidden.bs.toast", () => toastEl.remove());
    }

    // Cargar estadísticas al iniciar
    function cargarEstadisticas() {
      $.getJSON('estadisticas.php', function(data) {
        if (data.usuarios) $('#usuarios-count').text(data.usuarios);
        if (data.noticias) $('#noticias-count').text(data.noticias);
        if (data.comentarios) $('#comentarios-count').text(data.comentarios);
        if (data.destacados) $('#destacados-count').text(data.destacados);
      }).fail(function() {
        console.error('Error al cargar estadísticas');
      });
    }
    
    // Llamar a cargar estadísticas al inicio
    cargarEstadisticas();

    // Funcionalidad para Noticias
    function renderNoticias() {
      $("#adminContent").html(`
        <h2 class="mb-3"><i class="fas fa-newspaper"></i> Noticias</h2>
        <button class="btn btn-success mb-3" id="btnNuevaNoticia"><i class="fas fa-plus"></i> Nueva noticia</button>
        <div class="input-group mb-3" style="max-width:400px;">
          <input type="text" class="form-control" id="buscarNoticia" placeholder="Buscar noticia...">
          <button class="btn btn-primary" id="btnBuscarNoticia"><i class="fas fa-search"></i></button>
        </div>
        <div class="table-responsive">
          <table class='table table-dark table-hover table-bordered' style='background:rgba(41,62,90,0.85);color:#fff;'>
            <thead>
              <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Resumen</th>
                <th>Imagen</th>
                <th>Usuario</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody id='noticiasTbody'>
              <tr><td colspan='6' class='text-center'>Cargando...</td></tr>
            </tbody>
          </table>
        </div>
      `);
      
      // Cargar datos de noticias
      cargarNoticias();
      
      // Modal fijo para crear/editar noticia
      if($('#noticiaModal').length === 0) {
        $("body").append(`
          <div class='modal fade' id='noticiaModal' tabindex='-1' aria-labelledby='noticiaModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-lg'>
              <div class='modal-content' style='background:rgba(41,62,90,0.95);color:#fff;'>
                <div class='modal-header'>
                  <h5 class='modal-title' id='noticiaModalLabel'>Noticia</h5>
                  <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal' aria-label='Cerrar'></button>
                </div>
                <form id='formNoticia' enctype='multipart/form-data'>
                  <div class='modal-body'>
                    <input type='hidden' id='noticiaId' name='id'>
                    <div class='mb-3'>
                      <label for='noticiaTitulo' class='form-label'>Título</label>
                      <input type='text' class='form-control' id='noticiaTitulo' name='titulo' required>
                    </div>
                    <div class='mb-3'>
                      <label for='noticiaResumen' class='form-label'>Resumen</label>
                      <textarea class='form-control' id='noticiaResumen' name='resumen' rows='2'></textarea>
                    </div>
                    <div class='mb-3'>
                      <label for='noticiaContenido' class='form-label'>Contenido</label>
                      <textarea class='form-control' id='noticiaContenido' name='contenido' rows='6' required></textarea>
                    </div>
                    <div class='row'>
                      <div class='col-md-6'>
                        <div class='mb-3'>
                          <label for='noticiaCategoria' class='form-label'>Categoría</label>
                          <select class='form-select' id='noticiaCategoria' name='categoria_id' required></select>
                        </div>
                      </div>
                      <div class='col-md-6'>
                        <div class='mb-3'>
                          <label for='noticiaUsuario' class='form-label'>Usuario</label>
                          <select class='form-select' id='noticiaUsuario' name='usuario_id' required></select>
                        </div>
                      </div>
                    </div>
                    <div class='mb-3'>
                      <label for='noticiaImagen' class='form-label'>Imagen (archivo)</label>
                      <input type='file' class='form-control' id='noticiaImagen' name='imagen'>
                    </div>
                  </div>
                  <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                    <button type='submit' class='btn btn-primary'>Guardar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        `);
      }
      
      // Cargar categorías y usuarios en el modal
      $.getJSON('categorias.php?accion=listar', function(categorias) {
        var catOptions = '<option value="">Seleccionar categoría</option>';
        categorias.forEach(function(c) {
          catOptions += `<option value='${c.id}'>${c.nombre}</option>`;
        });
        $('#noticiaCategoria').html(catOptions);
      });
      
      $.getJSON('usuarios.php', function(usuarios) {
        var userOptions = '<option value="">Seleccionar usuario</option>';
        usuarios.forEach(function(u) {
          userOptions += `<option value='${u.id}'>${u.nombre}</option>`;
        });
        $('#noticiaUsuario').html(userOptions);
      });
      
      // Configurar eventos
      configurarEventosNoticias();
    }
    
    function cargarNoticias() {
      $.getJSON('noticias.php?accion=listar', function(data) {
        var html = '';
        if(data.length === 0) {
          html = "<tr><td colspan='6' class='text-center'>No hay noticias registradas.</td></tr>";
        } else {
          data.forEach(function(n) {
            html += `<tr>
              <td>${n.id}</td>
              <td>${n.titulo}</td>
              <td>${n.resumen || ''}</td>
              <td>${n.imagen ? `<img src='../assets/img/${n.imagen}' alt='Imagen' style='max-width:80px;max-height:60px;'>` : ''}</td>
              <td>${n.usuario || ''}</td>
              <td>
                <button class='btn btn-sm btn-warning editar-noticia' data-id='${n.id}'><i class='fas fa-edit'></i></button>
                <button class='btn btn-sm btn-danger eliminar-noticia' data-id='${n.id}'><i class='fas fa-trash'></i></button>
              </td>
            </tr>`;
          });
        }
        $("#noticiasTbody").html(html);
      }).fail(function() {
        mostrarToast('Error al cargar noticias', 'danger');
        $("#noticiasTbody").html("<tr><td colspan='7' class='text-center'>Error al cargar noticias</td></tr>");
      });
    }
    
    function configurarEventosNoticias() {
      // Nuevo noticia
      $(document).off('click', '#btnNuevaNoticia').on('click', '#btnNuevaNoticia', function() {
        $('#formNoticia')[0].reset();
        $('#noticiaId').val('');
        $('#noticiaModalLabel').text('Nueva noticia');
        var modal = new bootstrap.Modal(document.getElementById('noticiaModal'));
        modal.show();
      });
      
      // Editar noticia
      $(document).off('click', '.editar-noticia').on('click', '.editar-noticia', function() {
        var id = $(this).data('id');
        $.getJSON('noticias.php?accion=obtener&id=' + id, function(noticia) {
          if(noticia) {
            $('#formNoticia')[0].reset();
            $('#noticiaId').val(noticia.id);
            $('#noticiaTitulo').val(noticia.titulo);
            $('#noticiaResumen').val(noticia.resumen);
            $('#noticiaContenido').val(noticia.contenido);
            $('#noticiaCategoria').val(noticia.categoria_id);
            $('#noticiaUsuario').val(noticia.usuario_id);
            $('#noticiaImagen').val(noticia.imagen);
            $('#noticiaModalLabel').text('Editar noticia');
            var modal = new bootstrap.Modal(document.getElementById('noticiaModal'));
            modal.show();
          }
        }).fail(function() {
          mostrarToast('Error al cargar la noticia', 'danger');
        });
      });
      
      // Guardar noticia (crear/editar)
      $(document).off('submit', '#formNoticia').on('submit', '#formNoticia', function(e) {
        e.preventDefault();
        var id = $('#noticiaId').val();
        var accion = id ? 'editar' : 'crear';
        var formData = new FormData(this);
        formData.append('accion', accion);
        $.ajax({
          url: 'noticias.php',
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function(resp) {
            try {
              var data = typeof resp === 'string' ? JSON.parse(resp) : resp;
              if(data.success) {
                mostrarToast(accion === 'crear' ? 'Noticia creada correctamente' : 'Noticia actualizada', 'success');
                var modalEl = document.getElementById('noticiaModal');
                var modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) {
                  $(modalEl).one('hidden.bs.modal', function() {
                    cargarNoticias();
                    cargarEstadisticas();
                  });
                  modal.hide();
                } else {
                  cargarNoticias();
                  cargarEstadisticas();
                }
              } else {
                mostrarToast(data.message || 'Error al guardar noticia', 'danger');
              }
            } catch(e) {
              mostrarToast('Error inesperado al procesar la respuesta', 'danger');
            }
          },
          error: function() {
            mostrarToast('Error de conexión', 'danger');
          }
        });
      });
      
      // Eliminar noticia
      $(document).off('click', '.eliminar-noticia').on('click', '.eliminar-noticia', function() {
        if(confirm('¿Seguro que deseas eliminar esta noticia?')) {
          var id = $(this).data('id');
          $.post('noticias.php', {accion:'eliminar', id}, function(resp) {
            try {
              var data = typeof resp === 'string' ? JSON.parse(resp) : resp;
              if(data.success) {
                mostrarToast('Noticia eliminada correctamente', 'success');
                cargarNoticias();
                cargarEstadisticas();
              } else {
                mostrarToast(data.message || 'Error al eliminar noticia', 'danger');
              }
            } catch(e) {
              mostrarToast('Error inesperado al procesar la respuesta', 'danger');
            }
          }).fail(function() {
            mostrarToast('Error de conexión', 'danger');
          });
        }
      });
      
      // Buscador de noticias
      $(document).off('click', '#btnBuscarNoticia').on('click', '#btnBuscarNoticia', buscarNoticias);
      $(document).off('keyup', '#buscarNoticia').on('keyup', '#buscarNoticia', function(e) {
        if (e.key === 'Enter') {
          buscarNoticias();
        }
      });
    }
    
    function buscarNoticias() {
      var termino = $("#buscarNoticia").val().trim();
      if(!termino) {
        cargarNoticias();
        return;
      }
      
      $.getJSON('noticias.php?accion=buscar&termino=' + encodeURIComponent(termino), function(data) {
        var html = '';
        if(data.length === 0) {
          html = "<tr><td colspan='7' class='text-center'>No se encontraron noticias.</td></tr>";
        } else {
          data.forEach(function(n) {
            html += `<tr>
              <td>${n.id}</td>
              <td>${n.titulo}</td>
              <td>${n.resumen || ''}</td>
              <td>${n.categoria ? `<span class='badge' style='background:${n.color || '#444'}'>${n.categoria}</span>` : ''}</td>
              <td>${n.usuario || ''}</td>
              <td>${n.fecha}</td>
              <td>
                <button class='btn btn-sm btn-warning editar-noticia' data-id='${n.id}'><i class='fas fa-edit'></i></button>
                <button class='btn btn-sm btn-danger eliminar-noticia' data-id='${n.id}'><i class='fas fa-trash'></i></button>
              </td>
            </tr>`;
          });
        }
        $("#noticiasTbody").html(html);
      }).fail(function() {
        mostrarToast('Error al buscar noticias', 'danger');
      });
    }

    // Funcionalidad para Usuarios (similar a noticias, manteniendo tu código original)
    function renderUsuarios() {
      $("#adminContent").html(`
        <h2 class="mb-3"><i class="fas fa-user-friends"></i> Usuarios</h2>
        <button class="btn btn-success mb-3" id="btnNuevoUsuario"><i class="fas fa-plus"></i> Nuevo usuario</button>
        <div class="table-responsive">
          <table class='table table-dark table-hover table-bordered' style='background:rgba(41,62,90,0.85);color:#fff;'>
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody id='usuariosTbody'>
              <tr><td colspan='5' class='text-center'>Cargando...</td></tr>
            </tbody>
          </table>
        </div>
      `);
      cargarUsuarios();
      if($('#usuarioModal').length === 0) {
        $("body").append(`
          <div class='modal fade' id='usuarioModal' tabindex='-1' aria-labelledby='usuarioModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content' style='background:rgba(41,62,90,0.95);color:#fff;'>
                <div class='modal-header'>
                  <h5 class='modal-title' id='usuarioModalLabel'>Usuario</h5>
                  <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal' aria-label='Cerrar'></button>
                </div>
                <form id='formUsuario'>
                  <div class='modal-body'>
                    <input type='hidden' id='usuarioId' name='id'>
                    <div class='mb-3'>
                      <label for='usuarioNombre' class='form-label'>Nombre</label>
                      <input type='text' class='form-control' id='usuarioNombre' name='nombre' required>
                    </div>
                    <div class='mb-3'>
                      <label for='usuarioCorreo' class='form-label'>Correo</label>
                      <input type='email' class='form-control' id='usuarioCorreo' name='correo' required>
                    </div>
                    <div class='mb-3'>
                      <label for='usuarioPassword' class='form-label'>Contraseña</label>
                      <input type='password' class='form-control' id='usuarioPassword' name='password' placeholder='Solo para crear o cambiar'>
                      <div class="form-text">Dejar en blanco para mantener la contraseña actual</div>
                    </div>
                    <div class='mb-3'>
                      <label for='usuarioRol' class='form-label'>Rol</label>
                      <select class='form-select' id='usuarioRol' name='rol_id' required></select>
                    </div>
                  </div>
                  <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                    <button type='submit' class='btn btn-primary'>Guardar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        `);
      }
      cargarRolesUsuario();
      configurarEventosUsuarios();
    }

    function cargarUsuarios() {
      $.getJSON('usuarios.php', function(data) {
        $.getJSON('roles.php', function(roles) {
          var html = '';
          if(data.length === 0) {
            html = "<tr><td colspan='5' class='text-center'>No hay usuarios registrados.</td></tr>";
          } else {
            data.forEach(function(u) {
              html += `<tr>
                <td>${u.id}</td>
                <td>${u.nombre}</td>
                <td>${u.correo}</td>
                <td>${roles[u.rol_id] || ''}</td>
                <td>
                  <button class='btn btn-sm btn-warning editar-usuario' data-id='${u.id}'><i class='fas fa-edit'></i></button>
                  <button class='btn btn-sm btn-danger eliminar-usuario' data-id='${u.id}'><i class='fas fa-trash'></i></button>
                </td>
              </tr>`;
            });
          }
          $("#usuariosTbody").html(html);
        });
      }).fail(function() {
        mostrarToast('Error al cargar usuarios', 'danger');
        $("#usuariosTbody").html("<tr><td colspan='5' class='text-center'>Error al cargar usuarios</td></tr>");
      });
    }

    function cargarRolesUsuario() {
      $.getJSON('roles.php', function(roles) {
        var options = '';
        Object.entries(roles).forEach(function([id, nombre]) {
          options += `<option value='${id}'>${nombre}</option>`;
        });
        $('#usuarioRol').html(options);
      });
    }

    function configurarEventosUsuarios() {
      // Nuevo usuario
      $(document).off('click', '#btnNuevoUsuario').on('click', '#btnNuevoUsuario', function() {
        $('#formUsuario')[0].reset();
        $('#usuarioId').val('');
        $('#usuarioModalLabel').text('Nuevo usuario');
        var modal = new bootstrap.Modal(document.getElementById('usuarioModal'));
        modal.show();
      });
      // Editar usuario
      $(document).off('click', '.editar-usuario').on('click', '.editar-usuario', function() {
        var id = $(this).data('id');
        $.getJSON('usuarios.php', function(usuarios) {
          var usuario = usuarios.find(function(u) { return u.id == id; });
          if(usuario) {
            $('#formUsuario')[0].reset();
            $('#usuarioId').val(usuario.id);
            $('#usuarioNombre').val(usuario.nombre);
            $('#usuarioCorreo').val(usuario.correo);
            $('#usuarioRol').val(usuario.rol_id);
            $('#usuarioModalLabel').text('Editar usuario');
            var modal = new bootstrap.Modal(document.getElementById('usuarioModal'));
            modal.show();
          }
        });
      });
      // Guardar usuario (crear/editar)
      $(document).off('submit', '#formUsuario').on('submit', '#formUsuario', function(e) {
        e.preventDefault();
        var id = $('#usuarioId').val();
        var accion = id ? 'editar' : 'crear';
        var formData = $(this).serialize() + '&accion=' + accion;
        $.post('usuarios.php', formData, function(resp) {
          try {
            var data = typeof resp === 'string' ? JSON.parse(resp) : resp;
            if(data.success) {
              mostrarToast(accion === 'crear' ? 'Usuario creado correctamente' : 'Usuario actualizado', 'success');
              var modalEl = document.getElementById('usuarioModal');
              var modal = bootstrap.Modal.getInstance(modalEl);
              if (modal) {
                $(modalEl).one('hidden.bs.modal', function() {
                  cargarUsuarios();
                });
                modal.hide();
              } else {
                cargarUsuarios();
              }
            } else {
              mostrarToast(data.message || 'Error al guardar usuario', 'danger');
            }
          } catch(e) {
            mostrarToast('Error inesperado al procesar la respuesta', 'danger');
          }
        }).fail(function() {
          mostrarToast('Error de conexión', 'danger');
        });
      });
      // Eliminar usuario
      $(document).off('click', '.eliminar-usuario').on('click', '.eliminar-usuario', function() {
        if(confirm('¿Seguro que deseas eliminar este usuario?')) {
          var id = $(this).data('id');
          $.post('usuarios.php', {accion:'eliminar', id}, function(resp) {
            try {
              var data = typeof resp === 'string' ? JSON.parse(resp) : resp;
              if(data.success) {
                mostrarToast('Usuario eliminado correctamente', 'success');
                cargarUsuarios();
              } else {
                mostrarToast(data.message || 'Error al eliminar usuario', 'danger');
              }
            } catch(e) {
              mostrarToast('Error inesperado al procesar la respuesta', 'danger');
            }
          }).fail(function() {
            mostrarToast('Error de conexión', 'danger');
          });
        }
      });
    }
    
    // Funcionalidad para Categorías (similar a noticias, manteniendo tu código original)
    function renderCategorias() {
      $("#adminContent").html(`
        <h2 class="mb-3"><i class="fas fa-tags"></i> Categorías</h2>
        <button class="btn btn-success mb-3" id="btnNuevaCategoria"><i class="fas fa-plus"></i> Nueva categoría</button>
        <div class="table-responsive">
          <table class='table table-dark table-hover table-bordered' style='background:rgba(41,62,90,0.85);color:#fff;'>
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Color</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody id='categoriasTbody'>
              <tr><td colspan='4' class='text-center'>Cargando...</td></tr>
            </tbody>
          </table>
        </div>
      `);
      cargarCategorias();
      if($('#categoriaModal').length === 0) {
        $("body").append(`
          <div class='modal fade' id='categoriaModal' tabindex='-1' aria-labelledby='categoriaModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content' style='background:rgba(41,62,90,0.95);color:#fff;'>
                <div class='modal-header'>
                  <h5 class='modal-title' id='categoriaModalLabel'>Categoría</h5>
                  <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal' aria-label='Cerrar'></button>
                </div>
                <form id='formCategoria'>
                  <div class='modal-body'>
                    <input type='hidden' id='categoriaId' name='id'>
                    <div class='mb-3'>
                      <label for='categoriaNombre' class='form-label'>Nombre</label>
                      <input type='text' class='form-control' id='categoriaNombre' name='nombre' required>
                    </div>
                    <div class='mb-3'>
                      <label for='categoriaColor' class='form-label'>Color</label>
                      <input type='color' class='form-control form-control-color' id='categoriaColor' name='color' value="#293E5A" required>
                    </div>
                  </div>
                  <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                    <button type='submit' class='btn btn-primary'>Guardar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        `);
      }
      configurarEventosCategorias();
    }

    function cargarCategorias() {
      $.getJSON('categorias.php?accion=listar', function(data) {
        var html = '';
        if(data.length === 0) {
          html = "<tr><td colspan='4' class='text-center'>No hay categorías registradas.</td></tr>";
        } else {
          data.forEach(function(c) {
            html += `<tr>
              <td>${c.id}</td>
              <td>${c.nombre}</td>
              <td><span class='badge' style='background:${c.color};'>${c.color}</span></td>
              <td>
                <button class='btn btn-sm btn-warning editar-categoria' data-id='${c.id}'><i class='fas fa-edit'></i></button>
                <button class='btn btn-sm btn-danger eliminar-categoria' data-id='${c.id}'><i class='fas fa-trash'></i></button>
              </td>
            </tr>`;
          });
        }
        $("#categoriasTbody").html(html);
      }).fail(function() {
        mostrarToast('Error al cargar categorías', 'danger');
        $("#categoriasTbody").html("<tr><td colspan='4' class='text-center'>Error al cargar categorías</td></tr>");
      });
    }

    function configurarEventosCategorias() {
      // Nueva categoría
      $(document).off('click', '#btnNuevaCategoria').on('click', '#btnNuevaCategoria', function() {
        $('#formCategoria')[0].reset();
        $('#categoriaId').val('');
        $('#categoriaModalLabel').text('Nueva categoría');
        var modal = new bootstrap.Modal(document.getElementById('categoriaModal'));
        modal.show();
      });
      // Editar categoría
      $(document).off('click', '.editar-categoria').on('click', '.editar-categoria', function() {
        var id = $(this).data('id');
        $.getJSON('categorias.php?accion=listar', function(categorias) {
          var categoria = categorias.find(function(c) { return c.id == id; });
          if(categoria) {
            $('#formCategoria')[0].reset();
            $('#categoriaId').val(categoria.id);
            $('#categoriaNombre').val(categoria.nombre);
            $('#categoriaColor').val(categoria.color);
            $('#categoriaModalLabel').text('Editar categoría');
            var modal = new bootstrap.Modal(document.getElementById('categoriaModal'));
            modal.show();
          }
        });
      });
      // Guardar categoría (crear/editar)
      $(document).off('submit', '#formCategoria').on('submit', '#formCategoria', function(e) {
        e.preventDefault();
        var id = $('#categoriaId').val();
        var accion = id ? 'editar' : 'crear';
        var formData = $(this).serialize() + '&accion=' + accion;
        $.post('categorias.php', formData, function(resp) {
          try {
            var data = typeof resp === 'string' ? JSON.parse(resp) : resp;
            if(data.success) {
              mostrarToast(accion === 'crear' ? 'Categoría creada correctamente' : 'Categoría actualizada', 'success');
              var modalEl = document.getElementById('categoriaModal');
              var modal = bootstrap.Modal.getInstance(modalEl);
              if (modal) {
                $(modalEl).one('hidden.bs.modal', function() {
                  cargarCategorias();
                });
                modal.hide();
              } else {
                cargarCategorias();
              }
            } else {
              mostrarToast(data.message || 'Error al guardar categoría', 'danger');
            }
          } catch(e) {
            mostrarToast('Error inesperado al procesar la respuesta', 'danger');
          }
        }).fail(function() {
          mostrarToast('Error de conexión', 'danger');
        });
      });
      // Eliminar categoría
      $(document).off('click', '.eliminar-categoria').on('click', '.eliminar-categoria', function() {
        if(confirm('¿Seguro que deseas eliminar esta categoría?')) {
          var id = $(this).data('id');
          $.post('categorias.php', {accion:'eliminar', id}, function(resp) {
            try {
              var data = typeof resp === 'string' ? JSON.parse(resp) : resp;
              if(data.success) {
                mostrarToast('Categoría eliminada correctamente', 'success');
                cargarCategorias();
              } else {
                mostrarToast(data.message || 'Error al eliminar categoría', 'danger');
              }
            } catch(e) {
              mostrarToast('Error inesperado al procesar la respuesta', 'danger');
            }
          }).fail(function() {
            mostrarToast('Error de conexión', 'danger');
          });
        }
      });
    }

    // Navegación del menú
    $("#adminMenu a").on('click', function(e) {
      e.preventDefault();
      $("#adminMenu a").removeClass('active');
      $(this).addClass('active');
      
      var target = $(this).attr('href');
      if (target === '#noticias') {
        renderNoticias();
      } else if (target === '#usuarios') {
        renderUsuarios();
      } else if (target === '#categorias') {
        renderCategorias();
      } else if (target === '#dashboard') {
        $("#adminContent").html(`
          <h2 class="mb-3">Bienvenido, <?php echo htmlspecialchars($_SESSION['admin_correo']); ?>!</h2>
          <p>Selecciona una opción del menú para gestionar el sistema.</p>
        `);
      } else {
        $("#adminContent").html(`
          <h2 class="mb-3">${$(this).text()}</h2>
          <p>Función en desarrollo.</p>
        `);
      }
    });
  });
  </script>
</body>
</html>