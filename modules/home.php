<?php
include_once __DIR__ . '/../config/db.php';
// Módulo de página de inicio con video como noticia principal
?>
<section class="news-section">
    <div class="row">
        <div class="col-md-8">
            <!-- Video como noticia principal -->
            <div class="video-container mb-4">
                <iframe src="https://owncloud1692001.fasthostunlimited.com/embed/video" 
                        allowfullscreen></iframe>
            </div>
            <div class="mb-4">
                <h2 class="mb-3">Video Destacado: Título de la Noticia Principal</h2>
                <p class="lead">Descripción completa del video noticia. Este contenido ha sido embedido desde el servidor propio y representa la noticia más importante del día.</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted">Publicado el <?php echo date('d/m/Y'); ?></span>
                        <span class="badge bg-danger ms-2">En vivo</span>
                    </div>
                    <div>
                        <button class="btn btn-outline-primary btn-sm me-2"><i class="fas fa-share-alt"></i> Compartir</button>
                        <button class="btn btn-outline-secondary btn-sm"><i class="fas fa-bookmark"></i> Guardar</button>
                    </div>
                </div>
            </div>
            <h2 class="section-title my-4">Últimas Noticias</h2>
            <div class="row">
<?php
$noticias = $conn->query("SELECT n.*, c.nombre as categoria, c.color as categoria_color FROM noticias n LEFT JOIN categorias c ON n.categoria_id = c.id ORDER BY n.fecha DESC LIMIT 4");
while ($noticia = $noticias->fetch_assoc()) {
    $img = !empty($noticia['imagen']) ? 'assets/img/' . htmlspecialchars($noticia['imagen']) : 'https://via.placeholder.com/400x250?text=Sin+Imagen';
    $categoria = $noticia['categoria'] ?? 'Sin categoría';
    $cat_color = !empty($noticia['categoria_color']) ? $noticia['categoria_color'] : 'secondary';
    echo '<div class="col-md-6 mb-4">';
    echo '  <div class="card article-card">';
    echo '    <img src="' . $img . '" class="card-img-top" alt="Noticia" style="height:220px;object-fit:cover;">';
    echo '    <div class="card-body">';
    echo '      <span class="badge" style="background:' . htmlspecialchars($cat_color) . ';color:#fff;">' . htmlspecialchars($categoria) . '</span>';
    echo '      <h5 class="card-title">' . htmlspecialchars($noticia['titulo']) . '</h5>';
    echo '      <p class="card-text">' . htmlspecialchars($noticia['resumen']) . '</p>';
    echo '      <div class="d-flex justify-content-between align-items-center">';
    echo '        <a href="noticia.php?id=' . $noticia['id'] . '" class="btn btn-primary btn-sm">Leer más</a>';
    echo '        <small class="text-muted">' . date('d/m/Y H:i', strtotime($noticia['fecha'])) . '</small>';
    echo '      </div>';
    echo '    </div>';
    echo '  </div>';
    echo '</div>';
}
?>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="bg-light-custom p-3 rounded mb-4">
                <h4>Noticias Destacadas</h4>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Destacada 1: Titular importante</h6>
                            <small class="text-muted">Hoy</small>
                        </div>
                        <p class="mb-1">Resumen breve de la noticia destacada.</p>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Destacada 2: Otro titular</h6>
                            <small class="text-muted">Hoy</small>
                        </div>
                        <p class="mb-1">Resumen breve de la noticia destacada.</p>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Destacada 3: Tercer titular</h6>
                            <small class="text-muted">Ayer</small>
                        </div>
                        <p class="mb-1">Resumen breve de la noticia destacada.</p>
                    </a>
                </div>
            </div>
            
            <div class="bg-light-custom p-3 rounded mb-4">
                <h4>Clasificación Deportiva</h4>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Equipo A
                        <span class="badge bg-primary rounded-pill">42 pts</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Equipo B
                        <span class="badge bg-primary rounded-pill">38 pts</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Equipo C
                        <span class="badge bg-primary rounded-pill">35 pts</span>
                    </li>
                </ul>
            </div>
            
            <div class="bg-light-custom p-3 rounded">
                <h4>Boletín informativo</h4>
                <p>Suscríbete para recibir las últimas noticias</p>
                <form>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Tu email">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Suscribirse</button>
                </form>
            </div>
        </div>
    </div>
</section>