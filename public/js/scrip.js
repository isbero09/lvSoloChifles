//DESPLEGAR NAVBAR
window.addEventListener('DOMContentLoaded', event => {
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }
});


//USUARIOS TODO
    document.addEventListener("DOMContentLoaded", () => {
        // Referencias a los elementos clave
        const aggUsuarioBtn = document.getElementById("aggusuario");
        const usuariosBody = document.getElementById("usuariosBody");
        const editModal = new bootstrap.Modal(document.getElementById("editModal"));
        const saveChangesBtn = document.getElementById("saveChanges");
        const editForm = document.getElementById("editForm");

        let editRow = null; // Fila actualmente en edición

        // Evento para abrir el modal de agregar usuario
        aggUsuarioBtn.addEventListener("click", () => {
            editRow = null; // Reseteamos la fila en edición
            editForm.reset(); // Limpiar formulario
            document.getElementById("editModalLabel").textContent = "Agregar Usuario";
            editModal.show();
        });

        // Guardar cambios (Agregar o Editar)
        saveChangesBtn.addEventListener("click", () => {
            const cedula = document.getElementById("editCedula").value.trim();
            const nombre = document.getElementById("editNombre").value.trim();
            const apellido = document.getElementById("editApellido").value.trim();
            const email = document.getElementById("editEmail").value.trim();
            const telefono = document.getElementById("editTelefono").value.trim();
            const estado = document.getElementById("editEstado").value;

            // Validación de campos
            if (!cedula || !nombre || !apellido || !email || !telefono) {
                alert("Todos los campos son obligatorios.");
                return;
            }

            if (editRow) {
                // Editar fila existente
                editRow.cells[0].textContent = cedula;
                editRow.cells[1].textContent = nombre;
                editRow.cells[2].textContent = apellido;
                editRow.cells[3].textContent = email;
                editRow.cells[4].textContent = telefono;
                editRow.cells[5].innerHTML = `
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" ${estado === "activo" ? "checked" : ""} disabled>
                        <label class="form-check-label">${estado === "activo" ? "Activo" : "Inactivo"}</label>
                    </div>
                `;
            } else {
                // Agregar nueva fila
                const newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td>${cedula}</td>
                    <td>${nombre}</td>
                    <td>${apellido}</td>
                    <td>${email}</td>
                    <td>${telefono}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" ${estado === "activo" ? "checked" : ""} disabled>
                            <label class="form-check-label">${estado === "activo" ? "Activo" : "Inactivo"}</label>
                        </div>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <button class="btn btn-success btn-editUsu"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn btn-danger btn-delete"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
                `;
                usuariosBody.appendChild(newRow);
            }

            editModal.hide();
        });

        // Delegar eventos de edición y eliminación en la tabla
        usuariosBody.addEventListener("click", (event) => {
            const target = event.target;
            const btn = target.closest("button");

            if (!btn) return;

            const row = btn.closest("tr");

            if (btn.classList.contains("btn-editUsu")) {
                // Editar fila
                editRow = row;
                document.getElementById("editCedula").value = row.cells[0].textContent.trim();
                document.getElementById("editNombre").value = row.cells[1].textContent.trim();
                document.getElementById("editApellido").value = row.cells[2].textContent.trim();
                document.getElementById("editEmail").value = row.cells[3].textContent.trim();
                document.getElementById("editTelefono").value = row.cells[4].textContent.trim();
                document.getElementById("editEstado").value = row.cells[5].querySelector("input").checked ? "activo" : "inactivo";

                document.getElementById("editModalLabel").textContent = "Editar Usuario";
                editModal.show();
            } else if (btn.classList.contains("btn-delete")) {
                // Eliminar fila con confirmación
                if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
                    row.remove();
                }
            }
        });
    });