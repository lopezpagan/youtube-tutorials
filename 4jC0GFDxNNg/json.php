<?php 

function get_countries() {
include_once('includes/db.connection.php'); 
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $strsql = "SELECT * FROM countries ORDER BY country ASC";
        $rs = mysqli_query($cn, $strsql);
        $total_rows = $rs->num_rows;

        if ($total_rows > 0 ) {
            while ($row = $rs->fetch_object()){
                $data[] = $row;
            }

            //print_r($data);
            echo( json_encode($data) );
        } 
    }
}

function get_cities() {
include_once('includes/db.connection.php');
    
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Error: Ups! Hubo problemas con la conexión.  Favor de intentar nuevamente.";
    } else {
        $strsql = "SELECT * FROM cities ORDER BY cities ASC";
        $rs = mysqli_query($cn, $strsql);
        $total_rows = $rs->num_rows;

        if ($total_rows > 0 ) {
            while ($row = $rs->fetch_object()){
                $data[] = $row;
            }

            //print_r($data);
            echo( json_encode($data) );
        } 
    }

}

$action = $_GET['action'];

switch($action) {
    case 1: 
        get_countries();
        
        break;
    case 2: 
        get_cities();
        
        break;
        
}

?>