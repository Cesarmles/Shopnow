<?php
require_once('includes/load.php'); // Cargar configuraciones y funciones

// Verificar nivel de permiso del usuario para acceder a esta página
page_require_level(1);

// Obtener el ID de la categoría desde la URL
$categorie_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Verificar que el ID de la categoría es válido
if ($categorie_id <= 0) {
    $session->msg("d", "ID de categoría no válido.");
    redirect('categorie.php');
}

// Encontrar la categoría por ID
$categorie = find_by_id('categories', $categorie_id);

if (!$categorie) {
    $session->msg("d", "Categoría no encontrada.");
    redirect('categorie.php');
}

// Intentar eliminar la categoría
$delete_result = delete_by_id('categories', $categorie_id);

if ($delete_result) {
    $session->msg("s", "Categoría eliminada exitosamente.");
} else {
    $session->msg("d", "Error al eliminar la categoría.");
}

// Redirigir a la página de categorías
redirect('categorie.php');
?>
