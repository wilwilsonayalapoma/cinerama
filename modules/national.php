<?php
// Módulo de noticias nacionales (ejemplo)
?>
<section class="news-section">
    <h2 class="mb-4">Noticias Nacionales</h2>
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <img src="https://via.placeholder.com/800x400?text=Noticia+Nacional" class="card-img-top" alt="Noticia nacional">
                <div class="card-body">
                    <h3 class="card-title">Título de noticia nacional importante</h3>
                    <p class="card-text"><small class="text-muted">Publicado el <?php echo date('d/m/Y'); ?></small></p>
                    <p class="card-text">Contenido completo de la noticia nacional. Aquí iría el desarrollo de la noticia con todos los detalles relevantes para los lectores.</p>
                    <a href="#" class="btn btn-primary">Seguir leyendo</a>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card article-card h-100">
                        <img src="https://via.placeholder.com/400x250?text=Nacional+1" class="card-img-top" alt="Noticia nacional 1">
                        <div class="card-body">
                            <h5 class="card-title">Otra noticia nacional</h5>
                            <p class="card-text">Breve descripción de la noticia nacional que aparecerá aquí como resumen.</p>
                            <a href="#" class="btn btn-primary">Leer más</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card article-card h-100">
                        <img src="https://via.placeholder.com/400x250?text=Nacional+2" class="card-img-top" alt="Noticia nacional 2">
                        <div class="card-body">
                            <h5 class="card-title">Otra noticia nacional</h5>
                            <p class="card-text">Breve descripción de la noticia nacional que aparecerá aquí como resumen.</p>
                            <a href="#" class="btn btn-primary">Leer más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="bg-light p-3 rounded mb-4">
                <h4>Noticias por región</h4>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">Norte</a>
                    <a href="#" class="list-group-item list-group-item-action">Sur</a>
                    <a href="#" class="list-group-item list-group-item-action">Este</a>
                    <a href="#" class="list-group-item list-group-item-action">Oeste</a>
                </div>
            </div>
        </div>
    </div>
</section>