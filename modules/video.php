<?php
// Módulo de video (página específica de videos)
?>
<section class="news-section">
    <h2 class="section-title mb-4">Sección de Videos</h2>
    <div class="row">
        <div class="col-md-8">
            <div class="video-container mb-4">
                <iframe src="https://owncloud1692001.fasthostunlimited.com/embed/video" 
                        allowfullscreen></iframe>
            </div>
            <div class="mb-4">
                <h3>Título del Video Principal</h3>
                <p>Descripción completa del video. Este contenido ha sido embedido desde el servidor propio.</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted">Publicado el <?php echo date('d/m/Y'); ?></span>
                        <span class="badge bg-success ms-2">Exclusivo</span>
                    </div>
                    <div>
                        <button class="btn btn-outline-primary btn-sm me-2"><i class="fas fa-thumbs-up"></i> 245</button>
                        <button class="btn btn-outline-secondary btn-sm"><i class="fas fa-comment"></i> 32</button>
                    </div>
                </div>
            </div>
            
            <h4 class="mb-3">Más Videos</h4>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card article-card">
                        <div class="video-container-small">
                            <iframe src="https://owncloud1692001.fasthostunlimited.com/embed/video" 
                                    allowfullscreen></iframe>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Video Secundario 1</h5>
                            <p class="card-text">Breve descripción del video secundario.</p>
                            <a href="#" class="btn btn-primary btn-sm">Ver video</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card article-card">
                        <div class="video-container-small">
                            <iframe src="https://owncloud1692001.fasthostunlimited.com/embed/video" 
                                    allowfullscreen></iframe>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Video Secundario 2</h5>
                            <p class="card-text">Breve descripción del video secundario.</p>
                            <a href="#" class="btn btn-primary btn-sm">Ver video</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="bg-light-custom p-3 rounded mb-4">
                <h4>Categorías de Video</h4>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">Todos los videos</a>
                    <a href="#" class="list-group-item list-group-item-action">Noticias</a>
                    <a href="#" class="list-group-item list-group-item-action">Deportes</a>
                    <a href="#" class="list-group-item list-group-item-action">Entretenimiento</a>
                    <a href="#" class="list-group-item list-group-item-action">Documentales</a>
                </div>
            </div>
            
            <div class="bg-light-custom p-3 rounded mb-4">
                <h4>Videos Populares</h4>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex align-items-center">
                            <img src="https://via.placeholder.com/60x40?text=Mini" alt="Miniatura" class="me-2">
                            <div>
                                <h6 class="mb-0">Video popular 1</h6>
                                <small class="text-muted">125k vistas</small>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex align-items-center">
                            <img src="https://via.placeholder.com/60x40?text=Mini" alt="Miniatura" class="me-2">
                            <div>
                                <h6 class="mb-0">Video popular 2</h6>
                                <small class="text-muted">98k vistas</small>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex align-items-center">
                            <img src="https://via.placeholder.com/60x40?text=Mini" alt="Miniatura" class="me-2">
                            <div>
                                <h6 class="mb-0">Video popular 3</h6>
                                <small class="text-muted">76k vistas</small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>