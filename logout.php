<?php
  // Incluye el archivo necesario para cargar configuraciones y funciones
  require_once('includes/load.php');

  // Intenta cerrar la sesión del usuario
  if($session->logout()) {
    // Redirige al usuario a la página de inicio si el cierre de sesión fue exitoso
    $session->msg('s', 'Has cerrado sesión exitosamente.');
    redirect('index.php');
  } else {
    // Redirige al usuario a la página de inicio si hubo un problema al cerrar sesión
    $session->msg('d', 'Hubo un problema al cerrar sesión. Inténtalo de nuevo.');
    redirect('index.php');
  }
?>
