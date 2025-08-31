<?php
include_once __DIR__ . '/config/db.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$noticia = null;
if ($id > 0) {
    $sql = "SELECT n.*, c.nombre as categoria, c.color as categoria_color, u.nombre as autor FROM noticias n LEFT JOIN categorias c ON n.categoria_id = c.id LEFT JOIN usuarios u ON n.usuario_id = u.id WHERE n.id = $id LIMIT 1";
    $res = $conn->query($sql);
    if ($res && $res->num_rows > 0) {
        $noticia = $res->fetch_assoc();
    }
}
// Procesar comentario por AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'comentar' && isset($_POST['noticia_id']) && isset($_POST['usuario_id']) && isset($_POST['comentario'])) {
    $noticia_id = intval($_POST['noticia_id']);
    $usuario_id = intval($_POST['usuario_id']);
    $comentario = $conn->real_escape_string($_POST['comentario']);
    if (strlen($comentario) < 2) {
        echo json_encode(['success' => false, 'msg' => 'El comentario es muy corto.']);
        exit;
    }
    $conn->query("INSERT INTO comentarios (noticia_id, usuario_id, comentario) VALUES ($noticia_id, $usuario_id, '$comentario')");
    echo json_encode(['success' => true]);
    exit;
}
// Obtener comentarios
$comentarios = [];
if ($id > 0) {
    $res = $conn->query("SELECT c.comentario, c.fecha, u.nombre as autor FROM comentarios c LEFT JOIN usuarios u ON c.usuario_id = u.id WHERE c.noticia_id = $id ORDER BY c.fecha DESC");
    while ($row = $res->fetch_assoc()) {
        $comentarios[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $noticia ? htmlspecialchars($noticia['titulo']) : 'Noticia no encontrada'; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <!-- Header -->
    <header>
      <div class="container-fluid bg-dark text-white py-2 text-center">
        <div class="row">
          <div class="col">
       <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="5000">
        <a href="https://www.oep.org.bo/"><img src="assets/img/Banner Resultaos (CINERAMA MULTIMEDIA)_Mesa de trabajo 1.png" class="d-block w-100" alt="Noticia 1" style="height:150px; object-fit:cover;cursor: pointer;"></a>
      </div>
      <div class="carousel-item" data-bs-interval="5000">
        <a href="https://www.oep.org.bo/"><img src="assets/img/Banner-CINERAMA-MULTIMEDIA-Jurados_Mesa-de-trabajo-1.png" class="d-block w-100" alt="Noticia 2" style="height:150px; object-fit:cover; cursor: pointer;"></a>
      </div>
      <div class="carousel-item" data-bs-interval="5000">
        <a href="https://www.oep.org.bo/"><img src="assets/img/Banner-CINERAMA-MULTIMEDIA-Sirepre_Mesa-de-trabajo-1.png" class="d-block w-100" alt="Noticia 3" style="height:150px; object-fit:cover; cursor: pointer;"></a>
      </div>
      <div class="carousel-item" data-bs-interval="5000">
        <a href="https://www.oep.org.bo/"><img src="assets/img/fondo1-1.webp" class="d-block w-100" alt="Noticia 4" style="height:150px; object-fit:cover; cursor: pointer;"></a>
      </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
        </div>
      </div>
      <nav class="navbar navbar-expand-lg navbar-light bg-custom">
        <div class="container">
          <a class="navbar-brand" href="index.html">CineramaTV</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link active-nav" href="index.html">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="modules/national.php">Nacional</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="modules/internacional.php">Internacional</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="modules/deportes.php">Deportes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="modules/cultura.php">Cultura</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="modules/video.php">Video</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      </div>
    </div>
  </div>
</header>
    <main class="container py-5">
        <?php if ($noticia): ?>
            <div class="card mb-4">
                <?php if (!empty($noticia['imagen'])): ?>
                    <img src="assets/img/<?php echo htmlspecialchars($noticia['imagen']); ?>" class="card-img-top" alt="Imagen noticia" style="max-height:350px;object-fit:cover;">
                <?php endif; ?>
                <div class="card-body">
                    <span class="badge" style="background:<?php echo htmlspecialchars($noticia['categoria_color']); ?>;color:#fff;">
                        <?php echo htmlspecialchars($noticia['categoria']); ?>
                    </span>
                    <h2 class="card-title mt-2 mb-3"><?php echo htmlspecialchars($noticia['titulo']); ?></h2>
                    <p class="card-text" style="font-size:1.2em;"><?php echo nl2br(htmlspecialchars($noticia['contenido'])); ?></p>
                    <div class="mt-3 mb-3 d-flex gap-2">
    <span class="text-muted">Publicado el <?php echo date('d/m/Y', strtotime($noticia['fecha'])); ?></span>
    <span class="ms-3">Por: <?php echo htmlspecialchars($noticia['autor']); ?></span>
</div>
<div class="mb-4">
    <span>Compartir:</span>
    <a href="https://wa.me/?text=<?php echo urlencode($noticia['titulo'] . ' ' . 'https://'.$_SERVER['HTTP_HOST'].'/noticia.php?id='.$noticia['id']); ?>" target="_blank" class="btn btn-success btn-sm mx-1" title="Compartir en WhatsApp"><i class="fab fa-whatsapp"></i></a>
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('https://'.$_SERVER['HTTP_HOST'].'/noticia.php?id='.$noticia['id']); ?>" target="_blank" class="btn btn-primary btn-sm mx-1" title="Compartir en Facebook"><i class="fab fa-facebook"></i></a>
    <a href="mailto:?subject=<?php echo urlencode($noticia['titulo']); ?>&body=<?php echo urlencode('Mira esta noticia: https://'.$_SERVER['HTTP_HOST'].'/noticia.php?id='.$noticia['id']); ?>" class="btn btn-danger btn-sm mx-1" title="Compartir por Gmail"><i class="fas fa-envelope"></i></a>
</div>
                    <a href="index.html" class="btn btn-secondary mt-4">Volver al inicio</a>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-comments"></i> Comentarios</h5>
                </div>
                <div class="card-body">
                    <form id="formComentario" class="d-flex mb-3">
                        <input type="text" class="form-control me-2" name="comentario" placeholder="Escribe un comentario..." maxlength="255" required>
                        <button type="submit" class="btn btn-success">Comentar</button>
                    </form>
                    <div id="comentariosList">
                        <?php if (count($comentarios) === 0): ?>
                            <p class="text-muted">No hay comentarios aún.</p>
                        <?php else: ?>
                            <?php foreach ($comentarios as $c): ?>
                                <div class="mb-2 border-bottom pb-2">
                                    <strong><?php echo htmlspecialchars($c['autor']); ?></strong>
                                    <span class="text-muted ms-2" style="font-size:0.9em;"><?php echo date('d/m/Y', strtotime($c['fecha'])); ?></span>
                                    <p class="mb-1 mt-1"><?php echo htmlspecialchars($c['comentario']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">Noticia no encontrada.</div>
            <a href="index.html" class="btn btn-secondary">Volver al inicio</a>
        <?php endif; ?>
    </main>
    <footer class="footer-custom text-white py-4 mt-5">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h5>Cinerama Tv</h5>
            <p>Tu fuente confiable de noticias actualizadas las 24 horas.</p>
          </div>
          <div class="col-md-4">
            <h5>Enlaces útiles</h5>
            <ul class="list-unstyled">
              <li><a href="about.html" class="text-white">Sobre nosotros</a></li>
              <li><a href="contacto.html" class="text-white">Contacto</a></li>
              <li><a href="privacidad.html" class="text-white">Política de privacidad</a></li>
            </ul>
          </div>
          <div class="col-md-4">
            <h5>Síguenos</h5>
            <div class="d-flex gap-3">
              <a href="https://facebook.com" class="text-white" target="_blank"><i class="fab fa-facebook fa-2x"></i></a>
              <a href="https://twitter.com" class="text-white" target="_blank"><i class="fab fa-twitter fa-2x"></i></a>
              <a href="https://instagram.com" class="text-white" target="_blank"><i class="fab fa-instagram fa-2x"></i></a>
            </div>
          </div>
        </div>
        <hr />
        <p class="text-center mb-0">&copy; <?php echo date('Y'); ?> Cinerama. Todos los derechos reservados.</p>
      </div>
    </footer>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery para AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
      var comentando = false;
      $('#formComentario').submit(function(e) {
        e.preventDefault();
        if (comentando) return;
        comentando = true;
        var noticiaId = <?php echo $id; ?>;
        var usuarioId = 1; // Reemplaza por el id del usuario logueado
        var comentario = $(this).find('input[name="comentario"]').val();
        $.post('noticia.php?id=' + noticiaId, { accion: 'comentar', noticia_id: noticiaId, usuario_id: usuarioId, comentario: comentario }, function(resp) {
          var data = {};
          try { data = JSON.parse(resp); } catch(e) {}
          if (data.success) {
            window.location.href = 'noticia.php?id=' + noticiaId;
          } else {
            alert(data.msg || 'Error al comentar.');
          }
          comentando = false;
        });
      });
    });
    </script>
</body>
</html>
