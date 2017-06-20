<?php require('../Connections/cn.php'); ?>
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
	
  if ( !checkProductName($_POST['product_name']) ) {
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
  } else {
	  
	echo("<script>alert('Product name already exists!'); history.back(-1); </script>");  
	return false;
  }
}

mysql_select_db($database_cn, $cn);
$query_rsCategories = "SELECT categories.category_id, categories.category_name FROM categories ORDER BY categories.category_name";
$rsCategories = mysql_query($query_rsCategories, $cn) or die(mysql_error());
$row_rsCategories = mysql_fetch_assoc($rsCategories);
$totalRows_rsCategories = mysql_num_rows($rsCategories);

function checkProductName($colname_rsProductName) {
	
	require('../Connections/cn.php');
	mysql_select_db($database_cn, $cn);
	$query_rsProductName = sprintf("SELECT product_name FROM products WHERE product_name = %s", GetSQLValueString($colname_rsProductName, "text"));
	$rsProductName = mysql_query($query_rsProductName, $cn) or die(mysql_error());
	$row_rsProductName = mysql_fetch_assoc($rsProductName);
	$totalRows_rsProductName = mysql_num_rows($rsProductName);
	
	if ( empty($totalRows_rsProductName)) {
		return false;
	} else { 
		return true;
	}
}
?>
<link rel="stylesheet" type="text/css" href="css/cart-style.css">

<h2>Forma para crear un  producto nuevo</h2>

<div class="action-link">
<a href="product-list.php" class="action-link">Regresar</a> </div>


<hr/>
<div class="form">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
	<div class="row-item form-title">Nombre del producto:</div>
	<div class="row-item form-input"><input type="text" name="product_name" value="" size="32"></div>
	<div class="row-item form-title">SEO:</div>
	<div class="row-item form-input"><input type="text" name="product_seo" value="" size="32"></div>
	<div class="row-item form-title">Precio:</div>
	<div class="row-item form-input"><input type="text" name="product_price" value="0.00" size="32"></div>
	<div class="row-item form-title">Categor&iacute;a:</div>
	<div class="row-item form-input">
	<select name="product_category_id">
	<?php
		do {  
		?>
						<option value="<?php echo $row_rsCategories['category_id']?>"><?php echo $row_rsCategories['category_name']?></option>
						<?php
		} while ($row_rsCategories = mysql_fetch_assoc($rsCategories));
		  $rows = mysql_num_rows($rsCategories);
		  if($rows > 0) {
			  mysql_data_seek($rsCategories, 0);
			  $row_rsCategories = mysql_fetch_assoc($rsCategories);
		  }
		?>
	</select>
	</div>
	<div class="row-item form-title">Estatus:</div>
	<div class="row-item form-input">
	<table>
		<tr>
			<td><input type="radio" name="product_status" value="1" >
				Mostrar</td>
		</tr>
		<tr>
			<td><input type="radio" name="product_status" value="0" >
				Ocultar</td>
		</tr>
	</table>
	</div>
	<div class="row-item right"><input type="submit" value="Guardar producto" class="button-submit"></div>
	<input type="hidden" name="MM_insert" value="form1">
</form>
</div>
<?php
mysql_free_result($rsCategories);

mysql_free_result($rsProductName);
?>
