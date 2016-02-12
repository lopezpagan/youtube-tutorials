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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE categories SET category_name=%s, category_desc=%s, category_status=%s WHERE category_id=%s",
                       GetSQLValueString($_POST['category_name'], "text"),
                       GetSQLValueString($_POST['category_desc'], "text"),
                       GetSQLValueString($_POST['category_status'], "int"),
                       GetSQLValueString($_POST['category_id'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($updateSQL, $cn) or die(mysql_error());

  $updateGoTo = "category-list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_cn, $cn);
$query_rsCategories = "SELECT * FROM categories";
$rsCategories = mysql_query($query_rsCategories, $cn) or die(mysql_error());
$row_rsCategories = mysql_fetch_assoc($rsCategories);
$totalRows_rsCategories = mysql_num_rows($rsCategories);$var_category_id_rsCategories = "0";
if (isset($_GET['recordID'])) {
  $var_category_id_rsCategories = $_GET['recordID'];
}
mysql_select_db($database_cn, $cn);
$query_rsCategories = sprintf("SELECT * FROM categories WHERE categories.category_id = %s", GetSQLValueString($var_category_id_rsCategories, "int"));
$rsCategories = mysql_query($query_rsCategories, $cn) or die(mysql_error());
$row_rsCategories = mysql_fetch_assoc($rsCategories);
$totalRows_rsCategories = mysql_num_rows($rsCategories);
?>
<link rel="stylesheet" type="text/css" href="css/cart-style.css">
<h2>Forma para ver la  categor&iacute;a</h2>

<div class="action-link">
<a href="category-list.php" class="action-link">Regresar</a> </div>


<hr/>
<div class="form">
	<div class="row-item form-title">Nombre de la categor&iacute;a:</div>
	<div class="row-item form-input"><?php echo htmlentities($row_rsCategories['category_name'], ENT_COMPAT, ''); ?></div>
	<div class="row-item form-title">Descripcion:</div>
	<div class="row-item form-input"><?php echo htmlentities($row_rsCategories['category_desc'], ENT_COMPAT, ''); ?></div>
	<div class="row-item form-title">Estatus:</div>
	<div class="row-item form-input">	
	<table>
		<tr>
			<td><input type="radio" name="category_status" value="1" <?php if (!(strcmp(htmlentities($row_rsCategories['category_status'], ENT_COMPAT, ''),1))) {echo "checked=\"checked\"";} ?>>
				Mostrar</td>
		</tr>
		<tr>
			<td><input type="radio" name="category_status" value="0" <?php if (!(strcmp(htmlentities($row_rsCategories['category_status'], ENT_COMPAT, ''),0))) {echo "checked=\"checked\"";} ?>>
				Ocultar</td>
		</tr>
	</table>
	</div>
</div>
<?php
mysql_free_result($rsCategories);
?>
