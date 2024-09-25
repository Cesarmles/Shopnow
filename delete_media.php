<?php
require_once('includes/load.php'); // Cargar configuraciones y funciones

// Verificar el nivel de permiso del usuario para acceder a esta página
page_require_level(2);

// Obtener el ID del medio desde la URL
$media_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Verificar que el ID del medio es válido
if ($media_id <= 0) {
    $session->msg("d", "ID de medio no válido.");
    redirect('media.php');
}

// Encontrar el medio por ID
$find_media = find_by_id('media', $media_id);

if (!$find_media) {
    $session->msg("d", "Medio no encontrado.");
    redirect('media.php');
}

// Crear una instancia de la clase Media
$photo = new Media();

// Intentar eliminar el medio
if ($photo->media_destroy($find_media['id'], $find_media['file_name'])) {
    $session->msg("s", "Se ha eliminado la foto.");
} else {
    $session->msg("d", "Error al eliminar la foto.");
}

// Redirigir a la página de medios
redirect('media.php');
?>
