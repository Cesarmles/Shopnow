<?php
require_once('includes/load.php'); // Cargar configuraciones y funciones

// Verificar el nivel de permiso del usuario para acceder a esta página
page_require_level(2);

// Obtener el ID del producto desde la URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Verificar que el ID del producto es válido
if ($product_id <= 0) {
    $session->msg("d", "ID de producto no válido.");
    redirect('product.php');
}

// Encontrar el producto por ID
$product = find_by_id('products', $product_id);

if (!$product) {
    $session->msg("d", "Producto no encontrado.");
    redirect('product.php');
}

// Intentar eliminar el producto
$delete_result = delete_by_id('products', $product_id);

if ($delete_result) {
    $session->msg("s", "Producto eliminado exitosamente.");
} else {
    $session->msg("d", "Error al eliminar el producto.");
}

// Redirigir a la página de productos
redirect('product.php');
?>
