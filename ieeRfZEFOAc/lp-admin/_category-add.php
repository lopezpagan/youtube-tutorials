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
  $insertSQL = sprintf("INSERT INTO categories (category_id, category_name, category_desc, category_status) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['category_id'], "int"),
                       GetSQLValueString($_POST['category_name'], "text"),
                       GetSQLValueString($_POST['category_desc'], "text"),
                       GetSQLValueString($_POST['category_status'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "category-list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_cn, $cn);
$query_rsCategories = "SELECT * FROM categories";
$rsCategories = mysql_query($query_rsCategories, $cn) or die(mysql_error());
$row_rsCategories = mysql_fetch_assoc($rsCategories);
$totalRows_rsCategories = mysql_num_rows($rsCategories);
?>
<link rel="stylesheet" type="text/css" href="css/cart-style.css">

<h2>Forma para crear una  categor&iacute;a nueva</h2>

<div class="action-link">
<a href="category-list.php" class="action-link">Regresar</a> </div>


<hr/>
<div class="form">

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
	<div class="row-item form-title">Nombre de la categor&iacute;a:</div>
	<div class="row-item form-input"><input type="text" name="category_name" value="" size="32"></div>
	<div class="row-item form-title">Descripcion:</div>
	<div class="row-item form-input"><textarea name="category_desc" cols="" rows=""></textarea></div>
	<div class="row-item form-title">Estatus:</div>
	<div class="row-item form-input">
	<table>
		<tr>
			<td><input type="radio" name="category_status" value="1" >
				Mostrar</td>
		</tr>
		<tr>
			<td><input type="radio" name="category_status" value="0" >
				Ocultar</td>
		</tr>
	</table>
	</div>
	<div class="row-item right"><input type="submit" value="Guardar categor&iacute;a" class="button-submit"></div>
	<input type="hidden" name="MM_insert" value="form1">
</form>
</div>
<?php
mysql_free_result($rsCategories);
?>
