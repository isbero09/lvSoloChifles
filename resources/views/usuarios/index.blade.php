<?php

session_start();
?>

<?php
//Inicializar la sesión
if (!isset($_SESSION['usuarios'])){
    $_SESSION['usuarios'] = [];
}

//Funcion para agregar
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $_SESSION['usuarios'][] = new Usuario(
        $_POST['cedula'],
        $_POST['nombre'],
        $_POST['apellido'],
        $_POST['email'],
        $_POST['rol'],
        $_POST['telefono'],
        $_POST['estado'],
    );

    header("Location: /");
    exit;
}

//Funcion para editar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'editar') {
    foreach ($_SESSION['usuarios'] as &$usu) {
        if ($usu->cedula === $_POST['cedula']) {
            $usu->nombre = $_POST['nombre'];
            $usu->apellido = $_POST['apellido'];
            $usu->email = $_POST['email'];
            $usu->rol = $_POST['rol'];
            $usu->telefono = $_POST['telefono'];
            $usu->estado = $_POST['estado'];
            break;
        }
    }
    header("Location: usuarios.php");
    exit;
}

// Funcion eliminar usuario
if (isset($_GET['eliminar'])) {
    $cedula = $_GET['eliminar'];
    $_SESSION['usuarios'] = array_filter($_SESSION['usuarios'], function ($u) use ($cedula) {
        return $u->cedula !== $cedula;
    });
    header("Location: usuarios.php");
    exit;
}

// Determinar si se debe mostrar el modal
$mostrarModal = isset($_GET['edit']) || isset($_GET['nuevo']);
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
    <link href="./css/styles.css" rel="stylesheet" />
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
                    <h1 class="mt-4">LISTADO DE USUARIOS</h1>
                    <div class="card mb-4">
                        <div class="card-body">
                            <a class="btn btn-success btn-icon-split" id="aggusuario">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Agregar Usuario</span>
                            </a>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                        </div>
                        <div class="card-body">
                            <table class="table" id="usuariosTable">
                                <thead>
                                    <tr>
                                        <th>Cedula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Telefono</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="usuariosBody">
                                    <tr>
                                        <td>0705441187</td>
                                        <td>Wilson</td>
                                        <td>Cedillo</td>
                                        <td>Wil@gmail.com</td>
                                        <td>Administrador</td>
                                        <td>0985547159</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked-1" checked disabled>
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckChecked-1">Activo</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-success btn-editUsu">
                                                    <i class="fa-solid fa-pen"></i></button>

                                                <button class="btn btn-danger btn-delete">
                                                    <i class="fa-solid fa-trash "></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>0705669976</td>
                                        <td>Ismenia</td>
                                        <td>Mocha</td>
                                        <td>isbero@gmail.com</td>
                                        <td>Contador</td>
                                        <td>0985589666</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked-1" checked disabled>
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckChecked-1">Activo</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-success btn-editUsu">
                                                    <i class="fa-solid fa-pen"></i></button>

                                                <button class="btn btn-danger btn-delete">
                                                    <i class="fa-solid fa-trash "></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>0705447715</td>
                                        <td>Gloria</td>
                                        <td>Rivera</td>
                                        <td>jacque@gmail.com</td>
                                        <td>Cliente</td>
                                        <td>0989945753</td>
                                        <td>
                                            <div class="form-check form-switch">
                                             <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked-1" checked disabled>
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckChecked-1">Activo</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-success btn-editUsu">
                                                    <i class="fa-solid fa-pen"></i></button>

                                                <button class="btn btn-danger btn-delete">
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

            <!-- Modal de Usuario -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Formulario Usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulario de edición -->
                            <form id="editForm" method="$_POST">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="editCedula" class="form-label">Cedula:</label>
                                        <input type="text" class="form-control" id="editCedula" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="editNombre" class="form-label">Nombre:</label>
                                        <input type="text" class="form-control" id="editNombre" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="editApellido" class="form-label">Apellido:</label>
                                        <input type="text" class="form-control" id="editApellido" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="editEmail" class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="editEmail" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="editTelefono" class="form-label">Teléfono:</label>
                                        <input type="text" class="form-control" id="editTelefono" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="editEstado" class="form-label">Estado:</label>
                                        <select class="form-select" id="editEstado" required>
                                            <option value="activo">Activo</option>
                                            <option value="inactivo">Inactivo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="selecRol" class="form-label">Rol:</label>
                                    <select class="form-select" id="selecRol" required>
                                        <option value="Administrador">Administrador</option>
                                        <option value="Cliente">Cliente</option>
                                        <option value="Proveedor">Proveedor</option>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="./js/scripts.js"></script>
    <!-- paginacion -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.2.1/datatables.min.js"></script>
</body>

</html>