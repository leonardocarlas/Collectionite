<?php

require 'dbh.php';

if( isset($_POST['collezione']) ) {

    $id_collezione =  mysqli_real_escape_string($connessione, $_POST['collezione']);

    $string = file_get_contents("../REDDITPOSTS/".$id_collezione.".json");
    $json_posts = json_decode($string);

    for($i = 0; $i < 15; $i++ ) {
        
        echo '
            
                <div class="card">
                    <div class = "row justify-content-center" style="background-color: #5401a7;">
                        <h5 class="card-header text-white"  > <a href = "https://www.reddit.com/'.$json_posts[$i]->permalink.'"><u>  From the subreddit </u></a>. Posted  '. gmdate("h", $json_posts[$i]->created_utc).' hours ago </h5>              
                    </div>    
                    <div class="card-body">
                        <div class = "row justify-content-center">
                            <h5 class="card-title">'.$json_posts[$i]->title.'</h5>
                        </div>
                        <br>
                        <div class = "row justify-content-center">
                            <p class="card-text">
            ';

        if ($json_posts[$i]->selftext_html != null) {

            echo $json_posts[$i]->selftext_html;

        }
        if ( str_contains( $json_posts[$i]->url, ".com") == true || str_contains( $json_posts[$i]->url, "youtu") == true ) {
            
        } else {

            echo '<img src="'.$json_posts[$i]->url.'" style = "display: block;
                                                                max-width:500px;
                                                                max-height:500px;
                                                                width: auto;
                                                                height: auto;" 
            >';
        }
        if ($json_posts[$i]->media_metadata == "") {

        }
        else {

            /*
            foreach ($json_posts[$i]->media_metadata as $key => $value) {
                echo $key . "<br>";
                echo $json_posts[$i]->media_metadata->$key->p[0]->u. "<br>";
            }
            

            echo '

            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
            ';
            */

            foreach ($json_posts[$i]->media_metadata as $key => $value) {
                /*
                echo'
                <div class="carousel-item">
                    <img class="d-block w-100" width="100" height="100" src="'.$json_posts[$i]->media_metadata->$key->p[0]->u .'" alt="Foto">
                </div>
                ';
                */
                echo '<img width="100" height="100" src="'.$json_posts[$i]->media_metadata->$key->p[0]->u .'" alt="Foto" 
                                                                style = "display: block;
                                                                max-width:500px;
                                                                max-height:500px;
                                                                width: auto;
                                                                height: auto;"
                    >' .'<br><br>';
            }
            
            /*
            echo '       
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
                </a>
            </div>

            ';
            */
            
        }

        echo '

                            </p>
                        </div>
                    </div>
                </div>
            
            <br>
        ';
    }

}


function str_contains(string $haystack, string $needle): bool {

    return '' === $needle || false !== strpos($haystack, $needle);

}


