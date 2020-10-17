<?php

if(isset($_SESSION['idcollezione'])){
    $idcollection = $_SESSION['idcollezione'];
}
if(isset($_GET['Edit'])){

    $cardname = $_GET['name-card'];
    $setname = $_GET['name-set'];

}

else{       ?>
     
<div class="content">
    <div class="container">
        <div class="row justify-content-center">
            
        
        
        <div class="col-12">
            <div class="card" id="carta-inserimento">

                <div class="card-header">
                    <h3 class="card-title">Add cards to your album</h3>
                </div>

                <div class="card-header">
                    <p class="font-weight-bold card-text"><h5> 1. First Step.</p> If you have to insert a new card follow this procedure:</h5><br>
                    <ul>
                        <li>Open in another page the site of <a href="https://www.cardmarket.com/en/">https://www.cardmarket.com/en/</a>. Remember that it works only with the english version;  </li>
                        <li>Search out the exact card that you want to insert;</li>
                        <li>Copy the exact name of the cards and of the set from the site, then paste them in the apposites fields.</li>
                        <li>To see an example of the usage, check out our video on Youtube: <a href="https://www.youtube.com/watch?v=Zw6OeYv-cKw">https://www.youtube.com/watch?v=Zw6OeYv-cKw</a>      </li>
                        
                    </ul>
                </div>


                <div class="card-header">
                    
                    <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <form action="album.php" method="POST">
                            <a class="nav-link active"><input class="btn btn-primary" type="submit" name="INS" value="Set & Name"></a>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="album.php" method="POST">
                            <a class="nav-link active"><input class="btn btn-primary" type="submit" name="INS" value="Only Link"></a>
                        </form>
                    </li>
                    </ul>
                </div>

                <form method="POST" action="php/cardinsert.php">

                <div class="card-body">
                    <div class="row">

                    <?php
                        if(isset($_SESSION['ONLY-LINK']) AND $_SESSION['ONLY-LINK'] == TRUE)
                        {
                    ?>
                        <div class="col-8">
                            <div class="form-group">

                                <input class="form-control" type="text" name="link_card"  placeholder="Exact Link from Cardmarket">

                            </div>
                        </div>

                    <?php
                        }
                        else 
                        {
                    ?>
                        
                            <div class="col-4">
                            <div class="form-group">
                                <!-- Doveva esserci name="search"-->
                                <input class="form-control" id="search-set" type="text" name="set_name" placeholder="Exact Set Name in English">

                                <div class="list-group" id="show-list">
                                    <!-- Here autocomplete list will be display -->
                                </div>
                                
                                
                            </div>
                            </div>

                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <!-- script per auto completamento-->
                            <script type="text/javascript">
                                $(document).ready( function(){
                                    $("#search-set").keyup(function(){
                                        var searchText = $(this).val();
                                        if(searchText != ''){
                                            $.ajax({
                                                url:'php/action.php',
                                                method:'post',
                                                data:{ query:searchText},
                                                success:function(response){
                                                    $("#show-list").html(response);
                                                }
                                            });
                                        }
                                        else{
                                            $("#show-list").html('');
                                        }
                                    });
                                    $(document).on('click','a',function(){
                                        $("#search").val($(this).text());
                                        $("#show-list").html('');
                                    });

                                });
                            </script>

                            <div class="col-4">
                            <div class="form-group">

                                <input class="form-control" type="text" name="card_name"  placeholder="Exact Card Name in English">

                            </div>
                            </div>
                        
                    <?php 
                        }

                    ?>
                        
                        

                    <div class="col-4">
                    <div class="form-group">
                        <select name="conditions" class="form-control">
                            <option>--Conditions--</option>
                            <option>M</option>
                            <option>NM</option>
                            <option>EX</option>
                            <option>GD</option>
                            <option>LP</option>
                            <option>PL</option>
                            <option>P</option>
                        </select>
                    </div>
                    </div>
                    </div>

                    <div class="row">       
                    <div class="col-4"> 
                    <div class="form-group">
                        <select name="extravalues" class="form-control">
                            <option>--Extra Values--</option>
                            <option>Normal</option>
                            <option>Foil</option>
                            <option>Signed</option>
                            <option>Playset</option>
                            <option>First Edition</option>
                            <option>Alieved</option>
                            
                        </select>
                    </div>
                    </div>

                    <div class="col-4"> 
                    <div class="form-group">
                        <select name="languages" class="form-control">
                            <option>--Languages--</option>
                            <option>Italian</option>
                            <option>English</option>
                            <option>Spanish</option>
                            <option>German</option>
                            <option>French</option>
                            <option>Portuguese</option>
                            <option>Russian</option>
                            <option>Korean</option>
                            <option>Japanese</option>
                            <option>Traditional Chinese</option>
                            <option>Simplified Chinese</option>
                        </select>
                    </div>
                    </div>

                    
                    <div class="col-4"> 
                    <div class="form-group">
                        <select name="quantities" class="form-control">
                            <option>--Quantities--</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    </div>
                    </div>
                    <div class="row justify-content-center mt-2">
                        <div class="col-3">
                            <input class="btn btn-primary btn-block" type="submit" name="inserisci-carta" value="Insert Card">
                        </div>
                    </div>
                        
                    </form>
                    </div>

                    <?php  if(isset($_POST['selected-min&trend']) || isset($_POST['selected-evaluation'])) {  ?>

                        <!--
                            <div class="card-footer">
                                <h5><p class="font-weight-bold">3. Third Step.</p> To see your collection click the button below. </h5>
                                
                                <form method="POST" action="php/get_cards.php">    
                                    <input class="btn btn-info" type="submit" name="aggiorna_carte" value="Reload Prices">
                                </form>
                            </div>
                        -->
                    <?php  }  ?>

            </div>  <!-- /. col 12 -->
        </div>   <!-- /. row justify content center -->
    </div> <!-- /. cotainer -->
</div> <!-- /. content -->

        <?php   }   ?>

