<?php
    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">


    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <title>Dragon Collection</title>
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
    
    <!--<link rel="stylesheet" type="text/css" href="css/index.css">-->


</head>

<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="index.php" class="navbar-brand">
        <img src="immagini/img2.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
        <li class="nav-item">
            <?php
                if(basename($_SERVER['PHP_SELF']) == "index.php")
                    echo '<a href="index.php" class="nav-link active">Dragon Collection</a>';
                else
                    echo '<a href="index.php" class="nav-link">Dragon Collection</a>';
            ?>
          </li>
          <li class="nav-item">
            <?php
                if(basename($_SERVER['PHP_SELF']) == "what.php")
                    echo '<a href="what.php" class="nav-link active">What is Dragon Collection</a>';
                else
                    echo '<a href="what.php" class="nav-link">What is Dragon Collection</a>';
            ?>
          </li>
          <li class="nav-item">
            <?php
                if(basename($_SERVER['PHP_SELF']) == "contact.php")
                    echo '<a href="contact.php" class="nav-link active">Contact Us</a>';
                else
                    echo '<a href="contact.php" class="nav-link">Contact Us</a>';
            ?>
          </li>
          <li class="nav-item">
            <?php
                if(basename($_SERVER['PHP_SELF']) == "payments.php")
                    echo '<a href="payments.php" class="nav-link active">Subscribe</a>';
                else
                    echo '<a href="payments.php" class="nav-link">Subscribe</a>';
            ?>
          </li>
        </ul>

        <!-- SEARCH FORM -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <?php
            if(isset($_SESSION['usernamesession'])){
                $user=$_SESSION['usernamesession'];
                echo '<form action="php/logout.php" method="post">
                        <div class="form-group  mb-2">
                          <div class="row row justify-content-center align-self-center">
                              <div class="col-6 mx-auto col-sm-offset-1">
                                 <h4><span class="badge badge-dark">'.$user.'</span></h4>
                              </div>
                              
                              <div class="col-6 col-sm-offset-1"> <button class="btn btn-primary" type="submit" name="logout-submit">Logout</button></div>
                          </div>
                        </div>
                    </form>';
            }
            else {
                echo '<form  action="php/login.php" method="post" class="form-inline">
                        <div class="form-group  mb-2">
                            <input type="text" name="username" class="form-control" placeholder="Username">       
                        </div>          
                        <div class="form-group mx-sm-3 mb-2">          
                            <input type="password" name="password" class="form-control" placeholder="Password"> 
                            </div>
                            <button class="btn btn-dark mb-2" type="submit" name="login-submit">Login</button>
                            
                        </form>';
            }
        ?>
        </ul>
      </div>

      <!-- Right navbar links -->
    
    </div>
  </nav>




