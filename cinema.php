<?php 
    
require "header.php"; 
require "php/dbh.php";



if ( isset( $_GET['EXP']) ) { 

    $id_exp = mysqli_real_escape_string($connessione, $_GET['EXP']);
    $array_immagini = get_images($id_exp);

    echo'

    <div class="d-flex flex-row m-4">
        <h5><a href= "cinema.php" class="text-dark" ><u> Seleziona l\'espansione </u></a></h5>
    </div> ';

    echo '

        <div class = "row justify-content-center"> 
            <div id="drag-container">

                <div id="spin-container">
                    <!-- Add your images (or video) here -->
        ';

    for ($i = 0; $i < count ($array_immagini); $i++ ) {
        echo '
            <img
            src=" '. $array_immagini[$i] .' "
            alt=""
            />
        ';
    }
                    
    echo '
                    <!-- Text at center of ground -->
                    <p>3D Tiktok Carousel</p>

                </div>
                
                <div id="ground">
                </div>        

            </div>
        </div>

        <div class = "row justify-content-center">
            <div id="music-container" style = "visibility: hidden; "> 
            </div>
        </div> 
  
    ';

} else {  

    echo '

    <div class = "row justify-content-center">
        <h1> Cinema Mode </h1>
    </div>

    <div class = "row justify-content-center">

        <nav class="navbar navbar-expand-lg" style = "background:transparent; background-color:transparent;">
        
            <ul class="navbar-nav">
                <li class="nav-item">
                    <img src="immagini/magic_logo.png"  onClick = "show_expansions(1)" width="90" height="40" style="cursor: pointer;" >
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <img src="immagini/pokemon_logo.png" onClick = "show_expansions(6)" width="90" height="40" style="cursor: pointer;" >
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <img src="immagini/ygo_logo.png" onClick = "show_expansions(3)" width="90" height="40" style="cursor: pointer;" >
                </li>
            </ul>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <img src="immagini/fow_logo.png"  onClick = "show_expansions(7)"  width="90" height="40" style="cursor: pointer;" >
                    </li>
                    <li class="nav-item">
                        <img src="immagini/vanguard_logo.png" onClick = "show_expansions(8)"   width="90" height="40" style="cursor: pointer;" >
                    </li>
                    <li class="nav-item">
                        <img src="immagini/ff_logo.png"   onClick = "show_expansions(9)"   width="90" height="40" style="cursor: pointer;" >
                    </li>
                    <li class="nav-item">
                        <img src="immagini/starwars_logo.png" onClick = "show_expansions(15)"  width="90" height="40" style="cursor: pointer;" >
                    </li>
                    <li class="nav-item">
                        <img src="immagini/dbs_logo.png" onClick = "show_expansions(13)"  width="90" height="40" style="cursor: pointer;" >
                    </li>
                    <li class="nav-item">
                        <img src="immagini/dragoborne_logo.png" onClick = "show_expansions(11)" width="90" height="40" style="cursor: pointer;" >
                    </li>
                    <li class="nav-item">
                        <img src="immagini/wow_logo.png" onClick = "show_expansions(2)"  width="90" height="40" style="cursor: pointer;" >
                    </li>
                    <li class="nav-item">
                        <img src="immagini/spoils_logo.png" onClick = "show_expansions(5)"  width="90" height="40" style="cursor: pointer;" >
                    </li>
                    <li class="nav-item">
                        <img src="immagini/ws_logo.png" onClick = "show_expansions(10)"  width="90" height="40" style="cursor: pointer;" >
                    </li>
                </ul>
            </div>
        </nav>

    </div>

    <br>

    <div id = "expansions">

    </div> 

    <br><br>
    ';

    require "footer.php";    

}

?>
























<script type ="text/javascript">
    
    window.onload = function() {
        show_expansions(1);
    };

    function show_expansions(id_collection){
        $.post("php/CRUD_cinema.php",{"collezione":id_collection},function(data){
            $("#expansions").html(data);
            });
    }
    
</script>


<script>
    // Author: Hoang Tran (https://www.facebook.com/profile.php?id=100004848287494)
    // Github verson (1 file .html): https://github.com/HoangTran0410/3DCarousel/blob/master/index.html

    // You can change global variables here:
    var radius = 240; // how big of the radius
    var autoRotate = true; // auto rotate or not
    var rotateSpeed = -60; // unit: seconds/360 degrees
    var imgWidth = 120; // width of images (unit: px)
    var imgHeight = 170; // height of images (unit: px)

    // Link of background music - set 'null' if you dont want to play background music
    var bgMusicURL =
        "https://api.soundcloud.com/tracks/143041228/stream?client_id=587aa2d384f7333a886010d5f52f302a";
    var bgMusicControls = true; // Show UI music control

    /*
    NOTE:
    + imgWidth, imgHeight will work for video
    + if imgWidth, imgHeight too small, play/pause button in <video> will be hidden
    + Music link are taken from: https://hoangtran0410.github.io/Visualyze-design-your-own-/?theme=HauMaster&playlist=1&song=1&background=28
    + Custom from code in tiktok video  https://www.facebook.com/J2TEAM.ManhTuan/videos/1353367338135935/
    */

    // ===================== start =======================
    setTimeout(init, 100);

    var odrag = document.getElementById("drag-container");
    var ospin = document.getElementById("spin-container");
    var aImg = ospin.getElementsByTagName("img");
    var aVid = ospin.getElementsByTagName("video");
    var aEle = [...aImg, ...aVid]; // combine 2 arrays

    // Size of images
    ospin.style.width = imgWidth + "px";
    ospin.style.height = imgHeight + "px";

    // Size of ground - depend on radius
    var ground = document.getElementById("ground");
    ground.style.width = radius * 3 + "px";
    ground.style.height = radius * 3 + "px";

    function init(delayTime) {
        for (var i = 0; i < aEle.length; i++) {
        aEle[i].style.transform =
            "rotateY(" +
            i * (360 / aEle.length) +
            "deg) translateZ(" +
            radius +
            "px)";
        aEle[i].style.transition = "transform 1s";
        aEle[i].style.transitionDelay =
            delayTime || (aEle.length - i) / 4 + "s";
        }
    }

    function applyTranform(obj) {
        // Constrain the angle of camera (between 0 and 180)
        if (tY > 180) tY = 180;
        if (tY < 0) tY = 0;

        // Apply the angle
        obj.style.transform = "rotateX(" + -tY + "deg) rotateY(" + tX + "deg)";
    }

    function playSpin(yes) {
        ospin.style.animationPlayState = yes ? "running" : "paused";
    }

    var sX,
        sY,
        nX,
        nY,
        desX = 0,
        desY = 0,
        tX = 0,
        tY = 10;

    // auto spin
    if (autoRotate) {
        var animationName = rotateSpeed > 0 ? "spin" : "spinRevert";
        ospin.style.animation = `${animationName} ${Math.abs(
        rotateSpeed
        )}s infinite linear`;
    }

    // add background music
    if (bgMusicURL) {
        document.getElementById("music-container").innerHTML += `
        <audio src="${bgMusicURL}" ${
                    bgMusicControls ? "controls" : ""
                } autoplay loop>    
        <p>If you are reading this, it is because your browser does not support the audio element.</p>
        </audio>
        `;
    }

    // setup events
    document.onpointerdown = function(e) {
        clearInterval(odrag.timer);
        e = e || window.event;
        var sX = e.clientX,
        sY = e.clientY;

        this.onpointermove = function(e) {
        e = e || window.event;
        var nX = e.clientX,
            nY = e.clientY;
        desX = nX - sX;
        desY = nY - sY;
        tX += desX * 0.1;
        tY += desY * 0.1;
        applyTranform(odrag);
        sX = nX;
        sY = nY;
        };

        this.onpointerup = function(e) {
        odrag.timer = setInterval(function() {
            desX *= 0.95;
            desY *= 0.95;
            tX += desX * 0.1;
            tY += desY * 0.1;
            applyTranform(odrag);
            playSpin(false);
            if (Math.abs(desX) < 0.5 && Math.abs(desY) < 0.5) {
            clearInterval(odrag.timer);
            playSpin(true);
            }
        }, 17);
        this.onpointermove = this.onpointerup = null;
        };

        return false;
    };

    document.onmousewheel = function(e) {
        e = e || window.event;
        var d = e.wheelDelta / 20 || -e.detail;
        radius += d;
        init(1);
    };
</script>






<?php 

    function get_images ($id_expansion) {

        require 'php/dbh.php';

        $sql = "SELECT Idcard, Image_link FROM cards WHERE Idset = ? ; ";
        $stmt = mysqli_stmt_init($connessione);

        if (!mysqli_stmt_prepare($stmt, $sql)) {

            echo "Error in the database";

        }
        else {

            mysqli_stmt_bind_param($stmt, "i", $id_expansion);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt); 

            $array_immagini = array();

            if ($result->num_rows > 0) {

                // Metto tutte le informazioni che o preso dalla query in un array 

                while ($row = $result->fetch_assoc()) {

                    array_push($array_immagini, $row['Image_link']);

                }

                return $array_immagini; 

            } else {

                return $array_immagini;

            }
        }

    }