<?php
$page_title = 'Editar categoría'; // Título de la página
require_once('includes/load.php'); // Cargar archivo de configuración y funciones

// Verificar el nivel de permisos del usuario para ver esta página
page_require_level(1);

// Obtener la categoría específica por ID
$categorie = find_by_id('categories', (int)$_GET['id']);
if (!$categorie) {
    $session->msg("d", "Missing categorie id."); // Mensaje de error si no se encuentra la categoría
    redirect('categorie.php'); // Redirigir a la lista de categorías
}
?>

<?php
// Procesar la actualización de la categoría
if (isset($_POST['edit_cat'])) {
    $req_field = array('categorie-name'); // Campo requerido
    validate_fields($req_field); // Validar campos

    $cat_name = remove_junk($db->escape($_POST['categorie-name'])); // Escapar y limpiar nombre de la categoría
    if (empty($errors)) { // Si no hay errores de validación
        $sql = "UPDATE categories SET name='{$cat_name}'"; // Consulta SQL para actualizar la categoría
        $sql .= " WHERE id='{$categorie['id']}'";
        $result = $db->query($sql); // Ejecutar consulta

        if ($result && $db->affected_rows() === 1) { // Verificar si la actualización fue exitosa
            $session->msg("s", "Categoría actualizada con éxito."); // Mensaje de éxito
            redirect('categorie.php', false); // Redirigir a la lista de categorías
        } else {
            $session->msg("d", "Lo siento, actualización falló."); // Mensaje de error
            redirect('categorie.php', false); // Redirigir a la lista de categorías
        }
    } else {
        $session->msg("d", $errors); // Mostrar errores de validación
        redirect('categorie.php', false); // Redirigir a la lista de categorías
    }
}
?>

<?php include_once('layouts/header.php'); // Incluir encabezado ?>

<div class="row">
    <div class="col-md-12">
        <?php echo display_msg($msg); // Mostrar mensajes ?>
    </div>
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Editando <?php echo remove_junk(ucfirst($categorie['name'])); ?></span>
                </strong>
            </div>
            <div class="panel-body">
                <!-- Formulario para editar la categoría -->
                <form method="post" action="edit_categorie.php?id=<?php echo (int)$categorie['id']; ?>">
                    <div class="form-group">
                        <input type="text" class="form-cont
