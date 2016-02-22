<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <title>Listado Por Fecha</title>
	<meta name="Author" content=""/>
</head>
<body>

<form>
  <h1>Búsqueda por Fecha</h1>
    Fecha comienzo: <br/>
    <input type="text" id="start_date" name="start_date" value="09/01/2015" placeholder="mm/dd/yyyy"> 
    Fecha final:<br/>
    <input type="text" id="end_date" name="end_date" value="10/01/2015" placeholder="mm/dd/yyyy"><br/>
    Fecha:<br/>
    
    <input type="hidden" id="form_sent" name="form_sent" value="true">
    <input type="submit" id="btn_submit" value="Enviar"><br/>
    
</form>


<hr>

<?php if (isset($_GET['form_sent']) && $_GET['form_sent'] == "true") {?>

<?php include_once('connections/connect.php');?>
<?php

    $SDATE = $_GET['start_date'];
    $SSDATE = explode('/', $SDATE);
    $START_DATE = $SSDATE[2]."-".$SSDATE[0]."-".$SSDATE[1];
    echo('<h3>'.$START_DATE.'</h3>');
    
    $EDATE = $_GET['end_date'];
    $EEDATE = explode('/', $EDATE);
    $END_DATE = $EEDATE[2]."-".$EEDATE[0]."-".$EEDATE[1];
    echo('<h3>'.$END_DATE.'</h3>');
    
    
    //SELECT * FROM test WHERE course_date BETWEEN '2015-01-09' AND '2015-10-01'
    
  $strsql = "SELECT * FROM backup WHERE course_date BETWEEN '$START_DATE' AND '$END_DATE'";


  $rs = mysql_query($strsql) or die(mysql_error());
  $row = mysql_fetch_assoc($rs);
  $total_rows = mysql_num_rows($rs);

  //print_r($row);
?>


<table width="800" border="0" cellspacing="0" cellpadding="2">
    <tr>
        <td>Id</td>
        <td>Course</td>
        <td>Date</td>
    </tr>

<?php if ($total_rows > 0) {
        do {
?>
    <tr>
        <td><?php echo($row['id']); ?></td>
        <td><?php echo($row['course']); ?></td>
        <td><?php echo($row['course_date']); ?></td>
    </tr>
<?php
        } while ( $row = mysql_fetch_assoc($rs) );
        mysql_free_result($rs);
    } else {
?>
    <tr>
        <td colspan="3">No data found.</td>
    </tr>

<?php } ?>
</table>
<?php } ?>

</body>
</html>
