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

$maxRows_rsUsers = 10;
$pageNum_rsUsers = 0;
if (isset($_GET['pageNum_rsUsers'])) {
  $pageNum_rsUsers = $_GET['pageNum_rsUsers'];
}
$startRow_rsUsers = $pageNum_rsUsers * $maxRows_rsUsers;

mysql_select_db($database_cn, $cn);
$query_rsUsers = "SELECT * FROM users ORDER BY user_firstname ASC";
$query_limit_rsUsers = sprintf("%s LIMIT %d, %d", $query_rsUsers, $startRow_rsUsers, $maxRows_rsUsers);
$rsUsers = mysql_query($query_limit_rsUsers, $cn) or die(mysql_error());
$row_rsUsers = mysql_fetch_assoc($rsUsers);

if (isset($_GET['totalRows_rsUsers'])) {
  $totalRows_rsUsers = $_GET['totalRows_rsUsers'];
} else {
  $all_rsUsers = mysql_query($query_rsUsers);
  $totalRows_rsUsers = mysql_num_rows($all_rsUsers);
}
$totalPages_rsUsers = ceil($totalRows_rsUsers/$maxRows_rsUsers)-1;

$queryString_rsUsers = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsUsers") == false && 
        stristr($param, "totalRows_rsUsers") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsUsers = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsUsers = sprintf("&totalRows_rsUsers=%d%s", $totalRows_rsUsers, $queryString_rsUsers);

?>
<link rel="stylesheet" type="text/css" href="css/cart-style.css">

<h2>Listado de Usuarios</h2>
<div class="action-link">
<a href="user-add.php" class="action-link">
A&ntilde;adir usuario</a> </div>

<div class="row list-text-title">
	<div class="col2">Nombre</div>
	<div class="col2">Email</div>
	<div class="col2">IP</div>
	<div class="col2">Estatus</div>
	<div class="col2">&Uacute;ltimo Acceso </div>
	<div class="col2"></div>
</div>
<?php $count = 1; ?>
<?php do { ?>

<?php 
if ($row_rsUsers['user_status'] == 1) {
	$var_status = "Mostrar";
} else {
	$var_status = "Ocultar";	
}
?>

	<div class="row <?php if ($count > 1) { echo('oddcolor'); $count=0; } else { echo('evencolor'); } ?>">
		<div class="col2"><a href="user-view.php?recordID=<?php echo $row_rsUsers['user_id']; ?>"><?php echo $row_rsUsers['user_firstname']; ?> <?php echo $row_rsUsers['user_lastname']; ?></a></div>
		<div class="col2"><?php echo $row_rsUsers['user_email']; ?></div>
		<div class="col2"><?php echo $row_rsUsers['user_ip_address']; ?></div>
		<div class="col2"><?php echo $var_status; ?></div>
		<div class="col2"><?php echo $row_rsUsers['user_last_login']; ?></div>
		<div class="col2">
		<a href="user-edit.php?recordID=<?php echo $row_rsUsers['user_id']; ?>">Modificar</a> | <a href="user-delete.php?recordID=<?php echo $row_rsUsers['user_id']; ?>">Remover</a></div>
	</div>
	<?php $count++; ?>
	<?php } while ($row_rsUsers = mysql_fetch_assoc($rsUsers)); ?>

<div class="nav">
	<div class="col3 center"><a href="<?php printf("%s?pageNum_rsUsers=%d%s", $currentPage, 0, $queryString_rsUsers); ?>">Primero</a></div>
<div class="col3 center"><a href="<?php printf("%s?pageNum_rsUsers=%d%s", $currentPage, max(0, $pageNum_rsUsers - 1), $queryString_rsUsers); ?>">Anterior</a></div>
	<div class="col3 center"><a href="<?php printf("%s?pageNum_rsUsers=%d%s", $currentPage, min($totalPages_rsUsers, $pageNum_rsUsers + 1), $queryString_rsUsers); ?>">Pr&oacute;ximo</a></div>
<div class="col3 center"><a href="<?php printf("%s?pageNum_rsUsers=%d%s", $currentPage, $totalPages_rsUsers, $queryString_rsUsers); ?>">&Uacute;ltimo</a></div>
</div>

<?php mysql_free_result($rsUsers);?>

<div class="row">
Registros <?php echo ($startRow_rsUsers + 1) ?> a <?php echo min($startRow_rsUsers + $maxRows_rsUsers, $totalRows_rsUsers) ?> de <?php echo $totalRows_rsUsers ?>
</div>
