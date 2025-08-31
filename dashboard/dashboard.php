<?php
// Dashboard principal
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Cinerama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Menú lateral -->
            <nav id="sidebarMenu" class="col-md-2 d-none d-md-block bg-footer sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column text-white">
                        <li class="nav-item mb-3 text-center">
                            <button id="toggleSidebar" class="btn btn-warning"><i class="fas fa-bars"></i></button>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link text-white" href="usuarios.php"><i class="fas fa-users"></i> Usuarios</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link text-white" href="#"><i class="fas fa-newspaper"></i> Noticias</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link text-white" href="#"><i class="fas fa-envelope"></i> Suscripciones</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link text-white" href="#"><i class="fas fa-bullhorn"></i> Publicidad</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link text-white" href="#"><i class="fas fa-list"></i> Categorías</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link text-white" href="#"><i class="fas fa-video"></i> Strimer</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link text-white" href="#"><i class="fas fa-comments"></i> Comentarios</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link text-white" href="#"><i class="fas fa-chart-bar"></i> Estadísticas</a>
                        </li>
                        <li class="nav-item mt-4 text-center">
                            <button id="closeSidebar" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i></button>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Contenido principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Bienvenido al Dashboard</h1>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Usuarios</h5>
                                <p class="card-text">Gestión de usuarios registrados.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Noticias</h5>
                                <p class="card-text">Administrar noticias publicadas.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Estadísticas</h5>
                                <p class="card-text">Ver estadísticas del sitio.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <button id="showSidebar" class="btn btn-warning position-fixed top-0 start-0 m-2" style="display:none;z-index:1050;"><i class="fas fa-bars"></i></button>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="dashboard.js"></script>
</body>
</html>
