<?php
$page_title = 'Editar venta'; // Título de la página
require_once('includes/load.php'); // Cargar archivo de configuración y funciones
// Verificar el nivel de permisos del usuario para ver esta página
page_require_level(3);

$sale = find_by_id('sales', (int)$_GET['id']); // Obtener la venta específica por ID
if (!$sale) {
    $session->msg("d", "Missing sale id."); // Mensaje de error si no se encuentra la venta
    redirect('sales.php'); // Redirigir a la lista de ventas
}

$product = find_by_id('products', $sale['product_id']); // Obtener el producto asociado a la venta

// Actualizar la venta
if (isset($_POST['update_sale'])) {
    $req_fields = array('title', 'quantity', 'price', 'total', 'date'); // Campos requeridos
    validate_fields($req_fields); // Validar campos
    if (empty($errors)) { // Si no hay errores de validación
        $p_id = $db->escape((int)$product['id']); // Escapar ID del producto
        $s_qty = $db->escape((int)$_POST['quantity']); // Escapar cantidad
        $s_total = $db->escape($_POST['total']); // Escapar total
        $date = $db->escape($_POST['date']); // Escapar fecha
        $s_date = date("Y-m-d", strtotime($date)); // Convertir fecha al formato adecuado

        $sql = "UPDATE sales SET";
        $sql .= " product_id = '{$p_id}', qty = {$s_qty}, price = '{$s_total}', date = '{$s_date}'";
        $sql .= " WHERE id = '{$sale['id']}'"; // Actualizar la venta
        $result = $db->query($sql); // Ejecutar consulta
        if ($result && $db->affected_rows() === 1) { // Verificar si la actualización fue exitosa
            update_product_qty($s_qty, $p_id); // Actualizar cantidad del producto
            $session->msg('s', "Sale updated."); // Mensaje de éxito
            redirect('edit_sale.php?id=' . (int)$sale['id'], false); // Redirigir a la página de edición
        } else {
            $session->msg('d', 'Sorry, failed to update!'); // Mensaje de error
            redirect('sales.php', false); // Redirigir a la lista de ventas
        }
    } else {
        $session->msg("d", $errors); // Mostrar errores de validación
        redirect('edit_sale.php?id=' . (int)$sale['id'], false); // Redirigir a la página de edición
    }
}
?>
<?php include_once('layouts/header.php'); // Incluir encabezado ?>

<div class="row">
    <div class="col-md-6">
        <?php echo display_msg($msg); // Mostrar mensajes ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading clearfix">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Editar Venta</span> <!-- Título del panel -->
                </strong>
                <div class="pull-right">
                    <a href="sales.php" class="btn btn-primary">Mostrar todas las ventas</a> <!-- Botón para ver todas las ventas -->
                </div>
            </div>
            <div class="panel-body">
                <!-- Formulario para editar la venta -->
                <form method="post" action="edit_sale.php?id=<?php echo (int)$sale['id']; ?>" class="form-horizontal">
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Producto</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sug_input" name="title" value="<?php echo remove_junk($product['name']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="col-sm-2 control-label">Cantidad</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="quantity" value="<?php echo (int)$sale['qty']; ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-sm-2 control-label">Precio</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="price" value="<?php echo remove_junk($product['sale_price']); ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="total" class="col-sm-2 control-label">Total</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="total" value="<?php echo remove_junk($sale['price']); ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date" class="col-sm-2 control-label">Fecha</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control datepicker" name="date" value="<?php echo remove_junk($sale['date']); ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" name="update_sale" class="btn btn-primary">Actualizar venta</button> <!-- Botón para actualizar venta -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once('layouts/footer.php'); // Incluir pie de página ?>
