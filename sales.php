<?php
$page_title = 'Lista de ventas'; // Establece el título de la página como "Lista de ventas"
require_once('includes/load.php'); // Incluye el archivo para cargar configuraciones y funciones

// Verifica el nivel de permiso del usuario para acceder a la página
page_require_level(3); // Se requiere el nivel 3 o superior para acceder a esta página

// Obtiene una lista de todas las ventas desde la base de datos
$sales = find_all_sale();

// Preparar datos para el gráfico
$sales_by_date = [];
foreach ($sales as $sale) {
    $date = $sale['date'];
    if (!isset($sales_by_date[$date])) {
        $sales_by_date[$date] = 0;
    }
    $sales_by_date[$date] += (int)$sale['price']; // Acumula el total de ventas por fecha
}

// Ordenar fechas
ksort($sales_by_date);

$dates = array_keys($sales_by_date);
$totals = array_values($sales_by_date);
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
          <span>Todas las ventas</span> <!-- Título del panel -->
        </strong>
        <div class="pull-right">
          <a href="add_sale.php" class="btn btn-primary">Agregar venta</a> <!-- Enlace para agregar una nueva venta -->
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th> <!-- Número de venta -->
              <th> Nombre del producto </th> <!-- Nombre del producto -->
              <th class="text-center" style="width: 15%;"> Cantidad</th> <!-- Cantidad vendida -->
              <th class="text-center" style="width: 15%;"> Total </th> <!-- Total de la venta -->
              <th class="text-center" style="width: 15%;"> Fecha </th> <!-- Fecha de la venta -->
              <th class="text-center" style="width: 100px;"> Acciones </th> <!-- Acciones disponibles -->
           </tr>
          </thead>
         <tbody>
           <?php foreach ($sales as $sale): // Itera a través de cada venta ?>
           <tr>
             <td class="text-center"><?php echo count_id(); // Muestra el ID de la venta ?></td>
             <td><?php echo remove_junk($sale['name']); // Muestra el nombre del producto ?></td>
             <td class="text-center"><?php echo (int)$sale['qty']; // Muestra la cantidad vendida ?></td>
             <td class="text-center"><?php echo remove_junk($sale['price']); // Muestra el precio total ?></td>
             <td class="text-center"><?php echo $sale['date']; // Muestra la fecha de la venta ?></td>
             <td class="text-center">
                <div class="btn-group">
                   <a href="edit_sale.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                     <span class="glyphicon glyphicon-edit"></span> <!-- Botón para editar la venta -->
                   </a>
                   <a href="delete_sale.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                     <span class="glyphicon glyphicon-trash"></span> <!-- Botón para eliminar la venta -->
                   </a>
                </div>
             </td>
           </tr>
           <?php endforeach; // Fin del bucle de ventas ?>
         </tbody>
       </table>
      </div>
    </div>
  </div>
</div>

<!-- Sección para el gráfico de ventas diarias -->
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Ventas por Día</h3>
      </div>
      <div class="panel-body">
        <canvas id="salesChart"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Incluye los scripts necesarios para gráficos -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
      type: 'line', // Tipo de gráfico (puede ser 'line', 'bar', etc.)
      data: {
        labels: <?php echo json_encode($dates); ?>,
        datasets: [{
          label: 'Ventas Totales',
          data: <?php echo json_encode($totals); ?>,
          borderColor: 'rgba(18, 93, 6, 1)',
          backgroundColor: 'rgba(18, 93, 6, 0.2)',
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        scales: {
          x: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Fecha'
            }
          },
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Total de Ventas'
            }
          }
        }
      }
    });
  });
</script>

<?php include_once('layouts/footer.php'); // Incluye el archivo de pie de página ?>
