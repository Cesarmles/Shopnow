<?php
require_once('includes/load.php'); // Cargar configuraciones y funciones

// Verificar el nivel de permiso del usuario para acceder a esta página
page_require_level(1);

// Obtener el ID del usuario desde la URL
$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Verificar que el ID del usuario es válido
if ($user_id <= 0) {
    $session->msg("d", "ID de usuario no válido.");
    redirect('users.php');
}

// Intentar eliminar el usuario por ID
$delete_result = delete_by_id('users', $user_id);

if ($delete_result) {
    $session->msg("s", "Usuario eliminado exitosamente.");
} else {
    $session->msg("d", "Error al eliminar el usuario.");
}

// Redirigir a la página de usuarios
redirect('users.php');
?>
