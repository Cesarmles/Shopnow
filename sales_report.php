<?php
$page_title = 'Reporte de ventas'; // Establece el título de la página como "Reporte de ventas"
require_once('includes/load.php'); // Incluye el archivo para cargar configuraciones y funciones

// Verifica el nivel de permiso del usuario para acceder a la página
page_require_level(3); // Se requiere el nivel 3 o superior para acceder a esta página
?>
<?php include_once('layouts/header.php'); // Incluye el archivo de encabezado ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); // Muestra cualquier mensaje de notificación ?>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="panel">
      <div class="panel-heading">
        <!-- Espacio para el encabezado del panel, actualmente vacío -->
      </div>
      <div class="panel-body">
        <!-- Formulario para generar el reporte de ventas -->
        <form class="clearfix" method="post" action="sale_report_process.php">
          <div class="form-group">
            <label class="form-label">Rango de fechas</label> <!-- Etiqueta para el rango de fechas -->
            <div class="input-group">
              <!-- Campo de fecha de inicio -->
              <input type="text" class="datepicker form-control" name="start-date" placeholder="From">
              <span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>
              <!-- Campo de fecha de fin -->
              <input type="text" class="datepicker form-control" name="end-date" placeholder="To">
            </div>
          </div>
          <div class="form-group">
            <!-- Botón para enviar el formulario y generar el reporte -->
            <button type="submit" name="submit" class="btn btn-primary">Generar Reporte</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); // Incluye el archivo de pie de página ?>
