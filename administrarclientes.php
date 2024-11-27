<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php"); // Redirigir a la página de login si no está autenticado
    exit();
}

// Incluir la clase ConsultaClientes (conexión a la base de datos y obtención de clientes)
require_once "php/consultaclientes.php"; 

// Crear una instancia de la clase ConsultaClientes
$consultaClientes = new ConsultaClientes();

// Llamar a la función para obtener los datos de clientes
$clientes = $consultaClientes->obtenerClientes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar clientes</title>

    <!-- Incluir Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <!-- Incluir CSS de DataTables con soporte para Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    
    <link rel="stylesheet" href="css/adminclientes.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="shortcut icon" href="img/logox.ico" type="x-icon">
    <link rel="preload" href="img/fondoN.jpg" as="image">
</head>
<body>

<?php include 'includes/nav.php'; ?>

<div class="container container-sm contenedor w-auto">
    <img src="img/logojeser.png" alt="Logo" class="img-fluid w-auto">
</div>

<div class="container container-sm titulo">
    <p class="textocampos">Clientes</p>
</div>

<div class="boton"><button type="button" class="btn btn-success" id="openModal">Añadir Clientes</button></div>
<div id="myModal" class="modal">
    <?php include 'logic_de_clientes/crearcliente.php'; ?>
</div>


<!-- Modal de Actualizar Usuario -->
<div id="myModala" class="modal">
    <?php include 'logic_de_clientes/actualizar.php'; ?>
</div>

<div class="container c a container-sm w-auto">
    <table id="miTabla" class="table table-sm ttable">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre Empresa</th>
                <th scope="col">Titular</th>
                <th scope="col">Dirección</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Correo</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($clientes) > 0) {
                foreach ($clientes as $cliente) {
                    // Obtener los valores de cada cliente
                    $id = htmlspecialchars($cliente['id']);
                    $nombre_empresa = htmlspecialchars($cliente['nombre_empresa']);
                    $nombre_titular = htmlspecialchars($cliente['nombre_titular']);
                    $direccion = htmlspecialchars($cliente['direccion']);
                    $telefono = htmlspecialchars($cliente['telefono']);
                    $correo_electronico = htmlspecialchars($cliente['correo_electronico']);

                    echo "<tr>";
                    echo "<th scope='row'>{$id}</th>";
                    echo "<td>{$nombre_empresa}</td>";
                    echo "<td>{$nombre_titular}</td>";
                    echo "<td>{$direccion}</td>";
                    echo "<td>{$telefono}</td>";
                    echo "<td>{$correo_electronico}</td>";
                    // Aquí agregamos los botones de acción
                    echo "<td>
                            <button type='button' class='btn btn-warning btn-sm' id='openModala{$id}'>Actualizar</button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No hay registros disponibles.</td></tr>";
            }

            // Cerrar la conexión
            $consultaClientes->close();
            ?>
        </tbody>
    </table>
</div>

<script src="js/popup.js"></script>

<!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Incluir DataTables JS con soporte para Bootstrap 5 -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
  $(document).ready(function() {
    $('#miTabla').DataTable({
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

  document.querySelectorAll('.btn-warning').forEach(button => {
    button.addEventListener('click', function () {
        const row = this.closest('tr'); // Encuentra la fila correspondiente
        const cells = row.children; // Celdas de la fila

        // Verificar los valores de las celdas de la fila
        console.log("ID Cliente:", cells[0].innerText); // Muestra el ID de la primera celda
        console.log("Nombre Empresa:", cells[1].innerText); // Muestra el nombre de la empresa
        console.log("Nombre Titular:", cells[2].innerText); // Muestra el nombre del titular

        // Rellenar el formulario del modal con los valores de la fila
        document.getElementById('cliente_id').value = cells[0].innerText; // Asigna el ID al campo oculto
        document.getElementById('NOMBREEMP').value = cells[1].innerText; // Nombre empresa
        document.getElementById('TITULAR').value = cells[2].innerText; // Nombre titular
        document.getElementById('DIRECTOKER').value = cells[3].innerText; // Dirección
        document.getElementById('PHONE').value = cells[4].innerText; // Teléfono
        document.getElementById('MAIL').value = cells[5].innerText; // Correo

        // Mostrar el modal
        document.getElementById('myModala').style.display = 'block';
    });
});
  
</script>

<!-- Incluir Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>