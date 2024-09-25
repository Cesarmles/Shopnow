<?php
  if(isset($_POST['p_name']) && strlen($_POST['p_name'])) {
    $product_title = remove_junk($db->escape($_POST['p_name']));
    $html = '';
    
    if($results = find_all_product_info_by_title($product_title)) {
      foreach ($results as $result) {
        $html .= "<tr>";
        $html .= "<td id=\"s_name\">".htmlspecialchars($result['name'])."</td>";
        $html .= "<input type=\"hidden\" name=\"s_id\" value=\"".htmlspecialchars($result['id'])."\">";
        $html .= "<td>";
        $html .= "<input type=\"text\" class=\"form-control\" name=\"precio\" value=\"".htmlspecialchars($result['sale_price'])."\">";
        $html .= "</td>";
        $html .= "<td id=\"s_qty\">";
        $html .= "<input type=\"text\" class=\"form-control\" name=\"cantidad\" value=\"1\">";
        $html .= "</td>";
        $html .= "<td>";
        $html .= "<input type=\"text\" class=\"form-control\" name=\"total\" value=\"".htmlspecialchars($result['sale_price'])."\">";
        $html .= "</td>";
        $html .= "<td>";
        $html .= "<input type=\"date\" class=\"form-control datePicker\" name=\"date\" data-date data-date-format=\"yyyy-mm-dd\">";
        $html .= "</td>";
        $html .= "<td>";
        $html .= "<button type=\"submit\" name=\"add_sale\" class=\"btn btn-primary\">Agregar</button>";
        $html .= "</td>";
        $html .= "</tr>";
      }
    } else {
      $html ='<tr><td>El producto no se encuentra registrado en la base de datos</td></tr>';
    }

    echo json_encode($html);
  }
?>
