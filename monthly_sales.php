<?php
  $page_title = 'Ventas mensuales'; // Establece el título de la página como "Ventas mensuales"
  require_once('includes/load.php'); // Incluye el archivo para cargar configuraciones y funciones

  // Verifica el nivel de permiso del usuario para acceder a la página
  page_require_level(3); // Se requiere el nivel 3 o superior para acceder a esta página

  // Obtiene el año actual
  $year = date('Y');
  
  // Recupera las ventas mensuales del año actual
  $sales = monthlySales($year);
?>

<?php include_once('layouts/header.php'); // Incluye el archivo de encabezado ?>

<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); // Muestra cualquier mensaje de notificación ?>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Ventas mensuales</span>
        </strong>
      </div>
      <div class="panel-body">
        <!-- Tabla que muestra las ventas mensuales -->
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th> <!-- Número de fila -->
              <th>Descripción</th> <!-- Descripción de la venta -->
              <th class="text-center" style="width: 15%;">Cantidad vendidas</th> <!-- Cantidad vendida -->
              <th class="text-center" style="width: 15%;">Total</th> <!-- Total de la venta -->
              <th class="text-center" style="width: 15%;">Fecha</th> <!-- Fecha de la venta -->
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sales as $sale): ?>
            <tr>
              <td class="text-center"><?php echo count_id();?></td> <!-- ID de la venta -->
              <td><?php echo remove_junk($sale['name']); ?></td> <!-- Nombre del producto o descripción -->
              <td class="text-center"><?php echo (int)$sale['qty']; ?></td> <!-- Cantidad vendida -->
              <td class="text-center"><?php echo remove_junk($sale['total_saleing_price']); ?></td> <!-- Precio total de la venta -->
              <td class="text-center"><?php echo date("d/m/Y", strtotime($sale['date'])); ?></td> <!-- Fecha de la venta en formato "dd/mm/aaaa" -->
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); // Incluye el archivo de pie de página ?>
