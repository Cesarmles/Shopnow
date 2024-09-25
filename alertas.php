<?php
  // Inicialización de la sesión y verificación de usuario autenticado
  $page_title = 'Alertas de Refrigeradores'; // Define el título de la página
  require_once('includes/load.php'); // Incluye el archivo de carga
  
  // Verifica si el usuario está autenticado. Si no, redirige a la página de inicio de sesión
  if (!$session->isUserLoggedIn(true)) { 
      redirect('index.php', false); 
  }
?>
<?php include_once('layouts/header.php'); ?> <!-- Incluye el archivo de encabezado de la página -->

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <!-- Muestra mensajes, como errores o notificaciones, usando la función display_msg -->
      <?php echo display_msg($msg); ?> 
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Alertas para Verificar Refrigeradores</h3> <!-- Título del panel -->
        </div>
        <div class="panel-body">
          <p>Las alertas se generan a las 6:00 am, 12:00 pm, 7:00 pm y 12:00 am.</p>
          <ul class="list-group">
            <li class="list-group-item"><a href="alertas_cocina.php">Cocina</a></li>
            <li class="list-group-item"><a href="alertas_carniceria.php">Carnicería</a></li>
            <li class="list-group-item"><a href="alertas_helados.php">Helados</a></li>
            <li class="list-group-item"><a href="alertas_frutas_verduras.php">Frutas y Verduras</a></li>
            <li class="list-group-item"><a href="alertas_lacteos.php">Lácteos</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?> <!-- Incluye el archivo de pie de página -->
