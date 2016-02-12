<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Listado</title>
</head>
<body>
<form method="GET" action="listado.php">
	<input type="text" id="product_name" name="product_name" value=""/> 
	<input type="submit" id="btn_enviar" name="btn_enviar" value="Enviar"/>
</form>
<?php
//Conectarse a la base de datos
	$hostname_strcn = "localhost:8888";
	$database_strcn = "storedb";
	$username_strcn = "root";
	$password_strcn = "root";
	mysql_connect($hostname_strcn, $username_strcn, $password_strcn) or die(mysql_error());
	mysql_select_db($database_strcn) or die(mysql_error());

	$product_name = $_GET['product_name'];

	$strsql = "SELECT p.product_id, p.product_name, c.category_name, p.product_seo, p.product_price FROM products p, categories c WHERE p.product_category_id = c.category_id AND p.product_name LIKE '$product_name%' ORDER BY p.product_price DESC";

	$rs = mysql_query($strsql);
	$row = mysql_fetch_assoc($rs);
	$total_rows = mysql_num_rows($rs);

?>

<?php do { ?>
	<div style="float: left; padding: 20px; width: 200px; border: 1px solid #333;">
	Id: <?php echo($row['product_id']);?> <br/>
	Product: <a href="editar.php?product_id=<?php echo($row['product_id']);?>"><?php echo($row['product_name']);?></a> <br/>
	Category: <?php echo($row['category_name']);?> <br/>
	SEO: <?php echo($row['product_seo']);?> <br/>
	Price: $<?php echo($row['product_price']);?> <br/><br/>
	</div>

<?php } while ($row = mysql_fetch_assoc($rs)); ?>
</body>
</html>
