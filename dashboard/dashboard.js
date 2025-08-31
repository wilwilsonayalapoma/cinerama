// JS para funcionalidades futuras del dashboard
console.log("Dashboard cargado");

document.addEventListener("DOMContentLoaded", function () {
  function getElement(id) {
    return document.getElementById(id);
  }
  const sidebar = getElement("sidebarMenu");
  const toggleBtn = getElement("toggleSidebar");
  const closeBtn = getElement("closeSidebar");
  const showSidebarBtn = getElement("showSidebar");

  function updateSidebarVisibility() {
    if (sidebar && showSidebarBtn) {
      if (sidebar.classList.contains("hide")) {
        showSidebarBtn.style.display = "block";
      } else {
        showSidebarBtn.style.display = "none";
      }
    }
  }

  if (toggleBtn && sidebar) {
    toggleBtn.addEventListener("click", function () {
      sidebar.classList.add("hide");
      updateSidebarVisibility();
    });
  }
  if (closeBtn && sidebar) {
    closeBtn.addEventListener("click", function () {
      sidebar.classList.add("hide");
      updateSidebarVisibility();
    });
  }
  if (showSidebarBtn && sidebar) {
    showSidebarBtn.addEventListener("click", function () {
      sidebar.classList.remove("hide");
      updateSidebarVisibility();
    });
  }
  updateSidebarVisibility();

  // --- Funcionalidad de edición de usuario ---
  document.querySelectorAll(".btnEditarUsuario").forEach(function (btn) {
    btn.addEventListener("click", function () {
      document.getElementById("edit_id").value = btn.getAttribute("data-id");
      document.getElementById("nombre").value = btn.getAttribute("data-nombre");
      document.getElementById("correo").value = btn.getAttribute("data-correo");
      // Seleccionar el rol
      let rol = btn.getAttribute("data-rol");
      let rolSelect = document.getElementById("rol");
      for (let i = 0; i < rolSelect.options.length; i++) {
        if (rolSelect.options[i].text === rol) {
          rolSelect.selectedIndex = i;
          break;
        }
      }
      document.getElementById("btnRegistrar").classList.add("d-none");
      document.getElementById("btnEditar").classList.remove("d-none");
    });
  });

  // --- Registro de usuario por AJAX ---
  document
    .getElementById("formUsuario")
    .addEventListener("submit", function (e) {
      e.preventDefault();
      let form = e.target;
      let formData = new FormData(form);
      fetch("usuarios.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.text())
        .then((html) => {
          // Extraer solo la tabla de usuarios del HTML recibido
          let parser = new DOMParser();
          let doc = parser.parseFromString(html, "text/html");
          let nuevaTabla = doc.querySelector(".table-responsive");
          if (nuevaTabla) {
            document.querySelector(".table-responsive").innerHTML =
              nuevaTabla.innerHTML;
          }
          // Mostrar mensaje de éxito si existe
          let alert = doc.querySelector(".alert-success, .alert-danger");
          if (alert) {
            let container = document.createElement("div");
            container.innerHTML = alert.outerHTML;
            document.querySelector("#formUsuario").before(container);
          }
          // Limpiar formulario si fue registro
          if (!form.edit_id.value) {
            form.reset();
          }
        });
    });

  // --- Modal de permisos ---
  document.querySelectorAll(".btnPermisos").forEach(function (btn) {
    btn.addEventListener("click", function () {
      let userId = btn.getAttribute("data-id");
      fetch("obtener_permisos.php?usuario_id=" + userId)
        .then((response) => response.json())
        .then((data) => {
          let menus = [
            { id: 1, nombre: "Dashboard", icono: "fa-home" },
            { id: 2, nombre: "Usuarios", icono: "fa-users" },
            { id: 3, nombre: "Noticias", icono: "fa-newspaper" },
            { id: 4, nombre: "Suscripciones", icono: "fa-envelope" },
            { id: 5, nombre: "Publicidad", icono: "fa-bullhorn" },
            { id: 6, nombre: "Categorías", icono: "fa-list" },
            { id: 7, nombre: "Strimer", icono: "fa-video" },
            { id: 8, nombre: "Comentarios", icono: "fa-comments" },
            { id: 9, nombre: "Estadísticas", icono: "fa-chart-bar" },
          ];
          let html = '<form id="formPermisos">';
          menus.forEach(function (menu) {
            let checked = data.menus_asignados.includes(menu.id.toString())
              ? "checked"
              : "";
            html += '<div class="form-check mb-2">';
            html +=
              '<input class="form-check-input" type="checkbox" value="' +
              menu.id +
              '" id="perm_' +
              menu.id +
              '" ' +
              checked +
              ">";
            html +=
              '<label class="form-check-label" for="perm_' + menu.id + '">';
            html += '<i class="fas ' + menu.icono + '"></i> ' + menu.nombre;
            html += "</label></div>";
          });
          html +=
            '<input type="hidden" id="usuarioPermisoId" value="' +
            userId +
            '">';
          html += "</form>";
          document.getElementById("modalPermisosBody").innerHTML = html;
          let modal = new bootstrap.Modal(
            document.getElementById("modalPermisos")
          );
          modal.show();
        });
    });
  });

  // Botón para guardar permisos (solo ejemplo)
  let guardarPermisos = document.getElementById("guardarPermisos");
  if (guardarPermisos) {
    guardarPermisos.addEventListener("click", function () {
      let form = document.getElementById("formPermisos");
      let usuario_id = document.getElementById("usuarioPermisoId").value;
      let menus = [];
      form
        .querySelectorAll('input[type="checkbox"]:checked')
        .forEach(function (chk) {
          menus.push(chk.value);
        });
      // AJAX para guardar permisos
      fetch("guardar_permisos.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body:
          "usuario_id=" + usuario_id + "&menus[]=" + menus.join("&menus[]="),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            alert("Permisos guardados correctamente");
            let modal = bootstrap.Modal.getInstance(
              document.getElementById("modalPermisos")
            );
            modal.hide();
          } else {
            alert("Error al guardar permisos");
          }
        });
    });
  }
});
