<?php
session_start();

//Inicializar la sesión
if (!isset($_SESSION['ventas'])){
    $_SESSION['ventas'] = [];
}

//Funcion para agregar
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $venta = [
        'id' => $_POST['id'],
        'cliente' => $_POST['cliente'],
        'precio' => $_POST['precio'],
        'fecha' => $_POST['fecha'],
        'pagado' => $_POST['pagado'],
    ];

    $_SESSION['ventas'][] = $venta;

    header("Location: ventas.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SOLO CHIFLES</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Paginacion -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.2.1/datatables.min.css" rel="stylesheet">
</head>


<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
            </div>
        </form>
        <!-- Navbar usuario-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="index.html">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="navbar-brand ps-3 mt-3 text-center" href="{{route('inicio')}}"><img
                                src="{{asset('img/logo transparebte.png')}}" alt="" width="80px" height="75"></a>
                        <a class="navbar-brand ps-3 mt-4 text-center" href="{{route('inicio')}}"><img
                                src="{{ asset('img/Diseño sin fondo.PNG')}}" alt="" width="165px" height="55"></a>
                        <div class="sb-sidenav-menu-heading">Principal</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Usuarios
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a>
                                <a class="nav-link" href="roles.php">Roles</a>
                                <a class="nav-link" href="{{ route('permisos.index')}}">Permisos</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdmi"
                            aria-expanded="false" aria-controls="collapseAdmi">
                            <div class="sb-nav-link-icon"><i class="fas fa-briefcase"></i></div>
                            Administración
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseAdmi" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{route('compras.index')}}">Compras</a>
                                <a class="nav-link" href="{{route('produccion.index')}}">Produccion</a>
                                <a class="nav-link" href="{{route('producto.index')}}">Productos</a>
                                <a class="nav-link" href="{{route('venta.index')}}">Ventas</a>
                                <a class="nav-link" href="{{route('ventaproducto.index')}}">Ventas-Productos</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">LISTADO DE VENTAS</h1>
                    <div class="card mb-4">
                        <div class="card-body">
                            <a class="btn btn-success btn-icon-split" id="aggventa">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Agregar Ventas</span>
                            </a>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                        </div>
                        <div class="card-body">
                            <table class="table" id="ventasTable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Cliente</th>
                                        <th>Precio</th>
                                        <th>Fecha</th>
                                        <th>Pagado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="ventasBody">
                                    <tr>
                                        <td>1</td>
                                        <td>Fernanda Gonzales</td>
                                        <td>25.55</td>
                                        <td>2025-01-12</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked-1" checked disabled>
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckChecked-1">Pagado</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-success btn-editVen">
                                                    <i class="fa-solid fa-pen"></i></button>

                                                <button class="btn btn-danger btn-deleteVen">
                                                    <i class="fa-solid fa-trash "></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Arturo Guajaca</td>
                                        <td>11.30</td>
                                        <td>2024-07-15</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked-1" checked disabled>
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckChecked-1">Pagado</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-success btn-editVen">
                                                    <i class="fa-solid fa-pen"></i></button>

                                                <button class="btn btn-danger btn-deleteVen">
                                                    <i class="fa-solid fa-trash "></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Nahomi Ramirez</td>
                                        <td>7.40</td>
                                        <td>2023-05-28</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked-1" checked disabled>
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckChecked-1">Pagado</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-success btn-editVen">
                                                    <i class="fa-solid fa-pen"></i></button>

                                                <button class="btn btn-danger btn-deleteVen">
                                                    <i class="fa-solid fa-trash "></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Cecilia Velez</td>
                                        <td>108.90</td>
                                        <td>2022-11-28</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked-1" checked disabled>
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckChecked-1">Pagado</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-success btn-editVen">
                                                    <i class="fa-solid fa-pen"></i></button>

                                                <button class="btn btn-danger btn-deleteVen">
                                                    <i class="fa-solid fa-trash "></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Fabiola Ruiz</td>
                                        <td>74.20</td>
                                        <td>2024-08-16</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked-1" checked disabled>
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckChecked-1">Pagado</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-success btn-editVen">
                                                    <i class="fa-solid fa-pen"></i></button>

                                                <button class="btn btn-danger btn-deleteVen">
                                                    <i class="fa-solid fa-trash "></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <!-- Modal de Venta -->
            <div class="modal fade" id="editModalVen" tabindex="-1" aria-labelledby="editModalVenLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalVenLabel">Editar Venta</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!--Formulario-->
                            <form id="editForm">
                                <div class="mb-3">
                                    <label for="clienteVen" class="form-label">Cliente</label>
                                    <input type="text" class="form-control" id="clienteVen" required>
                                </div>
                                <div class="mb-3">
                                    <label for="precioVen" class="form-label">Precio</label>
                                    <input type="number" class="form-control" id="precioVen" required>
                                </div>
                                <div class="mb-3">
                                    <label for="dateVen" class="form-label">Fecha de Venta</label>
                                    <input type="date" class="form-control" id="dateVen" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editEstado" class="form-label">Estado</label>
                                    <select class="form-control" id="editEstado" required>
                                        <option value="pagado">Pagado</option>
                                        <option value="deuda">Deuda</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="saveChanges">Guardar cambios</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="./js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <!-- paginacion -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.2.1/datatables.min.js"></script>

    <script>
        // Esperar a que el DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", () => {
    // Referencias a los elementos clave
    const aggVentaBtn = document.getElementById("aggventa");
    const ventasBody = document.getElementById("ventasBody");
    const editModal = new bootstrap.Modal(document.getElementById("editModalVen"));
    const saveChangesBtn = document.getElementById("saveChanges");
    const editForm = document.getElementById("editForm");

    let editRow = null; // Fila actualmente en edición

    // Evento para abrir el modal de agregar
    aggVentaBtn.addEventListener("click", () => {
        editRow = null; // Reseteamos la fila en edición
        editForm.reset(); // Limpiar formulario
        document.getElementById("editModalVenLabel").textContent = "Agregar Venta";
        editModal.show();
    });

    // Guardar cambios (Agregar o Editar)
    saveChangesBtn.addEventListener("click", () => {
        const cliente = document.getElementById("clienteVen").value;
        const precio = document.getElementById("precioVen").value;
        const fecha = document.getElementById("dateVen").value;
        const estado = document.getElementById("editEstado").value === "pagado";

        if (!cliente || !precio || !fecha) {
            alert("Todos los campos son obligatorios.");
            return;
        }

        if (editRow) {
            // Editar fila existente
            editRow.cells[1].textContent = cliente;
            editRow.cells[2].textContent = parseFloat(precio).toFixed(2);
            editRow.cells[3].textContent = fecha;
            editRow.cells[4].innerHTML = estado
                ? '<div class="form-check form-switch"><input class="form-check-input" type="checkbox" checked disabled><label class="form-check-label">Pagado</label></div>'
                : '<div class="form-check form-switch"><input class="form-check-input" type="checkbox" disabled><label class="form-check-label">Deuda</label></div>';
        } else {
            // Agregar nueva fila
            const newRow = document.createElement("tr");
            newRow.innerHTML = `
                <td>${ventasBody.rows.length + 1}</td>
                <td>${cliente}</td>
                <td>${parseFloat(precio).toFixed(2)}</td>
                <td>${fecha}</td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" ${estado ? "checked" : ""} disabled>
                        <label class="form-check-label">${estado ? "Pagado" : "Deuda"}</label>
                    </div>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <button class="btn btn-success btn-editVen"><i class="fa-solid fa-pen"></i></button>
                        <button class="btn btn-danger btn-deleteVen"><i class="fa-solid fa-trash"></i></button>
                    </div>
                </td>
            `;
            ventasBody.appendChild(newRow);
        }

        editModal.hide();
    });

    // Delegar eventos de edición y eliminación en la tabla
    ventasBody.addEventListener("click", (event) => {
        const target = event.target;
        const btn = target.closest("button");

        if (!btn) return;

        const row = btn.closest("tr");

        if (btn.classList.contains("btn-editVen")) {
            // Editar fila
            editRow = row;
            document.getElementById("clienteVen").value = row.cells[1].textContent;
            document.getElementById("precioVen").value = row.cells[2].textContent;
            document.getElementById("dateVen").value = row.cells[3].textContent;
            document.getElementById("editEstado").value = row.cells[4].textContent.trim().toLowerCase() === "pagado" ? "pagado" : "deuda";

            document.getElementById("editModalVenLabel").textContent = "Editar Venta";
            editModal.show();
        } else if (btn.classList.contains("btn-deleteVen")) {
            // Eliminar fila con confirmación
            if (confirm("¿Estás seguro de que deseas eliminar esta venta?")) {
                row.remove();
            }
        }
    });
});
    </script>
</body>

</html>