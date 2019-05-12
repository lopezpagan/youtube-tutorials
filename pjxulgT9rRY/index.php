<?php        
function getTotalTime($param) {

  if ( isset($param) && !empty($param) ) {
    
    $start_date = strtotime($param[0]);
    $end_date = strtotime($param[1]);

    $total_time = ($end_date - $start_date) / 60 / 60;
    
    
    $total_time = number_format((float)$total_time, 2, '.', '');

    return $total_time;

  } else {

    return 0;

  }

}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Horas Trabajadas</title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    
    <style>
        body { 
            background-color: #444; margin: 0; padding: 0; font-family: arial;
        }
        
        .main {
            position: absolute;
            width: 100vw;
            height: 100vh;
        }
        
        .main .login__box {
            background-color: #f4f4f4;
            width: 540px;
            height: auto;
            margin-top: 100px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .login__box-title {
            text-align: center;
            padding-top: 15px;
        }
        
        .login__box-title h1 {            
            font-size: 26px;
        }
        
        .login__box-form {
            padding: 20px;
            max-width: 300px;
            margin: auto;
        }
        .form-fields {
            padding-bottom: 10px;
        }
        .form-fields label {
            width: 100%;
            font-size: 14px;
            font-weight: bold;
            color: #444;
        }
        .form-fields input[type=text], .form-fields input[type=date]  {
            width: 100%;
            height: 45px;
            border: 1px solid #e4e4e4;
            border-radius: 3px;
            font-size: 30px;
            color: #444;
        }
        
        .form-buttons {
            text-align: right;
        }
        
        .form-buttons input[type=submit] {
            background-color: #2693FF; 
            color: #fff;
            width: 150px;    
            height: 35px;
            border: 1px solid #2693FF;
            border-radius: 3px;
        }
        
      .results {
        margin: 30px 0;
        padding: 15px 0;
      }
    </style>
</head>
<body>
    <div class="main">
        
        <div class="login__box">
            <div class="login__box-title">
                <h1>Horas Trabajadas</h1>
            </div>
            <div class="login__box-form">
               <form action="" method="post">
                    <div class="form-fields">
                        <label for="start_time">Entrada:</label>
                        <input type="datetime-local" name="start_time" value="2018-07-14T13:00:00"/>
                    </div>
                    <div class="form-fields">
                        <label for="end_time">Salida:</label>
                        <input type="datetime-local" name="end_time" value="<?php echo( date('Y-m-d', time()) . 'T' . date('H:i:s', time()) ); ?>"/>                    
                    </div>
                    <div class="form-buttons">
                        <input type="submit" value="Ponchar"/>
                    </div>
                </form>
                
                <div class="results">
                  Ponchar:
                  
                  <?php
                  
                  $start_time = $_POST['start_time'];
                  $end_time = $_POST['end_time'];
                  
                  $total_time = getTotalTime( array($start_time, $end_time) );
                  
                  
                  $rate = 7;
                  
                  echo( '<br/>');
                  echo( '$ '. $rate . ' por hora');
                  echo( '<br/>');
                  echo( $total_time . ' horas');
                  echo( '<br/>');
                  echo( '$ '. $total_time * $rate . ' total');
                  
                  ?>                
                  
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>
