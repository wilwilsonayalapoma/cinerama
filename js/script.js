// Funcionalidad SPA
$(document).ready(function () {
  // Manejar clics en enlaces SPA
  $(".spa-link").on("click", function (e) {
    e.preventDefault();
    const page = $(this).data("page");

    // Marcar enlace activo
    $(".spa-link").removeClass("active-nav");
    $(this).addClass("active-nav");

    // Cargar contenido
    loadPage(page);
  });

  // Función para cargar páginas
  function loadPage(page) {
    $.ajax({
      url: "modules/" + page + ".php",
      method: "GET",
      beforeSend: function () {
        // Mostrar spinner de carga
        $("#spa-content").html(`
                    <div class="d-flex justify-content-center align-items-center" style="height: 300px;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                    </div>
                `);
      },
      success: function (data) {
        $("#spa-content").html(data);
        // Actualizar URL sin recargar
        window.history.pushState({ page: page }, "", `?page=${page}`);

        // Inicializar componentes Bootstrap que puedan necesitarse
        $('[data-bs-toggle="tooltip"]').tooltip();
      },
      error: function () {
        $("#spa-content").html(`
                    <div class="alert alert-danger text-center">
                        <h4>Error al cargar el contenido</h4>
                        <p>Intenta nuevamente en unos momentos.</p>
                        <button class="btn btn-primary" onclick="location.reload()">Recargar página</button>
                    </div>
                `);
      },
    });
  }

  // Manejar botón atrás/adelante del navegador
  window.onpopstate = function (event) {
    if (event.state && event.state.page) {
      const page = event.state.page;
      $(".spa-link").removeClass("active-nav");
      $(`.spa-link[data-page="${page}"]`).addClass("active-nav");
      loadPage(page);
    }
  };

  // Cargar página basada en parámetro de URL al inicio
  const urlParams = new URLSearchParams(window.location.search);
  const pageParam = urlParams.get("page");
  if (pageParam) {
    $(`.spa-link[data-page="${pageParam}"]`).click();
  }

  // Inicializar tooltips de Bootstrap
  $('[data-bs-toggle="tooltip"]').tooltip();
});
