<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);

  if (isset($_POST['upload'])) {
    // Check if the file is being uploaded
    if (isset($_FILES['layout_image']) && $_FILES['layout_image']['error'] === UPLOAD_ERR_OK) {
      $file_tmp_name = $_FILES['layout_image']['tmp_name'];
      $file_name = $_FILES['layout_image']['name'];
      $file_size = $_FILES['layout_image']['size'];
      $file_error = $_FILES['layout_image']['error'];
      $file_type = $_FILES['layout_image']['type'];
      
      // Define allowed file types and max file size
      $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
      $max_size = 2 * 1024 * 1024; // 2 MB

      // Validate file type and size
      if (in_array($file_type, $allowed_types) && $file_size <= $max_size) {
        $upload_dir = 'path/to/your/uploads/'; // Define your upload directory
        $file_path = $upload_dir . basename($file_name);

        // Move the file to the upload directory
        if (move_uploaded_file($file_tmp_name, $file_path)) {
          // Update database record with the new image path if needed
          // Example: update_image_path($file_path);

          $session->msg("s", "Imagen del layout actualizada correctamente.");
          redirect('home.php');
        } else {
          $session->msg("d", "Error al mover el archivo.");
        }
      } else {
        $session->msg("d", "Tipo de archivo no permitido o archivo demasiado grande.");
      }
    } else {
      $session->msg("d", "Error al subir el archivo.");
    }
  }

  // Retrieve the current layout image path (if stored in the database)
  // Example: $current_image = get_current_layout_image();

?>
<?php include_once('layouts/header.php'); ?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Editar Layout de Mercancía</h3>
        </div>
        <div class="panel-body">
          <form action="edit_layout.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="layout_image">Selecciona una nueva imagen:</label>
              <input type="file" name="layout_image" id="layout_image" class="form-control" required>
            </div>
            <button type="submit" name="upload" class="btn btn-primary">Subir Imagen</button>
          </form>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Imagen Actual del Layout</h3>
        </div>
        <div class="panel-body">
          <!-- Display the current layout image if available -->
          <?php if (isset($current_image) && file_exists($current_image)): ?>
            <img src="<?php echo $current_image; ?>" alt="Layout de Mercancía" class="img-fluid">
          <?php else: ?>
            <p>No hay imagen de layout disponible.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
