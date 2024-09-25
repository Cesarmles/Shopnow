<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Inicio de Sesión</title>
  <style>
    body {
      background-color: #000000; /* Fondo negro */
      color: #FFFFFF;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }
    .login-page {
      max-width: 600px; /* Más ancho horizontalmente */
      width: 100%;
      padding: 50px;
      background-color: #115d06; /* Verde solicitado */
      border-radius: 10px;
      box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.7);
    }
    .login-page h1, .login-page p {
      text-align: center;
      margin-bottom: 40px;
    }
    .form-control {
      background-color: #1C1C1C; /* Campo de entrada negro */
      border: 1px solid #38444D;
      color: #FFFFFF;
    }
    .form-control:focus {
      background-color: #22303C;
      color: #FFFFFF;
    }
    .btn-info {
      background-color: #FFFFFF;
      color: #115d06;
      border: none;
      width: 100%;
      padding: 20px;
      font-size: 16px;
    }
    .btn-info:hover {
      background-color: #e1e8e3;
    }
  </style>
</head>
<body>
  <div class="login-page">
    <div class="text-center">
       <h1>Bienvenido</h1>
       <p>Iniciar sesión</p>
    </div>
    <?php echo display_msg($msg); ?>
    <form method="post" action="auth.php" class="clearfix">
      <div class="form-group">
        <label for="username" class="control-label">Usuario</label>
        <input type="text" class="form-control" name="username" placeholder="Usuario">
      </div>
      <div class="form-group">
        <label for="password" class="control-label">Contraseña</label>
        <input type="password" name="password" class="form-control" placeholder="Contraseña">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-info pull-right">Entrar</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php include_once('layouts/footer.php'); ?>



