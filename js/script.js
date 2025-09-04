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

    $.post(
      "api/login.php",
      { correo: loginEmail, password: loginPassword },
      function (resp) {
        let data = {};
        try {
          data = JSON.parse(resp);
        } catch (e) {}

        if (data.success) {
          guardarSesion({
            id: data.id,
            nombre: data.nombre,
            correo: data.correo,
            rol_id: data.rol_id,
          });

          // Mostrar mensaje de registro si existe flag
          if (localStorage.getItem("registroExitoso")) {
            mostrarToast(
              "¡Registrado correctamente! Ahora inicia sesión.",
              "success"
            );
            localStorage.removeItem("registroExitoso");
          } else {
            mostrarToast("Inicio de sesión exitoso", "success");
          }

          // Cerrar modal login correctamente
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
      }
    );
  });
}

// ========== Registro ==========

$("#registerForm").submit(function (e) {
  e.preventDefault();
  const nombre = $("#registerName").val().trim();
  const correo = $("#registerEmail").val().trim();
  const password = $("#registerPassword").val().trim();
  const password2 = $("#registerPassword2").val().trim();

  if (password !== password2) {
    mostrarToast("Las contraseñas no coinciden", "warning");
    return;
  }

  $.post("api/register.php", { nombre, correo, password }, function (resp) {
    let data = {};
    try {
      data = JSON.parse(resp);
    } catch (e) {}

    if (data.success) {
      mostrarToast(
        "¡Registrado correctamente! Ahora inicia sesión.",
        "success"
      );
      $("#registerForm")[0].reset();
      const registerModalEl = document.getElementById("registerModal");
      const registerModal =
        bootstrap.Modal.getInstance(registerModalEl) ||
        new bootstrap.Modal(registerModalEl);
      registerModal.hide();

      // Abrir modal login
      const loginModalEl = document.getElementById("loginModal");
      const loginModal =
        bootstrap.Modal.getInstance(loginModalEl) ||
        new bootstrap.Modal(loginModalEl);
      loginModal.show();
    } else {
      mostrarToast(data.msg || "Error al registrar", "danger");
    }
  });
});
