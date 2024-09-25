<?php
$page_title = 'Mi perfil'; // Establece el título de la página como "Mi perfil"
require_once('includes/load.php'); // Incluye el archivo para cargar configuraciones y funciones

// Verifica el nivel de permiso del usuario para acceder a la página
page_require_level(3); // Se requiere el nivel 3 o superior para acceder a esta página
?>
<?php
$user_id = (int)$_GET['id']; // Obtiene el ID del usuario de la URL y lo convierte a entero
if (empty($user_id)): // Si el ID de usuario está vacío
    redirect('home.php', false); // Redirige a la página de inicio si el ID no está presente
else:
    $user_p = find_by_id('users', $user_id); // Busca el usuario por su ID en la base de datos
endif;
?>
<?php include_once('layouts/header.php'); // Incluye el archivo de encabezado ?>
<div class="row">
   <div class="col-md-4">
       <div class="panel profile">
         <div class="jumbotron text-center bg-red">
            <img class="img-circle img-size-2" src="uploads/users/<?php echo $user_p['image']; ?>" alt=""> <!-- Muestra la imagen de perfil del usuario -->
            <h3><?php echo first_character($user_p['name']); ?></h3> <!-- Muestra el nombre del usuario -->
         </div>
         <?php if ($user_p['id'] === $user['id']): // Verifica si el usuario que visualiza la página es el mismo que el perfil que se está mostrando ?>
         <ul class="nav nav-pills nav-stacked">
          <li><a href="edit_account.php"> <i class="glyphicon glyphicon-edit"></i> Editar perfil</a></li> <!-- Enlace para editar el perfil si es el propio usuario -->
         </ul>
       <?php endif; ?>
       </div>
   </div>
</div>
<?php include_once('layouts/footer.php'); // Incluye el archivo de pie de página ?>
