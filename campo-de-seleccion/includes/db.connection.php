<?php
    // DB Connection
    $hostname_strcn = "localhost:8889";
    $database_strcn = "test";
    $username_strcn = "root";
    $password_strcn = "root";

    // Create connection
    $cn = mysqli_connect($hostname_strcn, $username_strcn, $password_strcn, $database_strcn);
    
    // Check connection
    if ( mysqli_connect_errno() ) {
        echo "Connection failed: " . mysqli_connect_error();
    }

    $state = "testing";

    if( $state == "local" || $state == "testing" ) {
     ini_set( "display_errors", "1" );
     error_reporting( E_ALL & ~E_NOTICE );
    } else {
     error_reporting( 0 );
    }
?>