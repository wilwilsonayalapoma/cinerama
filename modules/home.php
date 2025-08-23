<?php
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
                <div class="col-md-6 mb-4">
                    <div class="card article-card">
                        <img src="https://via.placeholder.com/400x250?text=Noticia+1" class="card-img-top" alt="Noticia 1">
                        <div class="card-body">
                            <span class="badge bg-primary mb-2">Nacional</span>
                            <h5 class="card-title">Título de la noticia 1</h5>
                            <p class="card-text">Breve descripción de la noticia que aparecerá aquí como resumen.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="#" class="btn btn-primary btn-sm">Leer más</a>
                                <small class="text-muted">Hace 2 horas</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card article-card">
                        <img src="https://via.placeholder.com/400x250?text=Noticia+2" class="card-img-top" alt="Noticia 2">
                        <div class="card-body">
                            <span class="badge bg-success mb-2">Internacional</span>
                            <h5 class="card-title">Título de la noticia 2</h5>
                            <p class="card-text">Breve descripción de la noticia que aparecerá aquí como resumen.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="#" class="btn btn-primary btn-sm">Leer más</a>
                                <small class="text-muted">Hace 4 horas</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card article-card">
                        <img src="https://via.placeholder.com/400x250?text=Noticia+3" class="card-img-top" alt="Noticia 3">
                        <div class="card-body">
                            <span class="badge bg-warning mb-2">Deportes</span>
                            <h5 class="card-title">Título de la noticia 3</h5>
                            <p class="card-text">Breve descripción de la noticia que aparecerá aquí como resumen.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="#" class="btn btn-primary btn-sm">Leer más</a>
                                <small class="text-muted">Hace 6 horas</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card article-card">
                        <img src="https://via.placeholder.com/400x250?text=Noticia+4" class="card-img-top" alt="Noticia 4">
                        <div class="card-body">
                            <span class="badge bg-info mb-2">Cultura</span>
                            <h5 class="card-title">Título de la noticia 4</h5>
                            <p class="card-text">Breve descripción de la noticia que aparecerá aquí como resumen.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="#" class="btn btn-primary btn-sm">Leer más</a>
                                <small class="text-muted">Ayer</small>
                            </div>
                        </div>
                    </div>
                </div>
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