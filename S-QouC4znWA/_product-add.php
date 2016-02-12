<style>
    .border-red { border: 1px solid red !important; }
    .border-silver { border: 1px solid silver !important; }
    .required { color: red }
</style>
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

//print_r($_POST);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
	
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["product_file"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["product_file"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	
	if (move_uploaded_file($_FILES["product_file"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["product_file"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
	
 // SELECT * FROM products WHERE product_name LIKE 'Custom X';
    
    if ( checkName($_POST['product_name']) ) {
        echo('<h3>Existe en la base de datos</h3>');
        
    } else {
    
        $insertSQL = sprintf("INSERT INTO products (product_name, product_seo, product_price, product_file, product_category_id, product_status) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['product_name'], "text"),
                       GetSQLValueString($_POST['product_seo'], "text"),
                       GetSQLValueString($_POST['product_price'], "double"),
                       GetSQLValueString($target_file, "text"),
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
        
    }
}

mysql_select_db($database_cn, $cn);
$query_rsCategories = "SELECT categories.category_id, categories.category_name FROM categories ORDER BY categories.category_name";
$rsCategories = mysql_query($query_rsCategories, $cn) or die(mysql_error());
$row_rsCategories = mysql_fetch_assoc($rsCategories);
$totalRows_rsCategories = mysql_num_rows($rsCategories);


function checkName($product_name_check) {
    require('../Connections/cn.php');
    
    mysql_select_db($database_cn, $cn);
    
    $qry = sprintf("SELECT products.* FROM products WHERE products.product_name LIKE '%s'", $product_name_check);
    $rs = mysql_query($qry, $cn) or die(mysql_error());
   
    $row_rsProducts = mysql_fetch_assoc($rs);
    $totalRows = mysql_num_rows($rs); 
    
    if ( $totalRows > 0 ) {
        return true;
    } else { 
        return false;
    }
}
?>
<link rel="stylesheet" type="text/css" href="css/cart-style.css">

<h2>Forma para crear un  producto nuevo</h2>

<div class="action-link">
<a href="product-list.php" class="action-link">Regresar</a> </div>

<p align="right" class="required">*Campos requeridos</p>

<hr/>
<div class="form">
<form method="post" id="form1" name="form1" action="<?php echo $editFormAction; ?>"  enctype="multipart/form-data">
	<div class="row-item form-title">Nombre del producto<span class="required">*</span>:</div>
	<div class="row-item form-input"><input type="text" id="product_name" name="product_name" value="" size="32"></div>
	<div class="row-item form-title">SEO:</div>
	<div class="row-item form-input"><input type="text" id="product_seo" name="product_seo" value="" size="32"></div>
	<div class="row-item form-title">Precio:</div>
	<div class="row-item form-input"><input type="text" id="product_price" name="product_price" value="0.00" size="32"></div>
	<div class="row-item form-title">Archivo: <span id="file_msg" class="required"></span></div>
	<div class="row-item form-input"><input type="file" id="product_file" name="product_file" value="" size="32"></div>
	<div class="row-item form-title">Categor&iacute;a:</div>
	<div class="row-item form-input">
	<select  id="product_category_id" name="product_category_id">
	    <option value="" selected="selected">Selecciona uno</option>
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
			<td><input type="radio" name="product_status" value="1" checked="checked" >
				Mostrar</td>
		</tr>
		<tr>
			<td><input type="radio" name="product_status" value="0" >
				Ocultar</td>
		</tr>
	</table>
	</div>
	<div class="row-item right">
	    <input type="button" id="button" value="Guardar producto" class="button-submit" >
    </div>
	<input type="hidden" name="MM_insert" value="form1">
</form>
</div>
<?php
mysql_free_result($rsCategories);
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#button").click(function(){
             if ( $("#product_name").val().length > 3 ) {
                 
                 $('#product_name').addClass('border-silver');
                 $('#product_name').focus(); 
                 
                 if ( $("#product_seo").val().length > 0 ) {
                     
                     $('#product_seo').addClass('border-silver');
                     $('#product_seo').focus();
                     if ( $("#product_price").val() > 10 ) {
                         
                         if ( $("#product_file").val().length > 0 ) {
                             
                             if ( $("#product_category_id").val().length > 0 ) {
                                 $('#form1').submit();
                             } else {                 
                                 alert('La categoría es requerida.');
                                 $('#product_category_id').focus();                 
                             }
                             
                         } else {                 
                                
                             $('#file_msg').html('El archivo es requerido.');
                                
                             
                         }
                         
                     } else {                 
                         $('#product_price').addClass('border-red');
                         $('#product_price').focus();                 
                     } 
                     
                 } else {                 
                     $('#product_seo').addClass('border-red');
                     $('#product_seo').focus();                 
                 }               
                 
             } else {                 
                 $('#product_name').addClass('border-red');
                 $('#product_name').focus();                 
             }
        });
    });
</script>
