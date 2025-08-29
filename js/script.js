// Funcionalidad SPA
$(document).ready(function () {
  // Validación de formulario de login
  $("#loginForm").on("submit", function (e) {
    e.preventDefault();
    let valid = true;
    const email = $("#loginEmail").val().trim();
    const password = $("#loginPassword").val().trim();

    // Validar email
    if (!email.match(/^\S+@\S+\.\S+$/)) {
      $("#loginEmail").addClass("is-invalid");
      valid = false;
    } else {
      $("#loginEmail").removeClass("is-invalid");
    }
    // Validar password
    if (password.length < 4) {
      $("#loginPassword").addClass("is-invalid");
      valid = false;
    } else {
      $("#loginPassword").removeClass("is-invalid");
    }
    if (valid) {
      // Aquí iría la lógica de autenticación AJAX
      // Por ahora solo cierra el modal
      $("#loginModal").modal("hide");
      $("#loginForm")[0].reset();
    }
  });

  // Validación de formulario de registro
  $("#registerForm").on("submit", function (e) {
    e.preventDefault();
    let valid = true;
    const name = $("#registerName").val().trim();
    const email = $("#registerEmail").val().trim();
    const password = $("#registerPassword").val();
    const password2 = $("#registerPassword2").val();

    // Validar nombre
    if (name.length < 3) {
      $("#registerName").addClass("is-invalid");
      valid = false;
    } else {
      $("#registerName").removeClass("is-invalid");
    }
    // Validar email
    if (!email.match(/^\S+@\S+\.\S+$/)) {
      $("#registerEmail").addClass("is-invalid");
      valid = false;
    } else {
      $("#registerEmail").removeClass("is-invalid");
    }
    // Validar password
    if (password.length < 4) {
      $("#registerPassword").addClass("is-invalid");
      valid = false;
    } else {
      $("#registerPassword").removeClass("is-invalid");
    }
    // Validar confirmación de password
    if (password !== password2 || password2.length < 4) {
      $("#registerPassword2").addClass("is-invalid");
      valid = false;
    } else {
      $("#registerPassword2").removeClass("is-invalid");
    }
    if (valid) {
      // Aquí iría la lógica de registro AJAX
      // Mostrar mensaje de éxito y abrir login
      $("#registerModal").modal("hide");
      $("#registerForm")[0].reset();
      setTimeout(function () {
        // Mostrar alerta de registro exitoso con color de navbar
        $("body").append(`
          <div id='registerSuccessAlert' class='text-center position-fixed top-0 start-50 translate-middle-x mt-3' style='z-index:2000; min-width:300px; background:#293e5a; color:#fff; border-radius:8px; padding:12px 24px; box-shadow:0 2px 8px rgba(0,0,0,0.15); font-weight:bold;'>
            ¡Registro exitoso! Ahora puedes iniciar sesión.
          </div>
        `);
        setTimeout(function () {
          $("#registerSuccessAlert").fadeOut(400, function () {
            $(this).remove();
          });
        }, 2000);
        // Abrir modal de login automáticamente
        $("#loginModal").modal("show");
      }, 500);
    }
  });
  $(".spa-link").on("click", function (e) {
    e.preventDefault();
    const page = $(this).data("page");

    // Marcar enlace activo
    $(".spa-link").removeClass("active-nav");
    $(this).addClass("active-nav");

    // Cargar contenido
    loadPage(page);
  });

  // Cargar la página de inicio automáticamente al cargar el sitio
  loadPage("home");

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
