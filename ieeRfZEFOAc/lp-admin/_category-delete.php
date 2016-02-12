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

if ((isset($_GET['recordID'])) && ($_GET['recordID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM categories WHERE category_id=%s",
                       GetSQLValueString($_GET['recordID'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($deleteSQL, $cn) or die(mysql_error());

  $deleteGoTo = "category-list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
<link rel="stylesheet" type="text/css" href="css/cart-style.css">

<h2>Forma para eliminar una categor&iacute;a </h2>

<div class="action-link">
<a href="category-list.php" class="action-link">Regresar</a> </div>


<hr/>
<div class="form">
Eliminando...
</div>

