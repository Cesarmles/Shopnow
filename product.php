<?php
  $page_title = 'Lista de productos'; // Establece el título de la página como "Lista de productos"
  require_once('includes/load.php'); // Incluye el archivo para cargar configuraciones y funciones

  // Verifica el nivel de permiso del usuario para acceder a la página
  page_require_level(2); // Se requiere el nivel 2 o superior para acceder a esta página

  // Recupera todos los productos de la base de datos
  $products = join_product_table();
?>

<?php include_once('layouts/header.php'); // Incluye el archivo de encabezado ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); // Muestra cualquier mensaje de notificación ?>
   </div>

   <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <!-- Botón para agregar un nuevo producto -->
           <a href="add_product.php" class="btn btn-primary">Agregar producto</a>
         </div>
        </div>
        <div class="panel-body">
          <!-- Tabla que muestra la lista de productos -->
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th> <!-- Número de fila -->
                <th>Imagen</th> <!-- Imagen del producto -->
                <th>Descripción</th> <!-- Descripción del producto -->
                <th class="text-center" style="width: 10%;">Categoría</th> <!-- Categoría del producto -->
                <th class="text-center" style="width: 10%;">Stock</th> <!-- Cantidad en stock -->
                <th class="text-center" style="width: 10%;">Precio de compra</th> <!-- Precio de compra -->
                <th class="text-center" style="width: 10%;">Precio de venta</th> <!-- Precio de venta -->
                <th class="text-center" style="width: 10%;">Agregado</th> <!-- Fecha en que se agregó el producto -->
                <th class="text-center" style="width: 100px;">Acciones</th> <!-- Acciones disponibles para el producto -->
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product): ?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td> <!-- ID del producto -->
                <td>
                  <?php if($product['media_id'] === '0'): ?>
                    <!-- Imagen por defecto si no hay imagen asociada -->
                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                  <?php else: ?>
                    <!-- Imagen del producto -->
                    <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                  <?php endif; ?>
                </td>
                <td><?php echo remove_junk($product['name']); ?></td> <!-- Nombre del producto -->
                <td class="text-center"><?php echo remove_junk($product['categorie']); ?></td> <!-- Categoría del producto -->
                <td class="text-center"><?php echo remove_junk($product['quantity']); ?></td> <!-- Cantidad en stock -->
                <td class="text-center"><?php echo remove_junk($product['buy_price']); ?></td> <!-- Precio de compra -->
                <td class="text-center"><?php echo remove_junk($product['sale_price']); ?></td> <!-- Precio de venta -->
                <td class="text-center"><?php echo read_date($product['date']); ?></td> <!-- Fecha de adición -->
                <td class="text-center">
                  <div class="btn-group">
                    <!-- Botón para editar el producto -->
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs" title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <!-- Botón para eliminar el producto -->
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs" title="Eliminar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
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
