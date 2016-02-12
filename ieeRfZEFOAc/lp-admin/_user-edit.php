<?php require_once('../Connections/cn.php'); ?>
<?php require_once('../includes/functions.php'); ?>
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
  $updateSQL = sprintf("UPDATE users SET user_firstname=%s, user_lastname=%s, user_email=%s, user_password=%s, user_last_login=NOW(), user_ip_address=%s, user_status=%s WHERE user_id=%s",
                       GetSQLValueString($_POST['user_firstname'], "text"),
                       GetSQLValueString($_POST['user_lastname'], "text"),
                       GetSQLValueString($_POST['user_email'], "text"),
                       GetSQLValueString($_POST['user_password'], "text"),
                       GetSQLValueString($_POST['user_ip_address'], "text"),
                       GetSQLValueString($_POST['user_status'], "int"),
                       GetSQLValueString($_POST['user_id'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($updateSQL, $cn) or die(mysql_error());

  $updateGoTo = "user-list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$var_user_id_rsUsers = "0";
if (isset($_GET['recordID'])) {
  $var_user_id_rsUsers = $_GET['recordID'];
}
mysql_select_db($database_cn, $cn);
$query_rsUsers = sprintf("SELECT * FROM users WHERE users.user_id=%s", GetSQLValueString($var_user_id_rsUsers, "int"));
$rsUsers = mysql_query($query_rsUsers, $cn) or die(mysql_error());
$row_rsUsers = mysql_fetch_assoc($rsUsers);
$totalRows_rsUsers = mysql_num_rows($rsUsers);
?>
<link rel="stylesheet" type="text/css" href="css/cart-style.css">
<h2>Forma para modificar un usuario </h2>

<div class="action-link">
<a href="user-list.php" class="action-link">Regresar</a> </div>


<hr/>
<div class="form">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
	<div class="row-item form-title">Nombre:</div>
	<div class="row-item form-input"><input type="text" name="user_firstname" value="<?php echo htmlentities($row_rsUsers['user_firstname'], ENT_COMPAT, ''); ?>" size="32"></div>
	<div class="row-item form-title">Apellidos:</div>
	<div class="row-item form-input"><input type="text" name="user_lastname" value="<?php echo htmlentities($row_rsUsers['user_lastname'], ENT_COMPAT, ''); ?>" size="32"></div>
	<div class="row-item form-title">Email:</div>
	<div class="row-item form-input"><input type="text" name="user_email" value="<?php echo htmlentities($row_rsUsers['user_email'], ENT_COMPAT, ''); ?>" size="32"></div>
	<div class="row-item form-title">Password:</div>
	<div class="row-item form-input"><input type="password" name="user_password" value="<?php echo htmlentities($row_rsUsers['user_password'], ENT_COMPAT, ''); ?>" size="32"></div>
	<div class="row-item form-title">Direcci&oacute;n de IP:</div>
	<div class="row-item form-input"><input name="user_ip_address" type="text" value="<?php echo(get_client_ip());?>" size="32" readonly></div>
	<div class="row-item form-title">Estatus:</div>
	<div class="row-item form-input">
	<table>
		<tr>
			<td><input type="radio" name="user_status" value="1" <?php if (!(strcmp(htmlentities($row_rsUsers['user_status'], ENT_COMPAT, ''),1))) {echo "checked=\"checked\"";} ?>>
				Mostrar</td>
		</tr>
		<tr>
			<td><input type="radio" name="user_status" value="0" <?php if (!(strcmp(htmlentities($row_rsUsers['user_status'], ENT_COMPAT, ''),0))) {echo "checked=\"checked\"";} ?>>
				Ocultar</td>
		</tr>
	</table>
	</div>
	<div class="row-item right"><input type="submit" value="Guardar cambios" class="button-submit"></div>
	<input type="hidden" name="MM_update" value="form1">
	<input type="hidden" name="user_id" value="<?php echo $row_rsUsers['user_id']; ?>">
</form>
</div>
<?php
mysql_free_result($rsUsers);
?>
