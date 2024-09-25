<?php
$page_title = 'Editar Cuenta';
require_once('includes/load.php'); // Cargar archivo de configuración y funciones

// Verificar el nivel de permisos del usuario para acceder a esta página
page_require_level(3);

// Procesar la carga de una nueva imagen de perfil
if (isset($_POST['submit'])) {
    $photo = new Media(); // Crear instancia de la clase Media
    $user_id = (int)$_POST['user_id']; // Obtener ID del usuario desde el formulario

    // Subir el archivo de imagen
    $photo->upload($_FILES['file_upload']); 

    if ($photo->process_user($user_id)) { // Procesar la imagen para el usuario
        $session->msg('s', 'La foto fue subida al servidor.'); // Mensaje de éxito
        redirect('edit_account.php'); // Redirigir a la misma página
    } else {
        $session->msg('d', join($photo->errors)); // Mostrar errores de carga
        redirect('edit_account.php'); // Redirigir a la misma página
    }
}

// Procesar la actualización de la información del usuario
if (isset($_POST['update'])) {
    $req_fields = array('name', 'username'); // Campos requeridos
    validate_fields($req_fields); // Validar campos del formulario

    if (empty($errors)) { // Si no hay errores de validación
        $id = (int)$_SESSION['user_id']; // Obtener ID del usuario desde la sesión
        $name = remove_junk($db->escape($_POST['name'])); // Limpiar y escapar nombre
        $username = remove_junk($db->escape($_POST['username'])); // Limpiar y escapar nombre de usuario

        $sql = "UPDATE users SET name ='{$name}', username ='{$username}' WHERE id='{$id}'"; // Consulta SQL para actualizar información
        $result = $db->query($sql); // Ejecutar consulta

        if ($result && $db->affected_rows() === 1) { // Verificar si la actualización fue exitosa
            $session->msg('s', 'Cuenta actualizada con éxito.'); // Mensaje de éxito
            redirect('edit_account.php', false); // Redirigir a la misma página
        } else {
            $session->msg('d', 'Lo siento, la actualización falló.'); // Mensaje de error
            redirect('edit_account.php', false); // Redirigir a la misma página
        }
    } else {
        $session->msg('d', $errors); // Mostrar errores de validación
        redirect('edit_account.php', false); // Redirigir a la misma página
    }
}
?>

<?php include_once('layouts/header.php'); // Incluir encabezado ?>

<div class="row">
    <!-- Mensajes de estado -->
    <div class="col-md-12">
        <?php echo display_msg($msg); ?>
    </div>
    
    <!-- Panel para cambiar la foto de perfil -->
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-heading clearfix">
                    <span class="glyphicon glyphicon-camera"></span>
                    <span>Cambiar mi foto</span>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Mostrar imagen actual del usuario -->
                        <img class="img-circle img-size-2" src="uploads/users/<?php echo $user['image']; ?>" alt="Foto de perfil">
                    </div>
                    <div class="col-md-8">
                        <!-- Formulario para cambiar la foto de perfil -->
                        <form class="form" action="edit_account.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="file" name="file_upload" class="btn btn-default btn-file"/>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>"> <!-- ID del usuario -->
                                <button type="submit" name="submit" class="btn btn-warning">Cambiar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Panel para editar la información del usuario -->
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <span class="glyphicon glyphicon-edit"></span>
                <span>Editar mi cuenta</span>
            </div>
            <div class="panel-body">
                <!-- Formulario para editar la información del usuario -->
                <form method="post" action="edit_account.php" class="clearfix">
                    <div class="form-group">
                        <label for="name" class="control-label">Nombres</label>
                        <input type="text" class="form-control" name="name" value="<?php echo remove_junk(ucwords($user['name'])); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="username" class="control-label">Usuario</label>
                        <input type="text" class="form-control" name="username" value="<?php echo remove_junk(ucwords($user['username'])); ?>" required>
                    </div>
                    <div class="form-group clearfix">
                        <a href="change_password.php" title="Cambiar contraseña" class="btn btn-danger pull-right">Cambiar contraseña</a> <!-- Enlace para cambiar la contraseña -->
                        <button type="submit" name="update" class="btn btn-info">Actualizar</button> <!-- Botón para actualizar la información -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once('layouts/footer.php'); // Incluir pie de página ?>
