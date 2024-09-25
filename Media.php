<?php
  $page_title = 'Lista de imagenes'; // Establece el título de la página como "Lista de imágenes"
  require_once('includes/load.php'); // Incluye el archivo para cargar configuraciones y funciones
  
  // Verifica el nivel de permiso del usuario para acceder a la página
  page_require_level(2); // Se requiere el nivel 2 o superior para acceder a esta página
  
  // Recupera todos los archivos de medios de la base de datos
  $media_files = find_all('media');

  // Verifica si se ha enviado un archivo para subir
  if(isset($_POST['submit'])) {
    $photo = new Media(); // Crea una nueva instancia de la clase Media
    $photo->upload($_FILES['file_upload']); // Sube el archivo
    if($photo->process_media()){
      $session->msg('s', 'Imagen subida al servidor.'); // Mensaje de éxito
      redirect('media.php'); // Redirige a la misma página para refrescar la lista
    } else {
      $session->msg('d', join($photo->errors)); // Mensaje de error
      redirect('media.php'); // Redirige a la misma página para mostrar el error
    }
  }
?>

<?php include_once('layouts/header.php'); // Incluye el archivo de encabezado ?>

<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); // Muestra cualquier mensaje de notificación ?>
  </div>

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <span class="glyphicon glyphicon-camera"></span>
        <span>Lista de imagenes</span>
        <div class="pull-right">
          <!-- Formulario para subir imágenes -->
          <form class="form-inline" action="media.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-btn">
                  <input type="file" name="file_upload" multiple="multiple" class="btn btn-primary btn-file"/> <!-- Campo para seleccionar archivos -->
                </span>
                <button type="submit" name="submit" class="btn btn-default">Subir</button> <!-- Botón para enviar el formulario -->
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="panel-body">
        <!-- Tabla que muestra las imágenes subidas -->
        <table class="table">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th> <!-- Número de fila -->
              <th class="text-center">Imagen</th> <!-- Imagen -->
              <th class="text-center">Descripción</th> <!-- Nombre del archivo -->
              <th class="text-center" style="width: 20%;">Tipo</th> <!-- Tipo de archivo -->
              <th class="text-center" style="width: 50px;">Acciones</th> <!-- Acciones -->
            </tr>
          </thead>
          <tbody>
            <?php foreach ($media_files as $media_file): ?>
            <tr class="list-inline">
              <td class="text-center"><?php echo count_id();?></td> <!-- ID de la imagen -->
              <td class="text-center">
                <!-- Muestra la imagen con un borde -->
                <img src="uploads/products/<?php echo $media_file['file_name'];?>" class="img-thumbnail" />
              </td>
              <td class="text-center">
                <?php echo $media_file['file_name'];?> <!-- Nombre del archivo -->
              </td>
              <td class="text-center">
                <?php echo $media_file['file_type'];?> <!-- Tipo de archivo -->
              </td>
              <td class="text-center">
                <!-- Botón para eliminar la imagen -->
                <a href="delete_media.php?id=<?php echo (int) $media_file['id'];?>" class="btn btn-danger btn-xs" title="Eliminar">
                  <span class="glyphicon glyphicon-trash"></span>
                </a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); // Incluye el archivo de pie de página ?>
