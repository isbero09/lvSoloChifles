//PAGINACION USUARIOS
window.addEventListener('DOMContentLoaded', event => {
    const usuariosTable = document.getElementById('usuariosTable');
    if (usuariosTable) {
        new simpleDatatables.DataTable(usuariosTable, {
            labels: {
                placeholder: "Buscar...", // Placeholder para el campo de búsqueda
                perPage: "Registros por página", // Opciones por página
                noRows: "No se encontraron registros", // Mensaje cuando no hay registros
                info: "Mostrando registros del {start} al {end} de un total de {rows}", // Información general
            },
            firstLast: true, // Habilita botones "Primero" y "Último" en la paginación
            perPageSelect: [5, 10, 25, 50, 100], // Opciones del selector de cantidad por página
        });
    }
});

//PAGINACION ROLES
window.addEventListener('DOMContentLoaded', event => {
    const usuariosTable = document.getElementById('rolesTable');
    if (usuariosTable) {
        new simpleDatatables.DataTable(usuariosTable, {
            labels: {
                placeholder: "Buscar...", // Placeholder para el campo de búsqueda
                perPage: "Registros por página", // Opciones por página
                noRows: "No se encontraron registros", // Mensaje cuando no hay registros
                info: "Mostrando registros del {start} al {end} de un total de {rows}", // Información general
            },
            firstLast: true, // Habilita botones "Primero" y "Último" en la paginación
            perPageSelect: [5, 10, 25, 50, 100], // Opciones del selector de cantidad por página
        });
    }
});

//PAGINACION PERMISOS
window.addEventListener('DOMContentLoaded', event => {
    const usuariosTable = document.getElementById('permisosTable');
    if (usuariosTable) {
        new simpleDatatables.DataTable(usuariosTable, {
            labels: {
                placeholder: "Buscar...", // Placeholder para el campo de búsqueda
                perPage: "Registros por página", // Opciones por página
                noRows: "No se encontraron registros", // Mensaje cuando no hay registros
                info: "Mostrando registros del {start} al {end} de un total de {rows}", // Información general
            },
            firstLast: true, // Habilita botones "Primero" y "Último" en la paginación
            perPageSelect: [5, 10, 25, 50, 100], // Opciones del selector de cantidad por página
        });
    }
});

//PAGINACION COMPRAS
window.addEventListener('DOMContentLoaded', event => {
    const usuariosTable = document.getElementById('comprasTable');
    if (usuariosTable) {
        new simpleDatatables.DataTable(usuariosTable, {
            labels: {
                placeholder: "Buscar...", // Placeholder para el campo de búsqueda
                perPage: "Registros por página", // Opciones por página
                noRows: "No se encontraron registros", // Mensaje cuando no hay registros
                info: "Mostrando registros del {start} al {end} de un total de {rows}", // Información general
            },
            firstLast: true, // Habilita botones "Primero" y "Último" en la paginación
            perPageSelect: [5, 10, 25, 50, 100], // Opciones del selector de cantidad por página
        });
    }
});

//PAGINACION PRODUCCION
window.addEventListener('DOMContentLoaded', event => {
    const usuariosTable = document.getElementById('proccTable');
    if (usuariosTable) {
        new simpleDatatables.DataTable(usuariosTable, {
            labels: {
                placeholder: "Buscar...", // Placeholder para el campo de búsqueda
                perPage: "Registros por página", // Opciones por página
                noRows: "No se encontraron registros", // Mensaje cuando no hay registros
                info: "Mostrando registros del {start} al {end} de un total de {rows}", // Información general
            },
            firstLast: true, // Habilita botones "Primero" y "Último" en la paginación
            perPageSelect: [5, 10, 25, 50, 100], // Opciones del selector de cantidad por página
        });
    }
});

//PAGINACION PRODUCTOS
window.addEventListener('DOMContentLoaded', event => {
    const usuariosTable = document.getElementById('prodTable');
    if (usuariosTable) {
        new simpleDatatables.DataTable(usuariosTable, {
            labels: {
                placeholder: "Buscar...", // Placeholder para el campo de búsqueda
                perPage: "Registros por página", // Opciones por página
                noRows: "No se encontraron registros", // Mensaje cuando no hay registros
                info: "Mostrando registros del {start} al {end} de un total de {rows}", // Información general
            },
            firstLast: true, // Habilita botones "Primero" y "Último" en la paginación
            perPageSelect: [5, 10, 25, 50, 100], // Opciones del selector de cantidad por página
        });
    }
});

//PAGINACION VENTAS
window.addEventListener('DOMContentLoaded', event => {
    const usuariosTable = document.getElementById('ventasTable');
    if (usuariosTable) {
        new simpleDatatables.DataTable(usuariosTable, {
            labels: {
                placeholder: "Buscar...", // Placeholder para el campo de búsqueda
                perPage: "Registros por página", // Opciones por página
                noRows: "No se encontraron registros", // Mensaje cuando no hay registros
                info: "Mostrando registros del {start} al {end} de un total de {rows}", // Información general
            },
            firstLast: true, // Habilita botones "Primero" y "Último" en la paginación
            perPageSelect: [5, 10, 25, 50, 100], // Opciones del selector de cantidad por página
        });
    }
});

//PAGINACION VENTAS-PRODUCTO
window.addEventListener('DOMContentLoaded', event => {
    const usuariosTable = document.getElementById('venproTable');
    if (usuariosTable) {
        new simpleDatatables.DataTable(usuariosTable, {
            labels: {
                placeholder: "Buscar...", // Placeholder para el campo de búsqueda
                perPage: "Registros por página", // Opciones por página
                noRows: "No se encontraron registros", // Mensaje cuando no hay registros
                info: "Mostrando registros del {start} al {end} de un total de {rows}", // Información general
            },
            firstLast: true, // Habilita botones "Primero" y "Último" en la paginación
            perPageSelect: [5, 10, 25, 50, 100], // Opciones del selector de cantidad por página
        });
    }
});