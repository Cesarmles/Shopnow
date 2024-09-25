<?php
  $page_title = 'Alertas - Congelados';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) {
      redirect('index.php', false);
  }
?>
<?php include_once('layouts/header.php'); ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center text-info">Congelados</h2>
      <p class="text-center">Verifica las alertas de los refrigeradores en esta sección.</p>
      <!-- Aquí puedes agregar la lógica para mostrar las alertas -->
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
