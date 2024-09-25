<?php
  $page_title = 'Alertas - Carnicería';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) {
      redirect('index.php', false);
  }
?>
<?php include_once('layouts/header.php'); ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center text-danger">Carnicería</h2>
      <p class="text-center">Verifica las alertas de los refrigeradores en esta sección.</p>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card text-center">
        <div class="card-header bg-danger text-white">
          Temperatura del Refrigerador
        </div>
        <div class="card-body">
          <h5 class="card-title">Temperatura Actual</h5>
          <div class="progress" style="height: 25px;">
            <div class="progress-bar bg-info" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">-5°C</div>
          </div>
        </div>
        <div class="card-footer text-muted">
          Actualizado hace 5 minutos
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
