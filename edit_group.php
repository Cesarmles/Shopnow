<?php
$page_title = 'Editar Grupo'; // Título de la página
require_once('includes/load.php'); // Cargar archivo de configuración y funciones

// Verificar el nivel de permisos del usuario para ver esta página
page_require_level(1);

// Obtener el grupo específico por ID
$e_group = find_by_id('user_groups', (int)$_GET['id']);
if (!$e_group) {
    $session->msg("d", "Missing Group id."); // Mensaje de error si no se encuentra el grupo
    redirect('group.php'); // Redirigir a la lista de grupos
}

// Procesar la actualización del grupo
if (isset($_POST['update'])) {
    $req_fields = array('group-name', 'group-level'); // Campos requeridos
    validate_fields($req_fields); // Validar campos

    if (empty($errors)) { // Si no hay errores de validación
        $name = remove_junk($db->escape($_POST['group-name'])); // Escapar y limpiar nombre del grupo
        $level = remove_junk($db->escape($_POST['group-level'])); // Escapar y limpiar nivel del grupo
        $status = remove_junk($db->escape($_POST['status'])); // Escapar y limpiar estado del grupo

        // Consulta SQL para actualizar el grupo
        $query = "UPDATE user_groups SET ";
        $query .= "group_name='{$name}', group_level='{$level}', group_status='{$status}' ";
        $query .= "WHERE ID='{$db->escape($e_group['id'])}'";
        $result = $db->query($query); // Ejecutar consulta

        if ($result && $db->affected_rows() === 1) { // Verificar si la actualización fue exitosa
            $session->msg('s', "Grupo se ha actualizado! "); // Mensaje de éxito
            redirect('edit_group.php?id=' . (int)$e_group['id'], false); // Redirigir a la página de edición
        } else {
            $session->msg('d', 'Lamentablemente no se ha actualizado el grupo!'); // Mensaje de error
            redirect('edit_group.php?id=' . (int)$e_group['id'], false); // Redirigir a la página de edición
        }
    } else {
        $session->msg("d", $errors); // Mostrar errores de validación
        redirect('edit_group.php?id=' . (int)$e_group['id'], false); // Redirigir a la página de edición
    }
}
?>

<?php include_once('layouts/header.php'); // Incluir encabezado ?>

<div class="login-page">
    <div class="text-center">
        <h3>Editar Grupo</h3> <!-- Título del formulario -->
    </div>
    <?php echo display_msg($msg); // Mostrar mensajes ?>
    <!-- Formulario para editar el grupo -->
    <form method="post" action="edit_group.php?id=<?php echo (int)$e_group['id']; ?>" class="clearfix">
        <div class="form-group">
            <label for="name" class="control-label">Nombre del grupo</label>
            <input type="text" class="form-control" name="group-name" value="<?php echo remove_junk(ucwords($e_group['group_name'])); ?>">
        </div>
        <div class="form-group">
            <label for="level" class="control-label">Nivel del grupo</label>
            <input type="number" class="form-control" name="group-level" value="<?php echo (int)$e_group['group_level']; ?>">
        </div>
        <div class="form-group">
            <label for="status">Estado</label>
            <select class="form-control" name="status">
                <option <?php if ($e_group['group_status'] === '1') echo 'selected="selected"'; ?> value="1">Activo</option>
                <option <?php if ($e_group['group_status'] === '0') echo 'selected="selected"'; ?> value="0">Inactivo</option>
            </select>
        </div>
        <div class="form-group clearfix">
            <button type="submit" name="update" class="btn btn-info">Actualizar</button> <!-- Botón para actualizar el grupo -->
        </div>
    </form>
</div>

<?php include_once('layouts/footer.php'); // Incluir pie de página ?>
