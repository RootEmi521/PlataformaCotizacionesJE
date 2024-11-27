<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios</title>
    <link rel="stylesheet" href="css/ventanacotizacion.css">
    <link rel="stylesheet" href="css/adminusuario.css">
    <link rel="stylesheet" href="css/nav.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <!-- Incluir DataTables CSS con soporte para Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    
    <link rel="shortcut icon" href="img/logox.ico" type="x-icon">
    <link rel="preload" href="img/fondoN.jpg" as="image">
</head>
<body>

<?php include 'includes/nav.php'; ?>

<div class="boton"><button type="button" class="btn btn-success" id="openModal">Crear Usuario</button></div>

<?php
// Incluir la clase ConsultaUsuarios
require_once "php/consultausuarios.php"; 

// Crear una instancia de la clase ConsultaUsuarios
$consultaUsuarios = new ConsultaUsuarios();

// Llamar a la función para obtener los datos de usuarios
$usuarios = $consultaUsuarios->obtenerUsuarios();
?>



<?php
// Incluir la clase ConsultaUsuarios
require_once "php/consultausuarios.php"; 

// Crear una instancia de la clase ConsultaUsuarios
$consultaUsuarios = new ConsultaUsuarios();

// Llamar a la función para obtener los datos de usuarios
$usuarios = $consultaUsuarios->obtenerUsuarios();
?>
<!-- Modal de Crear Usuario -->
<div id="myModal" class="modal">
    <?php include 'logic_de_usuarios/crearusuario.php'; ?>
</div>

<!-- Modal de Actualizar Usuario -->
<div id="myModala" class="modal">
    <?php include 'logic_de_usuarios/actualizar.php'; ?>
</div>

<div class="container container-sm contenedor w-auto">
    <img src="img/logojeser.png" alt="Logo" class="img-fluid w-auto">
</div>

<div class="container c a container-sm">
    <table id="usuariosTable" class="table table-sm ttable">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido Paterno</th>
                <th scope="col">Apellido Materno</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Usuario</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Permiso</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Verificar si $usuarios es contable antes de contar
            if (is_countable($usuarios) && count($usuarios) > 0) {
                foreach ($usuarios as $usuario) {
                    // Obtener los valores de cada usuario
                    $id = htmlspecialchars($usuario['id']);
                    $nombre = htmlspecialchars($usuario['nombre']);
                    $apellido_paterno = htmlspecialchars($usuario['apellido_paterno']);
                    $apellido_materno = htmlspecialchars($usuario['apellido_materno']);
                    $telefono = htmlspecialchars($usuario['telefono']);
                    $usuario_nombre = htmlspecialchars($usuario['nombre_usuario']);
                    $contrasena = htmlspecialchars($usuario['contrasena']);
                    $tipo_usuario = htmlspecialchars($usuario['tipo_usuario']);

                    echo "<tr>";
                    echo "<th scope='row'>{$id}</th>";
                    echo "<td>{$nombre}</td>";
                    echo "<td>{$apellido_paterno}</td>";
                    echo "<td>{$apellido_materno}</td>";
                    echo "<td>{$telefono}</td>";
                    echo "<td>{$usuario_nombre}</td>";
                    echo "<td>{$contrasena}</td>";
                    echo "<td>{$tipo_usuario}</td>";
                    // Aquí agregamos los botones de acción
                    echo "<td>
                            <button type='button' class='btn btn-warning btn-sm' id='openModala{$id}'>Actualizar</button>
                            <button class='btn btn-danger btn-sm' onclick='confirmDelete({$id})'>Eliminar</button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No hay registros disponibles.</td></tr>";
            }

            // Cerrar la conexión
            $consultaUsuarios->close();
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

<!-- Incluir Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        // Inicializar DataTables en la tabla de usuarios
        $('#usuariosTable').DataTable({
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

    // Función para confirmar la eliminación de un usuario
    function confirmDelete(usuarioId) {
        if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
            window.location.href = "logic_de_usuarios/eliminar_usuario.php?id=" + usuarioId;
            alert("¡Usuario eliminado con éxito!");
        }
        
    }
   
    document.querySelectorAll('.btn-warning').forEach(button => {
    button.addEventListener('click', function () {
        const row = this.closest('tr');
        const cells = row.children;

        // Asegurarse de que los IDs coincidan con el formulario
        document.getElementById('user_id').value = cells[0].innerText;
        document.getElementById('NOMBRE').value = cells[1].innerText;
        document.getElementById('APATERN').value = cells[2].innerText;
        document.getElementById('AMATERN').value = cells[3].innerText;
        document.getElementById('telefono').value = cells[4].innerText;
        document.getElementById('USUARIO').value = cells[5].innerText;

        // Mostrar el modal
        document.getElementById('myModala').style.display = 'block';
    });
});
</script>

</body>
</html>