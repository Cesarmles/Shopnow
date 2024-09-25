<?php
require_once('includes/load.php'); // Cargar configuraciones y funciones

// Verificar el nivel de permiso del usuario para acceder a esta página
page_require_level(3);

// Obtener el ID de la venta desde la URL
$sale_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Verificar que el ID de la venta es válido
if ($sale_id <= 0) {
    $session->msg("d", "ID de venta no válido.");
    redirect('sales.php');
}

// Encontrar la venta por ID
$d_sale = find_by_id('sales', $sale_id);

if (!$d_sale) {
    $session->msg("d", "Venta no encontrada.");
    redirect('sales.php');
}

// Intentar eliminar la venta
$delete_result = delete_by_id('sales', $sale_id);

if ($delete_result) {
    $session->msg("s", "Venta eliminada exitosamente.");
} else {
    $session->msg("d", "Error al eliminar la venta.");
}

// Redirigir a la página de ventas
redirect('sales.php');
?>
