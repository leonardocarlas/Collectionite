<?php
    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M5MXNZYXBD"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-M5MXNZYXBD');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- data tables prove -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

    <!-- awesome font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   
    <title>Collection Sight</title>
    <link rel="icon" type="image/x-icon" href="immagini/icona.png">

    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">

    <!--  PER IL CHART  -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>     <!-- AJAX   -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <!-- Google adsense -->
    <script data-ad-client="ca-pub-1305697659771768" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    
    <!-- W3 scchool completition % bar> -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
    <link rel="stylesheet" href="css/cinema.css">
    
    <link rel="stylesheet" type="text/css" href="css/home.css">


</head>

<body class="hold-transition layout-top-nav" style="max-width:100%; overflow-x:hidden;">
  
<div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <!--NON SO SE SERVANO-->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

    <!-- CORE DATATABLE -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

  <div class="wrapper">



  



    <nav class="main-header navbar navbar-expand-md" style = "background:transparent; background-color:transparent;">
      <!--<div class="container"> -->

        <a href="index.php" class="navbar-link">
          <img src="immagini/logopersito.png" alt="AdminLTE Logo"  width="200" height="60"> 
        </a>
          
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> 

        <div class="collapse navbar-collapse" id="navbarSupportedContent"> 

        <ul class="navbar-nav mr-auto">

          
          <li class="nav-item">
                <?php
                    if(basename($_SERVER['PHP_SELF']) == "home.php")
                        echo '<a href="home.php" class="nav-link active"> <p><span style="color: #5401a7;"> My Collection </span></p></a>';
                    else
                        echo '<a href="home.php" class="nav-link"><p><span style="color: #5401a7;"> My Collection </span></p></a>';
                ?>
          </li>

          <li class="nav-item">
              <?php
                  if(basename($_SERVER['PHP_SELF']) == "wall_street.php")
                      echo '<a href="wall_street.php" class="nav-link active"><p><span style="color: #5401a7;"> Wall Street </span></p></a>';
                  else
                      echo '<a href="wall_street.php" class="nav-link"> <p><span style="color: #5401a7;"> Wall Street </span></p> </a>';
              ?>
          </li>
          <li class="nav-item">
              <?php 
                  if(basename($_SERVER['PHP_SELF']) == "reddsight.php")
                      echo '<a href="reddsight.php" class="nav-link active"><p><span style="color: #5401a7;"> Redd Sight </span></p></a>';
                  else
                      echo '<a href="reddsight.php" class="nav-link"><p><span style="color: #5401a7;"> Redd Sight  </span></p></a>';
              ?>
          </li>
          <li class="nav-item">
              <?php 
                  if(basename($_SERVER['PHP_SELF']) == "wanted_list.php")
                      echo '<a href="wanted_list.php" class="nav-link active"><p><span style="color: #5401a7;"> Wanted List </span></p></a>';
                  else
                      echo '<a href="wanted_list.php" class="nav-link"><p><span style="color: #5401a7;"> Wanted List </span></p></a>';
              ?>
          </li>
          <li class="nav-item">
              <?php 
                  if(basename($_SERVER['PHP_SELF']) == "cinema.php")
                      echo '<a href="cinema.php" class="nav-link active"><p><span style="color: #5401a7;"> Cinema Mode </span></p></a>';
                  else
                      echo '<a href="cinema.php" class="nav-link"><p><span style="color: #5401a7;"> Cinema Mode </span></p></a>';
              ?>
          </li>
          <li class="nav-item">
              <?php 
                  if(basename($_SERVER['PHP_SELF']) == "articles.php")
                      echo '<a href="articles.php" class="nav-link active"><p><span style="color: #5401a7;"> Articles </span></p></a>';
                  else
                      echo '<a href="articles.php" class="nav-link"><p><span style="color: #5401a7;"> Articles </span></p></a>';
              ?>
          </li>
          

          <li class="nav-item">
              <?php
                  if(basename($_SERVER['PHP_SELF']) == "payments.php")
                      echo '<a href="payments.php" class="nav-link active"><p><span style="color: #5401a7;"> Dona </span></p></a>';
                  else
                      echo '<a href="payments.php" class="nav-link"><p><span style="color: #5401a7;"> Dona </span></p></a>';
              ?>
          </li>
            

          </ul>

            

            <?php
              if(isset($_SESSION['usernamesession'])){
                  
                  echo '
                  
                        <form action="php/logout.php" method="post">
                          
                            <!-- <div class="row row justify-content-center align-self-center">  -->
                            
                            <ul class="navbar-nav">
                              
                              <li class="nav-item">
                                <div class="form-group  m-2">
                                  <h4><a href="user.php?U='.$_SESSION['idusersession'].' "><u>'.$_SESSION['usernamesession'].'</u></a></h4>
                                </div>
                              </li>
                              
                              <li class="nav-item">
                                <div class="form-group  m-2"> 
                                  <button class="btn text-white" type="submit" style="background-color: #5401a7;" name="logout-submit">Logout</button>
                                </div>
                              </li>
                              </ul>  
                          
                      </form>
                          ';
              }
              else {
                  echo '
                    <ul class="navbar-nav">
                        <!--
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
                          -->

                          <li class="nav-item">
                            <a href = "get_started.php?Action=Register" class="btn m-2 text-dark" >Register</a>
                          </li>
                          <li class="nav-item">
                            <a href = "get_started.php?Action=Login" class="btn m-2 text-white" style="background-color: #5401a7;"> Login </a>
                          </li>

                        <!--
                        </form>
                            -->
                      </ul>';
              }
          ?>

          </ul>



      </div>
    </nav>


</body>
