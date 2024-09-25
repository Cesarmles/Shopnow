<?php
  // Inicialización de la sesión y verificación de usuario autenticado
  $page_title = 'Inicio'; // Define el título de la página
  require_once('includes/load.php'); // Incluye el archivo de carga, que podría contener configuraciones de sesión y autenticación
  
  // Verifica si el usuario está autenticado. Si no, redirige a la página de inicio de sesión
  if (!$session->isUserLoggedIn(true)) { 
      redirect('index.php', false); 
  }
?>
<?php include_once('layouts/header.php'); ?> <!-- Incluye el archivo de encabezado de la página -->

<div class="container-fluid"> <!-- Contenedor principal de la página -->
  <div class="row">
    <div class="col-md-12 text-center">
      <!-- Inserta el logo de la UAZ -->
      <img src="libs/images/uaz-logo.png" alt="UAZ Logo" class="img-fluid" style="max-width: 700px;">
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <!-- Muestra mensajes, como errores o notificaciones, usando la función display_msg -->
      <?php echo display_msg($msg); ?> 
    </div>
  </div>

  <div class="row">
    <div class="col-md-8"> <!-- Columna principal para el contenido -->
      <div class="panel panel-default"> <!-- Panel de Bootstrap para diseño -->
        <div class="panel-heading">
          <h3 class="panel-title">Resumen del inicio</h3> <!-- Título del panel -->
        </div>
        <div class="panel-body">
          <p>Bienvenido al inicio.</p>
          <ul class="list-group">
            <!-- Muestra información relevante del usuario -->
            <li class="list-group-item"><strong>Nombre de usuario:</strong> <?php echo $user['username']; ?></li>
            <li class="list-group-item"><strong>Rol:</strong> <?php echo ucfirst($user['user_level']); ?></li>
            <!-- Agrega más detalles relevantes del usuario o de la aplicación -->
          </ul>
        </div>
      </div>

      <!-- Agrega un gráfico o estadísticas -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Estadísticas</h3>
        </div>
        <div class="panel-body">
          <div id="user-stats">
            <!-- Puedes usar librerías como Chart.js para gráficos -->
            <canvas id="statsChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4"> <!-- Columna secundaria para acciones rápidas, layout y alertas -->
      <div class="panel panel-default"> <!-- Panel de Bootstrap para diseño -->
        <div class="panel-heading">
          <h3 class="panel-title">Acciones Rápidas</h3> <!-- Título del panel -->
        </div>
        <div class="panel-body">
          <ul class="list-group">
            <!-- Enlaces para acciones rápidas que el usuario puede tomar -->
            <li class="list-group-item"><a href="perfil.php">Ver perfil</a></li>
            <li class="list-group-item"><a href="settings.php">Configuración</a></li>
            <!-- Agrega más enlaces útiles para el usuario -->
          </ul>
        </div>
      </div>

      <!-- Panel de Layout para ver planos de acomodo -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Layout de Mercancía</h3> <!-- Título del panel -->
        </div>
        <div class="panel-body">
          <?php if ($user['user_level'] == 1): ?>
            <!-- Mostrar un botón para editar si el usuario es de nivel 1 -->
            <a href="edit_layout.php" class="btn btn-warning btn-sm">Editar Layout</a>
          <?php endif; ?>
          <!-- Mostrar la imagen del layout -->
          <img src="path/to/layout-image.jpg" alt="Layout de Mercancía" class="img-fluid">
        </div>
      </div>

      <!-- Panel de Alertas para verificar los refrigeradores -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Alertas</h3> <!-- Título del panel -->
        </div>
        <div class="panel-body">
          <!-- Botón que dirige a la página de alertas -->
          <a href="alertas.php" class="btn btn-danger btn-sm">Ver Alertas</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Incluye los scripts necesarios para gráficos -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Configuración del gráfico
    var ctx = document.getElementById('statsChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar', // Tipo de gráfico (puede ser 'line', 'bar', etc.)
      data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
        datasets: [{
          label: 'Usuarios Registrados',
          data: [10, 20, 30, 40, 50, 60],
          backgroundColor: 'rgba(18, 93, 6, 0.2)',
          borderColor: 'rgba(18, 93, 6, 1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  });
</script>

<?php include_once('layouts/footer.php'); ?> <!-- Incluye el archivo de pie de página -->
