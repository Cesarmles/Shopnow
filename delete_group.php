<?php
require_once('includes/load.php'); // Cargar configuraciones y funciones

// Verificar el nivel de permiso del usuario para acceder a esta página
page_require_level(1);

// Obtener el ID del grupo desde la URL
$group_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Verificar que el ID del grupo es válido
if ($group_id <= 0) {
    $session->msg("d", "ID de grupo no válido.");
    redirect('group.php');
}

// Intentar eliminar el grupo por ID
$delete_result = delete_by_id('user_groups', $group_id);

if ($delete_result) {
    $session->msg("s", "Grupo eliminado exitosamente.");
} else {
    $session->msg("d", "Error al eliminar el grupo.");
}

// Redirigir a la página de grupos
redirect('group.php');
?>
