// ========== Helpers ==========
function escapeHTML(str) {
  return $("<div>").text(str).html();
}

function mostrarToast(mensaje, tipo = "info") {
  const toastId = "toast-" + Date.now();
  const toastHtml = `
    <div id="${toastId}" class="toast align-items-center text-bg-${tipo} border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">${mensaje}</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  `;

  $("#toast-container").append(toastHtml);
  const toastEl = document.getElementById(toastId);
  const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
  toast.show();
  toastEl.addEventListener("hidden.bs.toast", () => toastEl.remove());
}

// ========== Sesión ==========
function guardarSesion(usuario) {
  localStorage.setItem("usuario", JSON.stringify(usuario));
}

function obtenerSesion() {
  return JSON.parse(localStorage.getItem("usuario")) || null;
}

function cerrarSesion() {
  localStorage.removeItem("usuario");
  mostrarToast("Sesión cerrada", "info");
  location.reload();
}

// ========== Validación de contraseñas ==========
function validarPassword() {
  const password = $("#registerPassword").val();
  const password2 = $("#registerPassword2").val();
  const errorDiv = $("#passwordError");

  if (password2 && password !== password2) {
    $("#registerPassword2").addClass("is-invalid");
    errorDiv.show();
    return false;
  } else {
    $("#registerPassword2").removeClass("is-invalid");
    errorDiv.hide();
    return true;
  }
}

// ========== Edición de Usuario ==========
if ($("#formUsuario").length) {
  $(document).on("click", ".editar-usuario", function () {
    const id = $(this).data("id");
    const nombre = $(this).data("nombre");
    const email = $(this).data("email");

    $("#formUsuario #userId").val(id);
    $("#formUsuario #nombre").val(nombre);
    $("#formUsuario #email").val(email);

    if ($("#cambiarContrasenaBtn").length === 0) {
      $("#formUsuario")
        .append(
          '<button type="button" id="cambiarContrasenaBtn" class="btn btn-warning mt-2">Cambiar contraseña</button>'
        )
        .append('<div id="contrasenaContainer" style="display:none;"></div>');
    }

    $("html, body").animate({ scrollTop: $("#formUsuario").offset().top }, 500);
  });

  $(document).on("click", "#cambiarContrasenaBtn", function () {
    $("#contrasenaContainer")
      .html(
        `
        <div class="mt-3">
          <label for="password" class="form-label">Nueva Contraseña</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
      `
      )
      .slideDown();
  });
}

// ========== Login ==========
if ($("#loginForm").length) {
  $("#loginForm").on("submit", function (e) {
    e.preventDefault();
    const loginEmail = $("#loginEmail").val().trim();
    const loginPassword = $("#loginPassword").val().trim();

    if (!loginEmail || !loginPassword) {
      mostrarToast("Todos los campos son obligatorios", "danger");
      return;
    }

    // Mostrar loading
    const submitBtn = $(this).find('button[type="submit"]');
    const originalText = submitBtn.html();
    submitBtn.html(
      '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Ingresando...'
    );
    submitBtn.prop("disabled", true);

    $.ajax({
      url: "api/login.php",
      type: "POST",
      data: { correo: loginEmail, password: loginPassword },
      success: function (resp) {
        console.log("Respuesta login:", resp);

        let data = {};
        if (typeof resp === "object") {
          data = resp;
        } else if (typeof resp === "string") {
          try {
            data = JSON.parse(resp);
          } catch (e) {
            console.error("Error parsing login JSON:", e, "Response:", resp);
            mostrarToast("Error en la respuesta del servidor", "danger");
            submitBtn.html(originalText);
            submitBtn.prop("disabled", false);
            return;
          }
        } else {
          console.error("Tipo de respuesta inesperado:", typeof resp, resp);
          mostrarToast(
            "Error: Tipo de respuesta inesperado del servidor.",
            "danger"
          );
          submitBtn.html(originalText);
          submitBtn.prop("disabled", false);
          return;
        }

        if (data.success) {
          guardarSesion({
            id: data.id,
            nombre: data.nombre,
            correo: data.correo,
            rol_id: data.rol_id,
          });

          if (localStorage.getItem("registroExitoso")) {
            mostrarToast(
              "¡Registrado correctamente! Ahora inicia sesión.",
              "success"
            );
            localStorage.removeItem("registroExitoso");
          } else {
            mostrarToast("Inicio de sesión exitoso", "success");
          }

          // Cerrar modal login
          const loginModalEl = document.getElementById("loginModal");
          const loginModal =
            bootstrap.Modal.getInstance(loginModalEl) ||
            new bootstrap.Modal(loginModalEl);
          loginModal.hide();

          $("#loginForm")[0].reset();
          window.location.hash = "#home";
          setTimeout(function () {
            location.reload();
          }, 800);
        } else {
          mostrarToast(data.msg || "Credenciales incorrectas", "danger");
        }

        submitBtn.html(originalText);
        submitBtn.prop("disabled", false);
      },
      error: function (xhr, status, error) {
        console.error("Error en login:", status, error);
        mostrarToast("Error de conexión con el servidor", "danger");
        submitBtn.html(originalText);
        submitBtn.prop("disabled", false);
      },
    });
  });
}

// ========== Registro ==========
if ($("#registerForm").length) {
  $("#registerForm").submit(function (e) {
    e.preventDefault();

    const nombre = $("#registerName").val().trim();
    const correo = $("#registerEmail").val().trim();
    const password = $("#registerPassword").val().trim();
    const password2 = $("#registerPassword2").val().trim();

    // Validaciones
    if (!nombre || !correo || !password || !password2) {
      mostrarToast("Todos los campos son obligatorios", "warning");
      return;
    }

    if (password !== password2) {
      mostrarToast("Las contraseñas no coinciden", "warning");
      return;
    }

    if (password.length < 6) {
      mostrarToast("La contraseña debe tener al menos 6 caracteres", "warning");
      return;
    }

    // Mostrar loading
    const submitBtn = $(this).find('button[type="submit"]');
    const originalText = submitBtn.html();
    submitBtn.html(
      '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Registrando...'
    );
    submitBtn.prop("disabled", true);

    $.ajax({
      url: "api/register.php",
      type: "POST",
      data: {
        nombre: nombre,
        correo: correo,
        password: password,
      },
      success: function (resp) {
        console.log("Respuesta registro (raw):", resp);
        console.log("Tipo de respuesta:", typeof resp);

        let data = {};

        // Manejar ambos casos: objeto ya parseado o string JSON
        if (typeof resp === "object") {
          // Ya es un objeto (probablemente ya fue parseado automáticamente)
          data = resp;
          console.log("Respuesta ya es objeto:", data);
        } else if (typeof resp === "string") {
          // Es un string, necesita parsing
          try {
            data = JSON.parse(resp);
            console.log("Respuesta parseada desde string:", data);
          } catch (e) {
            console.error("Error parsing registro JSON:", e);
            console.error("Respuesta completa:", resp);
            mostrarToast(
              "Error: La respuesta del servidor no es válida.",
              "danger"
            );
            submitBtn.html(originalText);
            submitBtn.prop("disabled", false);
            return;
          }
        } else {
          console.error("Tipo de respuesta inesperado:", typeof resp, resp);
          mostrarToast(
            "Error: Tipo de respuesta inesperado del servidor.",
            "danger"
          );
          submitBtn.html(originalText);
          submitBtn.prop("disabled", false);
          return;
        }

        if (data.success) {
          mostrarToast(
            data.msg || "¡Registrado correctamente! Ahora inicia sesión.",
            "success"
          );

          $("#registerForm")[0].reset();

          // Cerrar modal de registro
          const registerModal = bootstrap.Modal.getInstance(
            document.getElementById("registerModal")
          );
          if (registerModal) {
            registerModal.hide();
          }

          // Abrir modal de login
          setTimeout(() => {
            const loginModal = new bootstrap.Modal(
              document.getElementById("loginModal")
            );
            loginModal.show();

            $("#loginEmail").val(correo);
            $("#loginPassword").focus();
          }, 500);
        } else {
          mostrarToast(data.msg || "Error al registrar usuario", "danger");
        }

        submitBtn.html(originalText);
        submitBtn.prop("disabled", false);
      },
      error: function (xhr, status, error) {
        console.error("Error en petición AJAX:", status, error);
        console.error("Response text:", xhr.responseText);

        mostrarToast("Error de conexión: " + error, "danger");
        submitBtn.html(originalText);
        submitBtn.prop("disabled", false);
      },
    });
  });
}

// ========== Buscador ==========
if ($("#navbarSearchForm").length) {
  $("#navbarSearchForm").on("submit", function (e) {
    e.preventDefault();
    const query = $("#navbarSearchInput").val().trim();

    if (query.length < 2) {
      mostrarToast("Ingresa al menos 2 caracteres para buscar", "warning");
      return;
    }

    window.location.hash = `#buscar-${encodeURIComponent(query)}`;
  });
}

// ========== Inicialización ==========
$(document).ready(function () {
  console.log("CineramaTV SPA inicializado");

  // Verificar si hay una sesión activa
  const usuario = obtenerSesion();
  if (usuario) {
    console.log("Usuario logueado:", usuario);
    $(".fa-user-circle").css("color", "#4CAF50");
  }

  // Inicializar tooltips
  $("[title]").tooltip();
});
