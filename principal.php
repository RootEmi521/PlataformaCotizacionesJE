<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php"); // Redirigir a la página de login si no está autenticado
    exit();
}

// CONTENIDO PAG PRINCIPAL ABAJO
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Menu</title>
    <link rel="preload" href="img/fondoN.jpg" as="image">
    <link rel="stylesheet" href="css/ventanacotizacion.css">
    <link rel="stylesheet" href="css/principal.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/loaderpag.css">
    
    <!-- Incluir DataTables CSS con soporte para Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    
    <link rel="shortcut icon" href="img/logox.ico" type="x-icon">
</head>
<body>
<script src="js/load.js"></script> <!--SCRIPT DEL LOADER -->  
<div id="loading">
        <div class="loader">
            <h1>Jeser Etiquetas</h1>
        </div>
    </div>

<div id="content" style="display: none;">
<?php require_once 'includes/nav.php'; ?>
<div class="boton"><button type="button" class="btn btn-success" id="openModal">Generar nueva cotizacion</button></div>
<div id="myModal" class="modal window">
   <?php include 'logic_de_cotizaciones/crearcotizacion.php';?>
</div>



<div class="container container-sm contenedor w-auto  ">
    <img src="img/logojeser.png" alt="Logo" class="img-fluid w-auto">
</div>

<div class="container c a container-sm">
    <table id="cotizacionesTable" class="table ttable table-sm">
        <thead>
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Folio</th>
                <th scope="col">Cliente</th>
                <th scope="col">Acciones</th>
                <th scope="col">Estatus</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">11/08/2024</th>
                <td>Jeser-1234</td>
                <td>Coppel</td>
                <td>
                    <img src="img/ver.png" alt="ver pdf" class='accion'>
                    <img src="img/descarga.png" class='accion' alt="descargar pdf">
                    <img src="img/compartir.png" alt="compartir pdf" class="accion">
                </td>
                <td>Enviado o no enviado</td>
            </tr>
            <!-- Aquí puedes agregar más filas dinámicamente si es necesario -->
        </tbody>
    </table>
</div>

<script src="js/popup.js"></script>

<!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Incluir DataTables JS con soporte para Bootstrap 5 -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Incluir Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        // Inicializar DataTables en la tabla de cotizaciones
        $('#cotizacionesTable').DataTable({
            "paging": true,         // Paginación habilitada
            "searching": true,      // Búsqueda habilitada
            "ordering": true,       // Ordenación habilitada
            "lengthMenu": [5, 10, 25, 50], // Número de elementos por página
            "language": {
                "sSearch": "Buscar:",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "oPaginate": {
                    "sPrevious": "Anterior",
                    "sNext": "Siguiente"
                }
            }
        });
    });
</script>
</div>
</body>
</html>
