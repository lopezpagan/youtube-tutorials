<?php 
print_r($_GET);

$pueblos1 = array('Selecciona', 'Dorado', 'Bayamón', 'San Juan', 'Ponce', 'Isabela', 'Fajardo');

//print_r($pueblos1);
//print_r($pueblos2);
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <title>Nivel Intermedio</title>
	<meta name="Author" content=""/>
	<style>
        select { width: 300px; }
        
    
    </style>
</head>
<body>

<h1>Nivel Intermedio</h1>
<form action="index2.php" method="get">
<p> Pueblos 1: 
    <select id="pueblos-1" name="pueblos-1" onchange="selectPueblos()">
       <?php for ($i=0; $i<count($pueblos1); $i++) { ?>
        <option value="<?php echo($i);?>"><?php echo($pueblos1[$i]);?></option>
        <?php } ?>
    </select>
</p>
<p>Pueblos 2:
    <select id="barrios" name="barrios">
       <option>Selecciona un pueblo.</option>
    </select>
</p>
<p> <input type="submit" value="Enviar"></p>
</form>


<script>
    
    function selectPueblos() {
        var pueblo = document.getElementById('pueblos-1');
        //console.log('Seleccionaste: '+pueblo.value);
        
        var results = getBarrios(pueblo.value);
        
        if (results.length > 0 && results != undefined) {  
            console.log(results);
            document.getElementById('barrios').innerHTML = results;
        } else {
            console.log('No hay nada');
        }
    }
    
    function getBarrios(param) {
        var results = '';
        
        if (param == 1) {
            results = '<option>Mameyal</option>';
            results += '<option>San Antonio</option>';
        } else if (param == 2) {
            results = '<option>Sierra Linda</option>';
            results += '<option>Santa Rosa</option>';            
        } else {
            results = '<option>NO HAY NADA.</option>';          
        }
        
        return results; 
    }
</script>
</body>
</html>
