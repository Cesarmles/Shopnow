<?php
  // Inicia el almacenamiento en búfer de salida
  ob_start();
  
  // Incluye el archivo necesario para cargar configuraciones y funciones
  require_once('includes/load.php');

  // Redirige al usuario a la página de inicio si ya está autenticado
  if ($session->isUserLoggedIn(true)) {
    redirect('home.php', false);
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <!-- Incluye los estilos CSS -->
  <link rel="stylesheet" href="path/to/your/styles.css">
  <!-- Agrega otros enlaces a recursos necesarios -->
</head>
<body>
  <div class="login-page">
    <div class="text-center">
      <h1>Bienvenido</h1>
      <p>Inicia sesión para comenzar</p>
    </div>
    <?php echo display_msg($msg); ?>
    <form method="post" action="auth_v2.php" class="clearfix">
      <div class="form-group">
        <label for="username" class="control-label">Nombre de usuario</label>
        <input type="text" class="form-control" name="username" id="username" placeholder="Nombre de usuario" required>
      </div>
      <div class="form-group">
        <label for="password" class="control-label">Contraseña</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-info pull-right">Iniciar sesión</button>
      </div>
    </form>
  </div>
  <!-- Incluye los scripts JS -->
  <script src="path/to/your/scripts.js"></script>
</body>
</html>

<?php
  // Finaliza el almacenamiento en búfer de salida y lo envía al navegador
  ob_end_flush();
?>
