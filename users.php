<?php
  $page_title = 'Lista de usuarios'; // Establece el título de la página como "Lista de usuarios"
  require_once('includes/load.php'); // Incluye el archivo para cargar configuraciones y funciones
?>

<?php
// Verifica el nivel de permiso del usuario para acceder a la página
page_require_level(1); // Se requiere el nivel 1 o superior para acceder a esta página

// Recupera todos los usuarios de la base de datos
$all_users = find_all_user();
?>

<?php include_once('layouts/header.php'); // Incluye el archivo de encabezado ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); // Muestra cualquier mensaje de notificación ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Usuarios</span>
       </strong>
         <!-- Botón para agregar un nuevo usuario -->
         <a href="add_user.php" class="btn btn-info pull-right">Agregar usuario</a>
      </div>
     <div class="panel-body">
      <!-- Tabla que muestra la lista de usuarios -->
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th> <!-- Número de fila -->
            <th>Nombre </th> <!-- Nombre del usuario -->
            <th>Usuario</th> <!-- Nombre de usuario -->
            <th class="text-center" style="width: 15%;">Rol de usuario</th> <!-- Rol del usuario -->
            <th class="text-center" style="width: 10%;">Estado</th> <!-- Estado del usuario (Activo/Inactivo) -->
            <th style="width: 20%;">Último login</th> <!-- Fecha del último inicio de sesión -->
            <th class="text-center" style="width: 100px;">Acciones</th> <!-- Acciones disponibles para el usuario -->
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_users as $a_user): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td> <!-- ID del usuario -->
           <td><?php echo remove_junk(ucwords($a_user['name']))?></td> <!-- Nombre del usuario, con primera letra en mayúscula -->
           <td><?php echo remove_junk(ucwords($a_user['username']))?></td> <!-- Nombre de usuario, con primera letra en mayúscula -->
           <td class="text-center"><?php echo remove_junk(ucwords($a_user['group_name']))?></td> <!-- Rol del usuario, con primera letra en mayúscula -->
           <td class="text-center">
           <?php if($a_user['status'] === '1'): ?>
            <span class="label label-success"><?php echo "Activo"; ?></span> <!-- Etiqueta verde para usuarios activos -->
          <?php else: ?>
            <span class="label label-danger"><?php echo "Inactivo"; ?></span> <!-- Etiqueta roja para usuarios inactivos -->
          <?php endif;?>
           </td>
           <td><?php echo read_date($a_user['last_login'])?></td> <!-- Fecha del último inicio de sesión -->
           <td class="text-center">
             <div class="btn-group">
                <!-- Botón para editar el usuario -->
                <a href="edit_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                  <i class="glyphicon glyphicon-pencil"></i>
               </a>
                <!-- Botón para eliminar el usuario -->
                <a href="delete_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                  <i class="glyphicon glyphicon-remove"></i>
                </a>
             </div>
           </td>
          </tr>
        <?php endforeach;?>
       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); // Incluye el archivo de pie de página ?>
