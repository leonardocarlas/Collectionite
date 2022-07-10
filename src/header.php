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



  



    <nav class="main-header navbar navbar-expand-md" style="background-color: #5401a7;">
      <!--<div class="container"> -->

        <a href="index.php" class="navbar-link">
          <img src="immagini/prova2.png" alt="Logo Collection Sight"  style="max-width:80px; max-height:80px;"> 
          <!--<img src="immagini/scritta.png" alt="Scritta"  style="max-width:180px; max-height:180px;">-->
        </a>
          
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> 

        <div class="collapse navbar-collapse" id="navbarSupportedContent"> 

        <ul class="navbar-nav mr-auto">


          <li class="nav-item">
                <?php
                    if(basename($_SERVER['PHP_SELF']) == "home.php")
                        echo '<a href="home.php" class="nav-link active text-white"> My Collection</a>';
                    else
                        echo '<a  href="home.php" class="nav-link text-white"> My Collection </a>';
                ?>
          </li>

          <li class="nav-item">
              <?php
                  if(basename($_SERVER['PHP_SELF']) == "wall_street.php")
                      echo '<a href="wall_street.php" class="nav-link active text-white"> Wall Street </a>';
                  else
                      echo '<a href="wall_street.php" class="nav-link text-white">  Wall Street  </a>';
              ?>
          </li>
          <li class="nav-item">
              <?php 
                  if(basename($_SERVER['PHP_SELF']) == "reddsight.php")
                      echo '<a href="reddsight.php" class="nav-link active text-white"> Redd Sight </a>';
                  else
                      echo '<a href="reddsight.php" class="nav-link text-white"> Redd Sight  </a>';
              ?>
          </li>
          <li class="nav-item">
              <?php 
                  if(basename($_SERVER['PHP_SELF']) == "wanted_list.php")
                      echo '<a href="wanted_list.php" class="nav-link active text-white"> Wanted List </a>';
                  else
                      echo '<a href="wanted_list.php" class="nav-link text-white"> Wanted List </a>';
              ?>
          </li>
          <li class="nav-item">
              <?php 
                  if(basename($_SERVER['PHP_SELF']) == "cinema.php")
                      echo '<a href="cinema.php" class="nav-link active text-white"> Cinema Mode </a>';
                  else
                      echo '<a href="cinema.php" class="nav-link text-white"> Cinema Mode </a>';
              ?>
          </li>
          <li class="nav-item">
              <?php 
                  if(basename($_SERVER['PHP_SELF']) == "articles.php")
                      echo '<a href="articles.php" class="nav-link active text-white"> Articles </a>';
                  else
                      echo '<a href="articles.php" class="nav-link text-white"> Articles </a>';
              ?>
          </li>
          

          <li class="nav-item">
              <?php
                  if(basename($_SERVER['PHP_SELF']) == "payments.php")
                      echo '<a href="payments.php" class="nav-link active text-white"> Dona </a>';
                  else
                      echo '<a href="payments.php" class="nav-link text-white"> Dona </a>';
              ?>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">IT</a>
            <ul class="dropdown-menu" aria-labelledby="dropdown1">
                <li class="dropdown-item" href="#"><a>FR</a></li>
                <li class="dropdown-item" href="#"><a>DE</a></li>
                <li class="dropdown-item" href="#"><a>ES</a></li>
                <li class="dropdown-item" href="#"><a>EN</a></li>
                
            </ul>
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
                                    <h4><a  class = "text-white" href="user.php?U='.$_SESSION['idusersession'].' "><u>'.$_SESSION['usernamesession'].'</u></a></h4>
                                    </div>
                                </li>
                                
                                <li class="nav-item">
                                    <div class="form-group  m-2"> 
                                    <button  type="submit" style="background-color: #FFFFFF;" class="btn text-dark" name="logout-submit">Logout</button>
                                    </div>
                                </li>

                            </ul>  
                          
                      </form>
                          ';
              }
              else {
                  echo '
                    <ul class="navbar-nav">
                        
                          <li class="nav-item">
                            <a href = "get_started.php?Action=Register" class="btn m-2 text-white" ><u>Register</u></a>
                          </li>
                          <li class="nav-item">
                            <a href = "get_started.php?Action=Login" class="btn m-2 text-dark" style="background-color: #FFFFFF;" > Login </a>
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
