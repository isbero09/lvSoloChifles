<?php
session_start();

//Inicializar la sesión
if (!isset($_SESSION['ventaproductos'])){
    $_SESSION['ventaproductos'] = [];
}

//Funcion para agregar
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $ventaproducto = [
        'id' => $_POST['id'],
        'cliente' => $_POST['cliente'],
        'producto' => $_POST['producto'],
        'detalle' => $_POST['detalle'],
        'precio' => $_POST['precio'],
        'fecha' => $_POST['fecha'],
    ];

    $_SESSION['ventaproductos'][] = $ventaproducto;

    header("Location: venta-productos.php");
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
                    <h1 class="mt-4">LISTADO DE VENTAS-PRODUCTOS</h1>
                    <div class="card mb-4">
                        <div class="card-body">
                            <a class="btn btn-success btn-icon-split" id="aggVenpro">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Agregar Venta-Producto</span>
                            </a>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                        </div>
                        <div class="card-body">
                            <table class="table" id="venproTable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Cliente</th>
                                        <th>Producto</th>
                                        <th>Detalle</th>
                                        <th>Precio Total</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="venproBody">
                                    <tr>
                                        <td>1</td>
                                        <td>Lisseth Mocha</td>
                                        <td>Maduritos</td>
                                        <td>50 fundas de 80g</td>
                                        <td>137.50</td>
                                        <td>2025-01-05</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-success btn-editVenpro">
                                                    <i class="fa-solid fa-pen"></i></button>

                                                <button class="btn btn-danger btn-deleteVenpro">
                                                    <i class="fa-solid fa-trash "></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Rebecca Sepeda</td>
                                        <td>Maduritos</td>
                                        <td>100 fundas de 80g</td>
                                        <td>75.00</td>
                                        <td>2024-08-27</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-success btn-editVenpro">
                                                    <i class="fa-solid fa-pen"></i></button>

                                                <button class="btn btn-danger btn-deleteVenpro">
                                                    <i class="fa-solid fa-trash "></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Milena Ochoa</td>
                                        <td>Chifles</td>
                                        <td>500 fundas de 80g</td>
                                        <td>375.00</td>
                                        <td>2023-07-09</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-success btn-editVenpro">
                                                    <i class="fa-solid fa-pen"></i></button>

                                                <button class="btn btn-danger btn-deleteVenpro">
                                                    <i class="fa-solid fa-trash "></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Monzerrat Morocho</td>
                                        <td>Chifles</td>
                                        <td>245 fundas de 80g</td>
                                        <td>183.75</td>
                                        <td>2021-06-28</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-success btn-editVenpro">
                                                    <i class="fa-solid fa-pen"></i></button>

                                                <button class="btn btn-danger btn-deleteVenpro">
                                                    <i class="fa-solid fa-trash "></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Dennisse Valencia</td>
                                        <td>Chifles</td>
                                        <td>12 fundas de 80g</td>
                                        <td>9.00</td>
                                        <td>2024-03-27</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-success btn-editVenpro">
                                                    <i class="fa-solid fa-pen"></i></button>

                                                <button class="btn btn-danger btn-deleteVenpro">
                                                    <i class="fa-solid fa-trash "></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Carolina Condoy</td>
                                        <td>Chifles</td>
                                        <td>8 fundas de 80g</td>
                                        <td>16.00</td>
                                        <td>2022-12-22</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-success btn-editVenpro">
                                                    <i class="fa-solid fa-pen"></i></button>

                                                <button class="btn btn-danger btn-deleteVenpro">
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
            <!-- Modal de Ventas-Produtos -->
            <div class="modal fade" id="editModalVenpro" tabindex="-1" aria-labelledby="editModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalVenproLabel">Editar Compra</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-bodyRol">
                            <!-- Formulario de edición -->
                            <form id="editFormVenpro" style="padding: 15px;">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="clienteVenpro" class="form-label">Cliente</label>
                                        <input type="text" class="form-control" id="clienteVenpro" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="selecVenpro" class="form-label">Producto:</label>
                                        <select class="form-select" id="selecVenpro" required>
                                            <option value="Chifle">Chifle</option>
                                            <option value="Maduritos">Maduritos</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="descripcionVenpro" class="form-label">Descripcion:</label>
                                        <input type="text" class="form-control" id="descripcionVenpro" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="precioVenpro" class="form-label">Precio Total:</label>
                                        <input type="text" class="form-control" id="precioVenpro" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="dateVenpro" class="form-label">Fecha:</label>
                                        <input type="date" class="form-control" id="dateVenpro" required>
                                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Referencias a elementos clave
            const aggVenproBtn = document.getElementById("aggVenpro");
            const venproTableBody = document.getElementById("venproBody");
            const editModalVenpro = new bootstrap.Modal(document.getElementById("editModalVenpro"));
            const saveChangesBtn = document.getElementById("saveChanges");
            const editFormVenpro = document.getElementById("editFormVenpro");
    
            let editRow = null; // Fila actualmente en edición
    
            // Evento para abrir el modal de agregar nueva venta-producto
            aggVenproBtn.addEventListener("click", () => {
                editRow = null; // Reseteamos la fila en edición
                editFormVenpro.reset(); // Limpiar el formulario
                document.getElementById("editModalVenproLabel").textContent = "Agregar Venta-Producto";
                editModalVenpro.show();
            });
    
            // Guardar cambios (Agregar o Editar venta-producto)
            saveChangesBtn.addEventListener("click", () => {
                const cliente = document.getElementById("clienteVenpro").value.trim();
                const producto = document.getElementById("selecVenpro").value;
                const descripcion = document.getElementById("descripcionVenpro").value.trim();
                const precio = document.getElementById("precioVenpro").value.trim();
                const fecha = document.getElementById("dateVenpro").value;
    
                // Validación de campos
                if (!cliente || !producto || !descripcion || !precio || !fecha) {
                    alert("Todos los campos son obligatorios.");
                    return;
                }
    
                if (editRow) {
                    // Editar venta-producto existente
                    editRow.cells[1].textContent = cliente;
                    editRow.cells[2].textContent = producto;
                    editRow.cells[3].textContent = descripcion;
                    editRow.cells[4].textContent = precio;
                    editRow.cells[5].textContent = fecha;
                } else {
                    // Agregar nueva venta-producto
                    const newRow = document.createElement("tr");
                    newRow.innerHTML = `
                        <td>${venproTableBody.rows.length + 1}</td>
                        <td>${cliente}</td>
                        <td>${producto}</td>
                        <td>${descripcion}</td>
                        <td>${precio}</td>
                        <td>${fecha}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-success btn-editVenpro"><i class="fa-solid fa-pen"></i></button>
                                <button class="btn btn-danger btn-deleteVenpro"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    `;
                    venproTableBody.appendChild(newRow);
                }
    
                editModalVenpro.hide();
                editFormVenpro.reset();
            });
    
            // Delegar eventos de edición y eliminación en la tabla
            venproTableBody.addEventListener("click", (event) => {
                const target = event.target;
                const btn = target.closest("button");
    
                if (!btn) return;
    
                const row = btn.closest("tr");
    
                if (btn.classList.contains("btn-editVenpro")) {
                    // Editar venta-producto
                    editRow = row;
                    document.getElementById("clienteVenpro").value = row.cells[1].textContent.trim();
                    document.getElementById("selecVenpro").value = row.cells[2].textContent.trim();
                    document.getElementById("descripcionVenpro").value = row.cells[3].textContent.trim();
                    document.getElementById("precioVenpro").value = row.cells[4].textContent.trim();
                    document.getElementById("dateVenpro").value = row.cells[5].textContent.trim();
    
                    document.getElementById("editModalVenproLabel").textContent = "Editar Venta-Producto";
                    editModalVenpro.show();
                } else if (btn.classList.contains("btn-deleteVenpro")) {
                    // Eliminar venta-producto con confirmación
                    if (confirm("¿Estás seguro de que deseas eliminar esta venta-producto?")) {
                        row.remove();
                    }
                }
            });
        });
    </script>
    

</body>

</html>