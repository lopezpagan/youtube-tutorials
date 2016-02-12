<link rel="stylesheet" type="text/css" href="css/cart-style.css">

<?php require_once('../Connections/cn.php'); ?><?php
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

$maxRows_DetailRS1 = 10;
$pageNum_DetailRS1 = 0;
if (isset($_GET['pageNum_DetailRS1'])) {
  $pageNum_DetailRS1 = $_GET['pageNum_DetailRS1'];
}
$startRow_DetailRS1 = $pageNum_DetailRS1 * $maxRows_DetailRS1;

$colname_DetailRS1 = "-1";
if (isset($_GET['recordID'])) {
  $colname_DetailRS1 = $_GET['recordID'];
}
mysql_select_db($database_cn, $cn);
$query_DetailRS1 = sprintf("SELECT * FROM users WHERE user_id = %s ORDER BY user_firstname ASC", GetSQLValueString($colname_DetailRS1, "int"));
$query_limit_DetailRS1 = sprintf("%s LIMIT %d, %d", $query_DetailRS1, $startRow_DetailRS1, $maxRows_DetailRS1);
$DetailRS1 = mysql_query($query_limit_DetailRS1, $cn) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);

if (isset($_GET['totalRows_DetailRS1'])) {
  $totalRows_DetailRS1 = $_GET['totalRows_DetailRS1'];
} else {
  $all_DetailRS1 = mysql_query($query_DetailRS1);
  $totalRows_DetailRS1 = mysql_num_rows($all_DetailRS1);
}
$totalPages_DetailRS1 = ceil($totalRows_DetailRS1/$maxRows_DetailRS1)-1;
?>
<h2> Usuario seleccionado</h2>
<div class="action-link">
<a href="user-list.php" class="action-link">
Regresar</a> </div>
	<hr/>
<div class="form">
	<h3>Name: <span class="list-text-caption"><?php echo $row_DetailRS1['user_firstname']; ?> </span><span class="list-text-caption"><?php echo $row_DetailRS1['user_lastname']; ?></span></h3>
	
	<div class="row-item form-title">E-mail: <span class="list-text-caption"><?php echo $row_DetailRS1['user_email']; ?></span></div>
	<div class="row-item form-title">Password: <span class="list-text-caption"><?php echo $row_DetailRS1['user_password']; ?></span></div>
	<div class="row-item form-title">First login date: <span class="list-text-caption"><?php echo $row_DetailRS1['user_first_login']; ?></span></div>
	<div class="row-item form-title">Last login date: <span class="list-text-caption"><?php echo $row_DetailRS1['user_last_login']; ?></span></div>
	<div class="row-item form-title">IP Address: <span class="list-text-caption"><?php echo $row_DetailRS1['user_ip_address']; ?></span></div>
	<div class="row-item form-title">Status: <span class="list-text-caption"><?php echo $row_DetailRS1['user_status']; ?></span></div>
</div>
<?php mysql_free_result($DetailRS1); ?>