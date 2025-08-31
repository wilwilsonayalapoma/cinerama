// Edición de usuario: jala datos al formulario y hace la contraseña opcional
$(document).on("click", ".btnEditarUsuario", function () {
  var id = $(this).data("id");
  var nombre = $(this).data("nombre");
  var correo = $(this).data("correo");
  var rol = $(this).data("rol");
  $("#edit_id").val(id);
  $("#nombre").val(nombre);
  $("#correo").val(correo);
  $("#rol").val(rol);
  // Ocultar campo contraseña y mostrar botón para cambiarla
  $("#password").val("").attr("placeholder", "Dejar vacío para no cambiar");
  $("#password").closest(".col-md-6").hide();
  if ($("#cambiarPassBtn").length === 0) {
    $("#rol")
      .closest(".col-md-6")
      .after(
        '<div class="col-md-6"><button type="button" class="btn btn-warning mt-4" id="cambiarPassBtn">Cambiar contraseña</button></div>'
      );
  }
  $("#btnRegistrar").addClass("d-none");
  $("#btnEditar").removeClass("d-none");
  // Subir al formulario y enfocar
  $("html, body").animate(
    { scrollTop: $("#formUsuario").offset().top - 40 },
    400
  );
  $("#nombre").focus();
});

// Mostrar campo contraseña si el usuario quiere cambiarla
$(document).on("click", "#cambiarPassBtn", function () {
  $("#password").closest(".col-md-6").show();
  $(this).remove();
});

// Al cancelar edición, restaurar formulario
$(document).on("click", "#btnRegistrar", function () {
  $("#formUsuario")[0].reset();
  $("#edit_id").val("");
  $("#btnRegistrar").removeClass("d-none");
  $("#btnEditar").addClass("d-none");
  $("#password").closest(".col-md-6").show();
  $("#cambiarPassBtn").remove();
});
// Filtrar usuarios en la tabla por nombre o correo
// Búsqueda automática: filtra y resalta todas las coincidencias
$(document).on("input", "#buscarUsuario", function () {
  var filtro = $(this).val().toLowerCase();
  var hayCoincidencia = false;
  $("#tablaUsuarios tbody tr").each(function () {
    var nombre = $(this).find("td:nth-child(2)").text().toLowerCase();
    var correo = $(this).find("td:nth-child(3)").text().toLowerCase();
    if (filtro.length === 0) {
      $(this).show();
      $(this).removeClass("table-info");
    } else if (nombre.includes(filtro) || correo.includes(filtro)) {
      $(this).show();
      $(this).addClass("table-info");
      hayCoincidencia = true;
    } else {
      $(this).hide();
      $(this).removeClass("table-info");
    }
  });
  // Si no hay coincidencias, puedes mostrar un mensaje o dejar la tabla vacía
});
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

    // SPA: Navegación y renderizado de noticia individual
    $(document).on('click', '.btn-leer-mas', function (e) {
      e.preventDefault();
      var noticiaId = $(this).data('id');
      if (noticiaId) {
        window.location.hash = '#noticia/' + noticiaId;
      }
    });

    function renderNoticia(noticia) {
      var comentariosHtml = '';
      if (noticia.comentarios && noticia.comentarios.length > 0) {
        comentariosHtml = '<h5 class="mt-4">Comentarios</h5><ul class="list-group mb-3">';
        noticia.comentarios.forEach(function(com) {
          comentariosHtml += `<li class="list-group-item"><strong>${com.autor || 'Anónimo'}:</strong> ${com.comentario} <span class="text-muted float-end">${com.fecha}</span></li>`;
        });
        comentariosHtml += '</ul>';
      } else {
        comentariosHtml = '<p class="text-muted">Sin comentarios.</p>';
      }
      var html = `
        <div class="card mb-4">
          <img src="${noticia.imagen}" class="card-img-top" alt="${noticia.titulo}" style="max-height:350px;object-fit:cover;">
          <div class="card-body">
            <h2 class="card-title">${noticia.titulo}</h2>
            <span class="badge" style="background:${noticia.categoria_color};color:#fff;">${noticia.categoria}</span>
            <span class="badge bg-warning ms-2"><i class="fa fa-star"></i> ${noticia.destacados}</span>
            <span class="badge bg-info ms-2"><i class="fa fa-comments"></i> ${noticia.comentarios.length}</span>
            <p class="mt-3">${noticia.contenido}</p>
            <p class="text-muted">Por <strong>${noticia.autor}</strong> el ${noticia.fecha}</p>
          </div>
        </div>
        <div class="card mb-4">
          <div class="card-body">
            ${comentariosHtml}
          </div>
        </div>
        <button class="btn btn-secondary" id="volverInicio"><i class="fa fa-arrow-left"></i> Volver</button>
      `;
      $('#spa-content').html(html);
    }

    function cargarNoticiaPorHash() {
      var hash = window.location.hash;
      var match = hash.match(/^#noticia[\/-](\d+)$/);
      if (match) {
        var noticiaId = match[1];
        $('#spa-content').html('<div class="text-center py-5"><div class="spinner-border text-primary"></div><p>Cargando noticia...</p></div>');
        $.get('api/noticia.php?id=' + noticiaId, function(data) {
          if (data && !data.error) {
            renderNoticia(data);
          } else {
            $('#spa-content').html('<div class="alert alert-danger">No se encontró la noticia.</div>');
          }
        }, 'json').fail(function() {
          $('#spa-content').html('<div class="alert alert-danger">Error al cargar la noticia.</div>');
        });
      }
    }

    $(window).on('hashchange', function() {
      cargarNoticiaPorHash();
    });

    // Volver al inicio desde noticia individual
    $(document).on('click', '#volverInicio', function() {
      window.location.hash = '';
      loadPage('home');
    });

    // Al cargar la página, si hay hash de noticia, mostrarla
    cargarNoticiaPorHash();
});

// Toast Bootstrap para mensajes
function mostrarToast(mensaje, tipo = "success") {
  var toastHtml = `
    <div class="toast align-items-center text-bg-${tipo} border-0 position-fixed top-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true" style="z-index:9999; min-width:250px;">
      <div class="d-flex">
        <div class="toast-body">${mensaje}</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>`;
  var $toast = $(toastHtml);
  $("body").append($toast);
  var toast = new bootstrap.Toast($toast[0]);
  toast.show();
  setTimeout(function () {
    $toast.remove();
  }, 3000);
}

// Envío AJAX para registro de usuario
$(document).on("click", "#btnRegistrar", function (e) {
  e.preventDefault();
  var form = $("#formUsuario");
  var formData = form.serialize();
  $.ajax({
    url: window.location.pathname,
    type: "POST",
    data: formData,
    headers: { "X-Requested-With": "XMLHttpRequest" },
    success: function (data) {
      // Reemplaza el contenido del main dinámico del dashboard
      $("main.col-md-9").html(data);
      // Mostrar alerta de registro exitoso
      mostrarToast("Usuario registrado correctamente", "success");
      // Scroll al formulario y enfocar
      $("html, body").animate(
        { scrollTop: $("#formUsuario").offset().top - 40 },
        400
      );
      $("#nombre").focus();
    },
    error: function () {
      alert("Error al guardar cambios");
    },
  });
});

// Envío AJAX para edición de usuario
$(document).on("click", "#btnEditar", function (e) {
  e.preventDefault();
  var form = $("#formUsuario");
  var formData = form.serialize();
  $.ajax({
    url: window.location.pathname,
    type: "POST",
    data: formData,
    headers: { "X-Requested-With": "XMLHttpRequest" },
    success: function (data) {
      // Reemplaza el contenido del main dinámico del dashboard
      $("main.col-md-9").html(data);
      // Mostrar alerta de edición exitosa
      mostrarToast("Usuario editado correctamente", "info");
      // Scroll al formulario y enfocar
      $("html, body").animate(
        { scrollTop: $("#formUsuario").offset().top - 40 },
        400
      );
      $("#nombre").focus();
    },
    error: function () {
      alert("Error al guardar cambios");
    },
  });
});

// Recargar solo la tabla de usuarios tras eliminar
function recargarTablaUsuarios() {
  $.ajax({
    url: window.location.pathname,
    type: "GET",
    headers: { "X-Requested-With": "XMLHttpRequest" },
    success: function (data) {
      var nuevaTabla = $(data).find("#tablaUsuarios").parent().html();
      $("#tablaUsuarios").parent().html(nuevaTabla);
    },
  });
}

$(document).on("click", ".btn-danger", function (e) {
  var href = $(this).attr("href");
  if (href && href.includes("?delete=")) {
    e.preventDefault();
    if (confirm("¿Seguro que deseas eliminar este usuario?")) {
      $.ajax({
        url: href,
        type: "GET",
        headers: { "X-Requested-With": "XMLHttpRequest" },
        success: function (res) {
          try {
            var data = JSON.parse(res);
            if (data.success) {
              mostrarToast(data.msg, "danger");
              recargarTablaUsuarios();
            }
          } catch (err) {
            mostrarToast("Usuario eliminado", "danger");
            recargarTablaUsuarios();
          }
        },
        error: function () {
          mostrarToast("Error al eliminar usuario", "danger");
        },
      });
    }
  }
});

// Edición de categoría: autocompletar formulario y mostrar botón de editar
$(document).on("click", ".btnEditarCategoria", function () {
  var id = $(this).data("id");
  var nombre = $(this).data("nombre");
  var color = $(this).data("color");
  $("#edit_id").val(id);
  $("#nombre").val(nombre);
  $("#color").val(color);
  $("#btnRegistrarCategoria").addClass("d-none");
  $("#btnEditarCategoria").removeClass("d-none");
  $("html, body").animate(
    { scrollTop: $("#formCategoria").offset().top - 40 },
    400
  );
  $("#nombre").focus();
});

// Cancelar edición de categoría (al registrar)
$(document).on("click", "#btnRegistrarCategoria", function () {
  $("#formCategoria")[0].reset();
  $("#edit_id").val("");
  $("#btnRegistrarCategoria").removeClass("d-none");
  $("#btnEditarCategoria").addClass("d-none");
});

// Envío AJAX para edición de categoría
$(document).on("click", "#btnEditarCategoria", function (e) {
  e.preventDefault();
  var form = $("#formCategoria");
  var formData = form.serialize();
  $.ajax({
    url: window.location.pathname,
    type: "POST",
    data: formData,
    headers: { "X-Requested-With": "XMLHttpRequest" },
    success: function (data) {
      $("main.col-md-9").html(data);
      mostrarToast("Categoría editada correctamente", "info");
      $("#formCategoria")[0].reset();
      $("#edit_id").val("");
      $("#btnRegistrarCategoria").removeClass("d-none");
      $("#btnEditarCategoria").addClass("d-none");
      $("html, body").animate(
        { scrollTop: $("#formCategoria").offset().top - 40 },
        400
      );
      $("#nombre").focus();
    },
    error: function () {
      mostrarToast("Error al editar categoría", "danger");
    },
  });
});

// Edición de noticia: autocompletar formulario y mostrar botón de editar
$(document).on("click", ".btnEditarNoticia", function () {
  var id = $(this).data("id");
  var titulo = $(this).data("titulo");
  var contenido = $(this).data("contenido");
  var categoria_id = $(this).data("categoria_id");
  var usuario_id = $(this).data("usuario_id");
  $("#edit_id").val(id);
  $("#titulo").val(titulo);
  $("#contenido").val(contenido);
  if (categoria_id) $("#categoria_id").val(categoria_id);
  if (usuario_id) $("#usuario_id").val(usuario_id);
  $("#btnRegistrarNoticia").addClass("d-none");
  $("#btnEditarNoticia").removeClass("d-none");
  $("html, body").animate(
    { scrollTop: $("#formNoticia").offset().top - 40 },
    400
  );
  $("#titulo").focus();
});

// Cancelar edición de noticia (al registrar)
$(document).on("click", "#btnRegistrarNoticia", function () {
  $("#formNoticia")[0].reset();
  $("#edit_id").val("");
  $("#btnRegistrarNoticia").removeClass("d-none");
  $("#btnEditarNoticia").addClass("d-none");
});

// Envío AJAX para edición de noticia
$(document).on("click", "#btnEditarNoticia", function (e) {
  e.preventDefault();
  var form = $("#formNoticia");
  var formData = form.serialize();
  $.ajax({
    url: window.location.pathname,
    type: "POST",
    data: formData,
    headers: { "X-Requested-With": "XMLHttpRequest" },
    success: function (data) {
      $("main.col-md-9").html(data);
      mostrarToast("Noticia editada correctamente", "info");
      $("#formNoticia")[0].reset();
      $("#edit_id").val("");
      $("#btnRegistrarNoticia").removeClass("d-none");
      $("#btnEditarNoticia").addClass("d-none");
      $("html, body").animate(
        { scrollTop: $("#formNoticia").offset().top - 40 },
        400
      );
      $("#titulo").focus();
    },
    error: function () {
      mostrarToast("Error al editar noticia", "danger");
    },
  });
});

// Validación extra: solo permitir registrar noticia si usuario_id está definido
$(document).on("submit", "#formNoticia", function (e) {
  if (!$("#usuario_id").val()) {
    e.preventDefault();
    mostrarToast("Selecciona un usuario válido para la noticia", "danger");
    $("#usuario_nombre").focus();
    return false;
  }
});

// Mejorar experiencia visual del autocompletado
$(document).on("input", "#usuario_nombre", function () {
  $("#usuario_nombre").addClass("is-loading");
});
$(document).on("click", ".usuario-sugerido", function () {
  $("#usuario_nombre").removeClass("is-loading").addClass("is-valid");
});
$(document).on("blur", "#usuario_nombre", function () {
  $("#usuario_nombre").removeClass("is-loading");
});

// Al perder foco en usuario_nombre, si coincide con un usuario del datalist, asignar el usuario_id
$(document).on("blur", "#usuario_nombre", function () {
  var nombre = $(this).val();
  var id = "";
  $("#usuariosList option").each(function () {
    if ($(this).val() === nombre) {
      id = $(this).data("id");
      return false;
    }
  });
  $("#usuario_id").val(id);
});

// Ver imagen de noticia en modal grande
$(document).on("click", ".img-noticia-modal", function () {
  var src = $(this).data("img");
  $("#imgModalNoticia").attr("src", src);
  $("#modalImagenNoticia").modal("show");
});

// Validación frontend: imagen no mayor a 2MB
$(document).on("change", "#imagen", function () {
  var file = this.files[0];
  if (file && file.size > 2 * 1024 * 1024) {
    mostrarToast("La imagen no debe superar los 2MB", "danger");
    $(this).val("");
  }
});
