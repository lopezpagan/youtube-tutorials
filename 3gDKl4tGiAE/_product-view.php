<?php require_once('../Connections/cn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO products (product_name, product_seo, product_price, product_category_id, product_status) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['product_name'], "text"),
                       GetSQLValueString($_POST['product_seo'], "text"),
                       GetSQLValueString($_POST['product_price'], "double"),
                       GetSQLValueString($_POST['product_category_id'], "int"),
                       GetSQLValueString($_POST['product_status'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "product-list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE products SET product_name=%s, product_seo=%s, product_price=%s, product_category_id=%s, product_status=%s WHERE product_id=%s",
                       GetSQLValueString($_POST['product_name'], "text"),
                       GetSQLValueString($_POST['product_seo'], "text"),
                       GetSQLValueString($_POST['product_price'], "double"),
                       GetSQLValueString($_POST['product_category_id'], "int"),
                       GetSQLValueString($_POST['product_status'], "int"),
                       GetSQLValueString($_POST['product_id'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($updateSQL, $cn) or die(mysql_error());

  $updateGoTo = "product-list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_cn, $cn);
$query_rsCategories = "SELECT categories.category_id, categories.category_name FROM categories ORDER BY categories.category_name";
$rsCategories = mysql_query($query_rsCategories, $cn) or die(mysql_error());
$row_rsCategories = mysql_fetch_assoc($rsCategories);
$totalRows_rsCategories = mysql_num_rows($rsCategories);

$var_product_id_rsProducts = "0";
if (isset($_GET['recordID'])) {
  $var_product_id_rsProducts = $_GET['recordID'];
}
mysql_select_db($database_cn, $cn);
$query_rsProducts = sprintf("SELECT * FROM products WHERE products.product_id = %s", GetSQLValueString($var_product_id_rsProducts, "int"));
$rsProducts = mysql_query($query_rsProducts, $cn) or die(mysql_error());
$row_rsProducts = mysql_fetch_assoc($rsProducts);
$totalRows_rsProducts = mysql_num_rows($rsProducts);
?>
<link rel="stylesheet" type="text/css" href="css/cart-style.css">

<h2>Forma para ver el  producto</h2>

<div class="action-link">
<a href="product-list.php" class="action-link">Regresar</a> </div>


<hr/>
<div class="form">
	<div class="row-item form-title">Nombre del producto:</div>
	<div class="row-item form-input"><?php echo htmlentities($row_rsProducts['product_name'], ENT_COMPAT, ''); ?></div>
	<div class="row-item form-title">SEO:</div>
	<div class="row-item form-input"><?php echo htmlentities($row_rsProducts['product_seo'], ENT_COMPAT, ''); ?></div>
	<div class="row-item form-title">Precio:</div>
	<div class="row-item form-input"><?php echo htmlentities($row_rsProducts['product_price'], ENT_COMPAT, ''); ?></div>
	<div class="row-item form-title">Categor&iacute;a:</div>
	<div class="row-item form-input">
	<select name="product_category_id">
		<?php 
		do {  
		?>
		<option value="<?php echo $row_rsCategories['category_id']?>" <?php if (!(strcmp($row_rsCategories['category_id'], htmlentities($row_rsProducts['product_category_id'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>><?php echo $row_rsCategories['category_name']?></option>
		<?php
		} while ($row_rsCategories = mysql_fetch_assoc($rsCategories));
		?>
	</select>
	</div>
	<div class="row-item form-title">Estatus:</div>
	<div class="row-item form-input">
	<table>
		<tr>
			<td><input type="radio" name="product_status" value="1" <?php if (!(strcmp(htmlentities($row_rsProducts['product_status'], ENT_COMPAT, ''),1))) {echo "checked=\"checked\"";} ?>>
				Mostrar</td>
		</tr>
		<tr>
			<td><input type="radio" name="product_status" value="0" <?php if (!(strcmp(htmlentities($row_rsProducts['product_status'], ENT_COMPAT, ''),0))) {echo "checked=\"checked\"";} ?>>
				Ocultar</td>
		</tr>
	</table>
	</div>

<?php
mysql_free_result($rsCategories);

mysql_free_result($rsProducts);
?>
