<?php 
if (isset($_GET['action'])) { 

    include_once('connections/connect.php');

    $strsql = "SELECT * FROM backup WHERE id=".$_GET['id'];
    $rs = mysql_query($strsql) or die(mysql_error());
    $row = mysql_fetch_assoc($rs);
    $total_rows = mysql_num_rows($rs);    
    
} 

?>

<form>
  <h1>Entra tu Id:</h1>
    Id: <br/>
    <input type="text" id="id" name="id" value="<?php echo($row['id']); ?>"> <input type="submit" id="btn_submit" value="Enviar"><br/>
    Curso:<br/>
    <input type="text" id="curso" name="curso" value="<?php echo($row['course']); ?>"><br/>
    Fecha:<br/>
    <input type="text" id="fecha" name="fecha" value="<?php echo($row['course_date']); ?>"><br/><br/>
    <input type="hidden" id="action" name="action" value="sent">
    
</form>




<hr>
<?php include_once('connections/connect.php');?>
<?php

  $strsql = "SELECT * FROM backup ";


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
