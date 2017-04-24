<?php include_once('../includes/db.connection.php'); ?>

<?php 
// Check connection
if ( mysqli_connect_errno() ) {
    echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
} else {
    $strsql = "SELECT * FROM countries ORDER BY country ASC";
    $rs = mysqli_query($cn, $strsql);
    $total_rows = $rs->num_rows;
    
    if ($total_rows > 0 ) {
        while ($row = $rs->fetch_object()){
            $pueblos1[] = $row;
        }
    }
}


if (isset($_POST['pueblos-1'])) {
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $strsql = "SELECT * FROM cities WHERE country_id = ".intval($_POST['pueblos-1'])." ORDER BY cities ASC";
        //print_r($strsql);
        $rs = mysqli_query($cn, $strsql);
        $total_rows = $rs->num_rows;

        if ($total_rows > 0 ) {
            while ($row = $rs->fetch_object()){
                $pueblos2[] = $row;
            }
        }
    }
    
    print_r($_POST);
    print_r($pueblos2);
}

?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <title>Nivel Avanzado</title>
	<meta name="Author" content=""/>
	<style>
        select { width: 300px; }
        
    
    </style>
</head>
<body>

<h1>Nivel Avanzado</h1>

<form id="form1" name="form1" action="index5.php" method="post">
<p> Pueblos 1: 
    <select id="pueblos-1" name="pueblos-1" onchange="selectPueblos()">
       <?php foreach ($pueblos1 as $id=>$key) { ?>
        <option value="<?php echo($key->country_id);?>" <?php if ($_POST['pueblos-1'] == $key->country_id) {?> selected="selected" <?php } ?>><?php echo($key->country);?></option>
        <?php } ?>
    </select>
</p>
</form>

<p>Pueblos 2:
    <select id="barrios" name="barrios">
       <option value="0">Selecciona una ciudad.</option>       
       <?php foreach ($pueblos2 as $id=>$key) { ?>
        <option value="<?php echo($key->city_id);?>"><?php echo($key->cities);?></option>
        <?php } ?>
    </select>
</p>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    
    function selectPueblos() {
        var pueblo = document.getElementById('pueblos-1');  
        
        $('#form1').submit();
    }
</script>
</body>
</html>
