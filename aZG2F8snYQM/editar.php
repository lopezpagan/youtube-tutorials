<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>3 Col Portfolio - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/css/3-col-portfolio.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Editar de Producto
                    <small><a href="index.php">< Regresar</a></small>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="container" style="margin-bottom: 30px;">
                <form method="GET" action="index.php">
                    <input type="text" id="product_name" name="product_name" value=""/> 
                    <input type="submit" id="btn_enviar" name="btn_enviar" value="Enviar"/>
                </form>
            </div>
            
        </div>
        
        <div class="row">
            
    <?php
        //Conectarse a la base de datos
            $hostname_strcn = "localhost:8888";
            $database_strcn = "storedb";
            $username_strcn = "root";
            $password_strcn = "root";
            mysql_connect($hostname_strcn, $username_strcn, $password_strcn) or die(mysql_error());
            mysql_select_db($database_strcn) or die(mysql_error());

            $product_id = $_GET['product_id'];

            $strsql = "SELECT p.product_id, p.product_name, c.category_name, p.product_seo, p.product_price FROM products p, categories c WHERE p.product_category_id = c.category_id AND p.product_id = $product_id ORDER BY p.product_price DESC";

            $rs = mysql_query($strsql);
            $row = mysql_fetch_assoc($rs);
            $total_rows = mysql_num_rows($rs);

        ?>

        <?php do { ?>
            <div class="col-md-4 portfolio-item">
                    <a href="#">
                        <img class="img-responsive" src="http://placehold.it/700x400" alt="">
                    </a>
                    <h3>
                        <a href="editar.php?product_id=<?php echo($row['product_id']);?>"><?php echo($row['product_name']);?></a>
                    </h3>
                    <p>
                    Id: <?php echo($row['product_id']);?><br/>
                    Category: <?php echo($row['category_name']);?> <br/>
                    SEO: <?php echo($row['product_seo']);?> <br/>
                    Price: $<?php echo($row['product_price']);?> <br/>                    
                    </p>
                </div>

        <?php } while ($row = mysql_fetch_assoc($rs)); ?>
            
        </div>


        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>
