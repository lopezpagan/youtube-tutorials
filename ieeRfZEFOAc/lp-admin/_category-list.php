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

$pageNum_rsCategories = 0;
if (isset($_GET['pageNum_rsCategories'])) {
  $pageNum_rsCategories = $_GET['pageNum_rsCategories'];
}
$startRow_rsCategories = $pageNum_rsCategories * $maxRows_rsCategories;

mysql_select_db($database_cn, $cn);
$query_rsCategories = "SELECT * FROM categories ORDER BY category_name ASC";
$query_limit_rsCategories = sprintf("%s LIMIT %d, %d", $query_rsCategories, $startRow_rsCategories, $maxRows_rsCategories);
$rsCategories = mysql_query($query_limit_rsCategories, $cn) or die(mysql_error());
$row_rsCategories = mysql_fetch_assoc($rsCategories);

if (isset($_GET['totalRows_rsCategories'])) {
  $totalRows_rsCategories = $_GET['totalRows_rsCategories'];
} else {
  $all_rsCategories = mysql_query($query_rsCategories);
  $totalRows_rsCategories = mysql_num_rows($all_rsCategories);
}
$totalPages_rsCategories = ceil($totalRows_rsCategories/$maxRows_rsCategories)-1;
$query_rsCategories = "SELECT * FROM categories ORDER BY category_name ASC";
$rsCategories = mysql_query($query_rsCategories, $cn) or die(mysql_error());
$row_rsCategories = mysql_fetch_assoc($rsCategories);
$totalRows_rsCategories = mysql_num_rows($rsCategories);

?>
<link rel="stylesheet" type="text/css" href="css/cart-style.css">
<h2>Listado de Categor&iacute;as</h2>

<div class="action-link">
<a href="category-add.php" class="action-link">
A&ntilde;adir categor&iacute;a</a> </div>
<div class="row list-text-title">
	<div class="col4">Name</div>
	<div class="col4">Status</div>
	<div class="col4">Actions</div>
</div>
<?php $count = 1; ?>
<?php do { ?>
<?php 
if ($row_rsCategories['category_status'] == 1) {
	$var_status = "Mostrar";
} else {
	$var_status = "Ocultar";	
}
?>
	<div class="row <?php if ($count > 1) { echo('oddcolor'); } else { echo('evencolor'); } ?>">
		<div class="col4"><?php echo $row_rsCategories['category_name']; ?></div>
		<div class="col4"><?php echo $var_status; ?></div>
		<div class="col4"><a href="category-edit.php?recordID=<?php echo $row_rsCategories['category_id']; ?>">Edit</a> | <a href="category-delete.php?recordID=<?php echo $row_rsCategories['category_id']; ?>">Delete</a></div>
	</div>
	<div class="row list-text-desc <?php if ($count > 1) { echo('oddcolor'); $count=0; } else { echo('evencolor'); } ?>">
		<div class="col12 list-text-desc"><?php echo $row_rsCategories['category_desc']; ?></div>
	</div>
	<?php $count++; ?>
	<?php } while ($row_rsCategories = mysql_fetch_assoc($rsCategories)); ?>
	
<?php mysql_free_result($rsCategories);?>
