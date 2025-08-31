<?php
include_once __DIR__ . '/../config/db.php';
// Obtener el id de la categoría Nacional
$categoria_nacional = $conn->query("SELECT id, color FROM categorias WHERE nombre = 'Nacional' LIMIT 1")->fetch_assoc();
$nacional_id = $categoria_nacional ? $categoria_nacional['id'] : 0;
$nacional_color = $categoria_nacional ? $categoria_nacional['color'] : '#293E5A';
// Procesar destacado por AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'destacar' && isset($_POST['noticia_id']) && isset($_POST['usuario_id'])) {
    $noticia_id = intval($_POST['noticia_id']);
    $usuario_id = intval($_POST['usuario_id']);
    $existe = $conn->query("SELECT id FROM destacados WHERE noticia_id=$noticia_id AND usuario_id=$usuario_id LIMIT 1");
    if ($existe && $existe->num_rows == 0) {
        $conn->query("INSERT INTO destacados (noticia_id, usuario_id) VALUES ($noticia_id, $usuario_id)");
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'msg' => 'Ya has destacado esta noticia.']);
    }
    exit;
}
// Obtener noticias nacionales
$noticias = $conn->query("SELECT * FROM noticias WHERE categoria_id = $nacional_id ORDER BY fecha DESC");
?>
<section class="container py-5">
    <h2 class="mb-4">Noticias Nacionales</h2>
    <div class="row">
        <?php while ($noticia = $noticias->fetch_assoc()): ?>
            <?php
            $destacados = $conn->query("SELECT COUNT(*) as total FROM destacados WHERE noticia_id = " . $noticia['id']);
            $total_destacados = $destacados ? $destacados->fetch_assoc()['total'] : 0;
            ?>
            <div class="col-md-6 mb-4">
                <div class="card article-card">
                    <img src="<?php echo !empty($noticia['imagen']) ? 'assets/img/' . htmlspecialchars($noticia['imagen']) : 'https://via.placeholder.com/400x250?text=Sin+Imagen'; ?>" class="card-img-top" alt="Noticia" style="height:220px;object-fit:cover;">
                    <div class="card-body">
                        <span class="badge" style="background:<?php echo htmlspecialchars($nacional_color); ?>;color:#fff;">Nacional</span>
                        <h5 class="card-title"><?php echo htmlspecialchars($noticia['titulo']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($noticia['resumen']); ?></p>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span><i class="fas fa-star text-warning"></i> <span class="destacados-count" data-id="<?php echo $noticia['id']; ?>"><?php echo $total_destacados; ?></span> Destacados</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="../noticia.php?id=<?php echo $noticia['id']; ?>" class="btn btn-primary btn-sm">Leer más</a>
                            <button class="btn btn-warning btn-sm destacar-btn" data-id="<?php echo $noticia['id']; ?>"><i class="fas fa-star"></i> Destacar</button>
                            <small class="text-muted"><?php echo date('d/m/Y', strtotime($noticia['fecha'])); ?></small>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('.destacar-btn').click(function() {
    var noticiaId = $(this).data('id');
    var usuarioId = 1; // Reemplaza por el id del usuario logueado
    var $btn = $(this);
    $.post('modules/national.php', { accion: 'destacar', noticia_id: noticiaId, usuario_id: usuarioId }, function(resp) {
      var data = {};
      try { data = JSON.parse(resp); } catch(e) {}
      if (data.success) {
        var $count = $('.destacados-count[data-id="' + noticiaId + '"]');
        $count.text(parseInt($count.text()) + 1);
        $btn.prop('disabled', true);
      } else {
        alert(data.msg || 'Ya has destacado esta noticia.');
      }
    });
  });
});
</script>