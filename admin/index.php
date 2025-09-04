<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Administración - Cinerama</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body class="bg-light">
  <style>
    body {
      background: url('../assets/img/fondo1-1.webp') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
    }
    .admin-login-card {
      background: rgba(41, 62, 90, 0.85);
      border-radius: 18px;
      box-shadow: 0 4px 24px rgba(41, 62, 90, 0.25);
      color: #fff;
    }
    .admin-login-card .form-label {
      color: #e3e3e3;
    }
    .admin-login-card .form-control {
      background: rgba(255,255,255,0.15);
      color: #fff;
      border: 1px solid #e3e3e3;
    }
    .admin-login-card .form-control::placeholder {
      color: #b0b0b0;
    }
    .admin-login-card .btn-primary {
      background: #e67e22;
      border: none;
      font-weight: bold;
    }
    .admin-login-card .btn-primary:hover {
      background: #d35400;
    }
    .admin-login-card .card-header {
      background: transparent;
      border-bottom: 1px solid #e3e3e3;
      color: #fff;
    }
    #adminLoginMsg .alert {
      background: #c0392b;
      color: #fff;
      border: none;
    }
  </style>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card admin-login-card shadow-lg">
          <div class="card-header text-center">
            <h3>Acceso Administrador</h3>
          </div>
          <div class="card-body">
            <form id="adminLoginForm" method="POST" action="login.php">
              <div class="mb-3">
                <label for="adminEmail" class="form-label">Correo de administrador</label>
                <input type="email" class="form-control" id="adminEmail" name="email" placeholder="admin@cinerama.com" required />
              </div>
              <div class="mb-3">
                <label for="adminPassword" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="adminPassword" name="password" placeholder="Contraseña" required />
              </div>
              <button type="submit" class="btn btn-primary w-100">Ingresar</button>
            </form>
            <div id="adminLoginMsg" class="mt-3"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
