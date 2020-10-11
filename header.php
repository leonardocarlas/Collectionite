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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   
    <title>Collection Sight</title>
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">

    <!--  PER IL CHART  -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    
    <link rel="stylesheet" type="text/css" href="css/image.css">


</head>

<body class="hold-transition layout-top-nav" >
  
<div class="bg">  <!-- Immagine di sfondo -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

  <div class="wrapper">

    <nav class="main-header navbar navbar-expand-md navbar-light bg-light navbar-white">
      <!--<div class="container"> -->

        <a href="index.php" class="navbar-link">
          <img src="immagini/logo.png" alt="AdminLTE Logo"  width="190" height="50"> <!-- image-circle -->
        </a>
          
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> 

        <div class="collapse navbar-collapse" id="navbarSupportedContent"> 

        <ul class="navbar-nav mr-auto">

          <!--
          <li class="nav-item">
                <?php
                    /*
                    if(basename($_SERVER['PHP_SELF']) == "index.php")
                        echo '<a href="index.php" class="nav-link active">Collection Sight</a>';
                    else
                        echo '<a href="index.php" class="nav-link">Collection Sight</a>';
                    */
                ?>
            </li>
            -->

            
            <li class="nav-item">
              <?php
                  if(basename($_SERVER['PHP_SELF']) == "what.php")
                      echo '<a href="what.php" class="nav-link active">What is Collection Sight</a>';
                  else
                      echo '<a href="what.php" class="nav-link">What is Collection Sight</a>';
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

            

            <?php
              if(isset($_SESSION['usernamesession'])){
                  $user=$_SESSION['usernamesession'];
                  echo '
                  
                        <form action="php/logout.php" method="post">
                          
                            <!-- <div class="row row justify-content-center align-self-center">  -->
                            
                            <ul class="navbar-nav">
                              <li class="nav-item">
                                <div class="form-group  m-2">
                                  <h4><span class="badge badge-dark">'.$user.'</span></h4>
                                </div>
                              </li>
                              
                              <li class="nav-item">
                                <div class="form-group  m-2"> 
                                  <button class="btn btn-primary" type="submit" name="logout-submit">Logout</button>
                                </div>
                              </li>

                              </ul>  
                          
                      </form>
                          ';
              }
              else {
                  echo '
                    <ul class="navbar-nav"> 
                        <form  action="php/login.php" method="post" class="form-inline">

                          <li class="nav-item">
                            <div class="form-group m-2 ">
                                <input type="text" name="username" class="form-control" placeholder="Username">       
                            </div> 
                          </li>

                          <li class="nav-item">
                            <div class="form-group m-2">          
                                <input type="password" name="password" class="form-control" placeholder="Password"> 
                            </div>
                          </li>

                          <li class="nav-item">
                            <button class="btn btn-dark m-2" type="submit" name="login-submit">Login</button>
                          </li>

                         
                        </form>
                      </ul>';
              }
          ?>

          </ul>



      </div>
    </nav>


</body>






