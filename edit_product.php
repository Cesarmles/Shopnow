<?php
$page_title = 'Editar producto'; // Título de la página
require_once('includes/load.php'); // Cargar archivo de configuración y funciones

// Verificar el nivel de permisos del usuario para ver esta página
page_require_level(2);

$product = find_by_id('products', (int)$_GET['id']); // Obtener el producto específico por ID
$all_categories = find_all('categories'); // Obtener todas las categorías
$all_photo = find_all('media'); // Obtener todas las imágenes asociadas
if (!$product) {
    $session->msg("d", "Missing product id."); // Mensaje de error si no se encuentra el producto
    redirect('product.php'); // Redirigir a la lista de productos
}

// Actualización del producto
if (isset($_POST['product'])) {
    $req_fields = array('product-title', 'product-categorie', 'product-quantity', 'buying-price', 'saleing-price'); // Campos requeridos
    validate_fields($req_fields); // Validar campos

    if (empty($errors)) { // Si no hay errores de validación
        $p_name = remove_junk($db->escape($_POST['product-title'])); // Escapar y limpiar nombre del producto
        $p_cat = (int)$_POST['product-categorie']; // ID de categoría
        $p_qty = remove_junk($db->escape($_POST['product-quantity'])); // Escapar y limpiar cantidad
        $p_buy = remove_junk($db->escape($_POST['buying-price'])); // Escapar y limpiar precio de compra
        $p_sale = remove_junk($db->escape($_POST['saleing-price'])); // Escapar y limpiar precio de venta

        // Verificar si se ha seleccionado una imagen para el producto
        if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
            $media_id = '0'; // Sin imagen
        } else {
            $media_id = remove_junk($db->escape($_POST['product-photo'])); // ID de la imagen
        }

        // Consulta SQL para actualizar el producto
        $query = "UPDATE products SET";
        $query .= " name = '{$p_name}', quantity = '{$p_qty}',";
        $query .= " buy_price = '{$p_buy}', sale_price = '{$p_sale}', categorie_id = '{$p_cat}', media_id = '{$media_id}'";
        $query .= " WHERE id = '{$product['id']}'";
        $result = $db->query($query); // Ejecutar consulta

        if ($result && $db->affected_rows() === 1) { // Verificar si la actualización fue exitosa
            $session->msg('s', "Producto ha sido actualizado."); // Mensaje de éxito
            redirect('product.php', false); // Redirigir a la lista de productos
        } else {
            $session->msg('d', 'Lo siento, la actualización falló.'); // Mensaje de error
            redirect('edit_product.php?id=' . $product['id'], false); // Redirigir a la página de edición
        }
    } else {
        $session->msg("d", $errors); // Mostrar errores de validación
        redirect('edit_product.php?id=' . $product['id'], false); // Redirigir a la página de edición
    }
}
?>

<?php include_once('layouts/header.php'); // Incluir encabezado ?>

<div class="row">
    <div class="col-md-12">
        <?php echo display_msg($msg); // Mostrar mensajes ?>
    </div>
</div>

<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Editar producto</span> <!-- Título del panel -->
            </strong>
        </div>
        <div class="panel-body">
            <div class="col-md-7">
                <!-- Formulario para editar el producto -->
                <form method="post" action="edit_product.php?id=<?php echo (int)$product['id'] ?>">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="product-title" value="<?php echo remove_junk($product['name']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <select class="form-control" name="product-categorie">
                                    <option value="">Selecciona una categoría</option>
                                    <?php foreach ($all_categories as $cat): ?>
                                        <option value="<?php echo (int)$cat['id']; ?>" <?php if ($product['categorie_id'] === $cat['id']): echo "selected"; endif; ?>>
                                            <?php echo remove_junk($cat['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control" name="product-photo">
                                    <option value="">Sin imagen</option>
                                    <?php foreach ($all_photo as $photo): ?>
                                        <option value="<?php echo (int)$photo['id']; ?>" <?php if ($product['media_id'] === $photo['id']): echo "selected"; endif; ?>>
                                            <?php echo $photo['file_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qty">Cantidad</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-shopping-cart"></i>
                                        </span>
                                        <input type="number" class="form-control" name="product-quantity" value="<?php echo remove_junk($product['quantity']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="buying-price">Precio de compra</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-usd"></i>
                                        </span>
                                        <input type="number" class="form-control" name="buying-price" value="<?php echo remove_junk($product['buy_price']); ?>">
                                        <span class="input-group-addon">.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="saleing-price">Precio de venta</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-usd"></i>
                                        </span>
                                        <input type="number" class="form-control" name="saleing-price" value="<?php echo remove_junk($product['sale_price']); ?>">
                                        <span class="input-group-addon">.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="product" class="btn btn-danger">Actualizar</button> <!-- Botón para actualizar el producto -->
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once('layouts/footer.php'); // Incluir pie de página ?>
