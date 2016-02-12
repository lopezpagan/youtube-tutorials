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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO users (user_firstname, user_lastname, user_password, user_first_login, user_last_login, user_ip_address, user_email, user_status) VALUES (%s, %s, %s, NOW(), NOW(), %s, %s, %s)",
                       GetSQLValueString($_POST['user_firstname'], "text"),
                       GetSQLValueString($_POST['user_lastname'], "text"),
                       GetSQLValueString($_POST['user_password'], "text"),
                       GetSQLValueString($_POST['user_ip_address'], "text"),
                       GetSQLValueString($_POST['user_email'], "text"),
                       GetSQLValueString($_POST['user_status'], "int"));

  mysql_select_db($database_cn, $cn);
  $Result1 = mysql_query($insertSQL, $cn) or die(mysql_error());

  $insertGoTo = "user-list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<link rel="stylesheet" type="text/css" href="css/cart-style.css">

<h2>Forma para crear un usuario nuevo</h2>

<div class="action-link">
<a href="user-list.php" class="action-link">Regresar</a> </div>


<hr/>
<div class="form">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
	<div class="row-item form-title">Nombre:</div>
	<div class="row-item form-input"><input type="text" name="user_firstname" value="" size="32"></div>
	<div class="row-item form-title">Apellidos:</div>
	<div class="row-item form-input"><input type="text" name="user_lastname" value="" size="32"></div>
	<div class="row-item form-title">Email:</div>
	<div class="row-item form-input"><input type="text" name="user_email" value="" size="32"></div>
	<div class="row-item form-title">Password:</div>
	<div class="row-item form-input"><input type="password" name="user_password" value="" size="32"></div>
	<div class="row-item form-title">Direcci&oacute;n de IP:</div>
	<div class="row-item form-input"><input name="user_ip_address" type="text" value="<?php echo(get_client_ip());?>" size="32" readonly></div>
	<div class="row-item form-title">Estatus:</div>
	<div class="row-item form-input">
	<table>
		<tr>
			<td><input type="radio" name="user_status" value="1" >
				Mostrar</td>
		</tr>
		<tr>
			<td><input type="radio" name="user_status" value="0" >
				Ocultar</td>
		</tr>
	</table>
	</div>
	<div class="row-item right"><input type="submit" value="Guardar usuario" class="button-submit"></div>
	<input type="hidden" name="MM_insert" value="form1">
</form>
</div>