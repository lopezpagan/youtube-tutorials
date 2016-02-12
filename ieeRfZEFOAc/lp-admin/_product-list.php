<link rel="stylesheet" type="text/css" href="css/cart-style.css">
<h2>Listado de Productos</h2>
<div class="action-link">
<a href="product-add.php" class="action-link">
A&ntilde;adir producto</a> </div>

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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsProductsCategory = 10;
$pageNum_rsProductsCategory = 0;
if (isset($_GET['pageNum_rsProductsCategory'])) {
  $pageNum_rsProductsCategory = $_GET['pageNum_rsProductsCategory'];
}
$startRow_rsProductsCategory = $pageNum_rsProductsCategory * $maxRows_rsProductsCategory;

mysql_select_db($database_cn, $cn);
$query_rsProductsCategory = "SELECT categories.category_name, products.* FROM products, categories WHERE products.product_category_id=categories.category_id ORDER BY products.product_name ASC";
$query_limit_rsProductsCategory = sprintf("%s LIMIT %d, %d", $query_rsProductsCategory, $startRow_rsProductsCategory, $maxRows_rsProductsCategory);
$rsProductsCategory = mysql_query($query_limit_rsProductsCategory, $cn) or die(mysql_error());
$row_rsProductsCategory = mysql_fetch_assoc($rsProductsCategory);

if (isset($_GET['totalRows_rsProductsCategory'])) {
  $totalRows_rsProductsCategory = $_GET['totalRows_rsProductsCategory'];
} else {
  $all_rsProductsCategory = mysql_query($query_rsProductsCategory);
  $totalRows_rsProductsCategory = mysql_num_rows($all_rsProductsCategory);
}
$totalPages_rsProductsCategory = ceil($totalRows_rsProductsCategory/$maxRows_rsProductsCategory)-1;

$queryString_rsProductsCategory = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsProductsCategory") == false && 
        stristr($param, "totalRows_rsProductsCategory") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsProductsCategory = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsProductsCategory = sprintf("&totalRows_rsProductsCategory=%d%s", $totalRows_rsProductsCategory, $queryString_rsProductsCategory);
?>
<div class="row list-text-title">
	<div class="col2">Name</div>
	<div class="col2">SEO</div>
	<div class="col2">Price</div>
	<div class="col2">Category</div>
	<div class="col2">Status</div>
	<div class="col2">Actions</div>
</div>

<?php $count = 1; ?>
<?php do { ?>
<?php 
if ($row_rsProductsCategory['product_status'] == 1) {
	$var_status = "Mostrar";
} else {
	$var_status = "Ocultar";	
}
?>
	<div class="row <?php if ($count > 1) { echo('oddcolor'); $count=0; } else { echo('evencolor'); } ?>">
		<div class="col2"><?php echo $row_rsProductsCategory['product_name']; ?></div>
		<div class="col2"><?php echo $row_rsProductsCategory['product_seo']; ?></div>
		<div class="col2"><?php echo $row_rsProductsCategory['product_price']; ?></div>
		<div class="col2"><?php echo $row_rsProductsCategory['category_name']; ?></div>
		<div class="col2"><?php echo $var_status; ?></div>
		<div class="col2"><a href="product-edit.php?recordID=<?php echo $row_rsProductsCategory['product_id']; ?>">Edit</a> | <a href="product-delete.php?recordID=<?php echo $row_rsProductsCategory['product_id']; ?>">Delete</a></div>
	</div>
	<hr/>
	<?php $count++; ?>
<?php } while ($row_rsProductsCategory = mysql_fetch_assoc($rsProductsCategory)); ?>
	
	
<p>
	<?php mysql_free_result($rsProductsCategory);?>
</p>
<div class="nav">
	<div class="col3 center"><a href="<?php printf("%s?pageNum_rsProductsCategory=%d%s", $currentPage, 0, $queryString_rsProductsCategory); ?>">First</a></div>
<div class="col3 center"><a href="<?php printf("%s?pageNum_rsProductsCategory=%d%s", $currentPage, max(0, $pageNum_rsProductsCategory - 1), $queryString_rsProductsCategory); ?>">Previous</a></div>
	<div class="col3 center"><a href="<?php printf("%s?pageNum_rsProductsCategory=%d%s", $currentPage, min($totalPages_rsProductsCategory, $pageNum_rsProductsCategory + 1), $queryString_rsProductsCategory); ?>">Next</a></div>
<div class="col3 center"><a href="<?php printf("%s?pageNum_rsProductsCategory=%d%s", $currentPage, $totalPages_rsProductsCategory, $queryString_rsProductsCategory); ?>">Last</a></div>
</div>
