<tbody>
    <?php foreach ($cotizaciones as $cotizacion): ?>
        <tr>
            <td><?php echo htmlspecialchars($cotizacion['fecha_subida']); ?></td>
            <td><?php echo htmlspecialchars($cotizacion['folio']); ?></td>
            <td><?php echo htmlspecialchars($cotizacion['cliente_id']); ?></td> <!-- Aquí debes obtener el nombre del cliente usando su ID -->
            <td><?php echo htmlspecialchars($cotizacion['usuario_id']); ?></td> <!-- Aquí debes obtener el nombre del usuario usando su ID -->
            <td>
                <?php 
                $archivoPath = 'uploads/' . htmlspecialchars($cotizacion['archivo_pdf']);
                if (file_exists($archivoPath)): ?>
                    <a href="<?php echo $archivoPath; ?>" target="_blank">
                        <img src="img/ver.png" alt="ver pdf" class='accion'>
                    </a>
                    <a href="<?php echo $archivoPath; ?>" download>
                        <img src="img/descarga.png" class='accion' alt="descargar pdf">
                    </a>
                <?php else: ?>
                    <span>Archivo no disponible</span>
                <?php endif; ?>
            </td>
            <td>Enviado o no enviado</td> <!-- Puedes modificar esto según tu lógica -->
        </tr>
    <?php endforeach; ?>
</tbody>