<?php 
print_r($_GET);

$pueblos1 = array('Dorado', 'Bayamón', 'San Juan');
$pueblos2 = array('Ponce', 'Isabela', 'Fajardo');

//print_r($pueblos1);
//print_r($pueblos2);
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <title>Nivel Básico</title>
	<meta name="Author" content=""/>
	<style>
        select { width: 300px; }
        
    
    </style>
</head>
<body>

<h1>Nivel Básico</h1>
<form action="index1.php" method="get">
<p> Pueblos 1: 
    <select id="pueblos-1" name="pueblos-1">
       <?php foreach($pueblos1 as $p) { ?>
            <option><?php echo($p);?></option>
        <?php } ?>
    </select>
</p>
<p>Pueblos 2:
    <select id="pueblos-2" name="pueblos-2">
       <?php for ($i=0; $i<count($pueblos2); $i++) { ?>
        <option value="<?php echo($i);?>"><?php echo($pueblos2[$i]);?></option>
        <?php } ?>
    </select>
</p>
<p> <input type="submit" value="Enviar"></p>
</form>
</body>
</html>
