<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php"); // Redirigir a la página de login si no está autenticado
    exit();
}

require_once 'php/consultacotizaciones.php';
// Crear una instancia de la clase ConsultaCotizaciones
$consultaCotizaciones = new ConsultaCotizaciones();

// Llamar a la función para obtener los datos de cotizaciones
$cotizaciones = $consultaCotizaciones->obtenerCotizaciones();
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

<?php require_once 'includes/nav.php'; ?>
<div class="boton"><button type="button" class="btn btn-success" id="openModal">Generar nueva cotizacion</button></div>
<div id="myModal" class="modal window">
   <?php include 'logic_de_cotizaciones/crearcotizacion.php'; ?>
</div>

<div class="container container-sm contenedor w-auto">
    <img src="img/logojeser.png" alt="Logo" class="img-fluid w-auto">
</div>

<div class="container c a container-sm">
    <table id="cotizacionesTable" class="table ttable table-sm">
        <thead>
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Folio</th>
                <th scope="col">Cliente</th>
                <th scope="col">Usuario</th>
                <th scope="col">Estatus</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($cotizaciones as $cotizacion): ?>
            <tr>
                <td><?php echo htmlspecialchars($cotizacion['fecha_subida']); ?></td>
                <td><?php echo htmlspecialchars($cotizacion['folio']); ?></td>
                <td>
                    <?php 
                    $clienteNombre = $consultaCotizaciones->obtenerNombreCliente($cotizacion['cliente_id']); 
                    echo htmlspecialchars($clienteNombre); 
                    ?>
                </td>
                <td>
                    <?php 
                    $usuarioNombre = $consultaCotizaciones->obtenerNombreUsuario($cotizacion['usuario_id']); 
                    echo htmlspecialchars($usuarioNombre); 
                    ?>
                </td>
                <td>
                    <?php 
                    $estatus = $consultaCotizaciones->obtenerEstatusCotizacion($cotizacion['folio']); 
                    echo htmlspecialchars($estatus); 
                    ?>
                </td>
                <td>
                    <a href="<?php echo 'uploads/' . htmlspecialchars($cotizacion['archivo_pdf']); ?>" target="_blank">Previsualizar</a>
                    <form method="POST" action="logic_de_envio/envio_cotizacion.php" style="display:inline;">
                        <input type="hidden" name="cliente_id" value="<?php echo htmlspecialchars($cotizacion['cliente_id']); ?>">
                        <input type="hidden" name="folio" value="<?php echo htmlspecialchars($cotizacion['folio']); ?>">
                        <button type="submit" class="btn btn-primary btn-sm">Enviar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
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

</body>
</html>
