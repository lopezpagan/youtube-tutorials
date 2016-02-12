<?php 
/*if (isset($_GET['action']) && $_GET['action'] == "delete") { 

include_once('connections/connect.php');
$strsql1 = "INSERT into backup (id, course, course_date) values(".$_GET['id'].", '".$_GET['course']."', '".$_GET['course_date']."' );";
$added = mysql_query($strsql1) or die(mysql_error());
        
echo('Added to backup ('.$_GET['id'].')<br/>');     
    
$strsql2 = "DELETE FROM test WHERE id=".$_GET['id'];
$removed = mysql_query($strsql2) or die(mysql_error());
echo('DELETED from test ('.$_GET['id'].')');                                                                       
 } */

if (isset($_GET['action']) && $_GET['action'] == "delete") { 

include_once('connections/connect.php');

$strsql = "SELECT * FROM test WHERE id=".$_GET['id'];
$rs = mysql_query($strsql) or die(mysql_error());
$row = mysql_fetch_assoc($rs);
$total_rows = mysql_num_rows($rs);
    
    if ($total_rows > 0) {        
        $strsql1 = "INSERT into backup (id, course, course_date) values(".$row['id'].", '".$row['course']."', '".$row['course_date']."' );";
        $added = mysql_query($strsql1) or die(mysql_error());        
        echo('ADDED to backup ('.$row['id'].')<br/>');     


        $strsql2 = "DELETE FROM test WHERE id=".$row['id'];
        $removed = mysql_query($strsql2) or die(mysql_error());
        echo('DELETED from test ('.$_GET['id'].')'); 
    }        
    
    
} 

?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista Por Fecha</title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
</head>
<body>

<form>
  <h1>Búsqueda por Fecha</h1>
    Fecha comienzo:<br/>
    <input type="text" id="start_date" name="start_date" value="09/01/2015"><br/>
    Fecha final:<br/>
    <input type="text" id="end_date" name="end_date" value="11/01/2015"><br/><br/>
    <input type="hidden" id="form_sent" name="form_sent" value="true">
    <input type="submit" id="btn_submit" value="Enviar">
</form>
<hr>

<h3>Añadir un nuevo record</h3>

<form>
    Nombre del curso:<br/>
    <input type="text" id="id" name="id" value="0"><br/>
    <input type="text" id="course" name="course" value=""><br/>
    <input type="hidden" id="form1_sent" name="form1_sent" value="true">
    <input type="submit" id="btn_submit" value="Guardar">
</form>
<hr>

<?php 
if (isset($_GET['form1_sent']) && $_GET['form1_sent'] == "true") { 

include_once('connections/connect.php');
$strsql1 = "INSERT into test (id, course, course_date) values(".$_GET['id'].", '".$_GET['course']."', NOW() );";

$result = mysql_query($strsql1) or die(mysql_error());

echo('OK ('.$result.')');                                                                       
 } 
?>

<?php 
if (isset($_GET['form1_sent']) && $_GET['form1_sent'] == "true") { 

include_once('connections/connect.php');
$strsql1 = "INSERT into test (id, course, course_date) values(".$_GET['id'].", '".$_GET['course']."', NOW() );";

$result = mysql_query($strsql1) or die(mysql_error());

echo('OK ('.$result.')');                                                                       
 } 
?>

<?php if (isset($_GET['form_sent']) && $_GET['form_sent'] == "true") { ?>

<?php include_once('connections/connect.php');?>
<?php
  $SDATE = $_GET['start_date'];
  $SSDATE = explode('/', $SDATE); // 09/01/2015 09, 01, 2015
  $START_DATE = $SSDATE[2]."-".$SSDATE[0]."-".$SSDATE[1];
  //echo('<h3>'.$START_DATE.'</h3>');


  $EDATE = $_GET['end_date'];
  $EEDATE = explode('/', $EDATE);
  $END_DATE = $EEDATE[2]."-".$EEDATE[0]."-".$EEDATE[1];
  //echo('<h3>'.$END_DATE.'</h3>');


  //SELECT * FROM test WHERE course_date BETWEEN '2015-09-01' AND '2015-09-09'

  $strsql = "SELECT * FROM test WHERE course_date BETWEEN '$START_DATE' AND '$END_DATE'";

  //echo('<h3>'.$strsql.'</h3>');


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
           <!-- <td><a href="?action=delete&id=<?php echo($row['id']);?>&course=<?php echo($row['course']);?>&course_date=<?php echo($row['course_date']); ?>">Borrar</a></td>-->
            <td><a href="?action=delete&id=<?php echo($row['id']);?>">Borrar</a></td>
        </tr>
    <?php
            } while ( $row = mysql_fetch_assoc($rs) );
            mysql_free_result($rs);
        } else {
    ?>
        <tr>
            <td colspan="11">No data found.</td>
        </tr>

    <?php } ?>
    </table>

<?php }?>

</body>
</html>
