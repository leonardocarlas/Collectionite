<?php
    require "header.php";
    require "php/dbh.php";
?>

<?php $user_id=(isset($_SESSION['idusersession']))?$_SESSION['idusersession']:''; ?>

<br><br><br><br>



<div class="content">
      <div class="container">
            <div class="card card-primary card-outline">

            <div class="card-header">
                <h5 class="card-title m-0">Iscriviti al nostro programma</h5>
            </div>

            <div class="card-body">

                <br>

                <div class="row justify-content-center" >
                    <div class="col-mb-8">
                        <p>Collection Sight è un progetto che vuole espandersi e offrire più strumenti per i collezionisti. </p>
                        <text>
                        Il primo mese di utilizzo della piattaforma è in prova gratuita. Per mantenere i dati per sempre nel database, 
                        viene chiesto all'utente di pagare una e una sola volta 2.99 €, assicurandosi in questo modo l'ACCOUNT A VITA.
                        Provalo tu stesso per i primi 30 giorni e divertiti! <br><br> <p>Il Team di Collection Sight.</p>
                        </text>
                        
                        
                    </div>
                </div>

                <br><br><br><br>


                <div class="row justify-content-center">
                    <div class="col-md-8">

                        <div id="paypal-button-container"></div>
                        <script src="https://www.paypal.com/sdk/js?client-id=AUiQObjWwMGD1n6r8V5Ha27R3ijRQk-Mcmt4iP5rQaDh57ralkj0EakZzUdnb9BWyqU2ucJO5RAUYzDi&currency=EUR" data-sdk-integration-source="button-factory"></script>
                        <script>
                        paypal.Buttons({
                            style: {
                                shape: 'pill',
                                color: 'blue',
                                layout: 'vertical',
                                label: 'paypal',
                                
                            },
                            createOrder: function(data, actions) {
                                return actions.order.create({
                                    purchase_units: [{
                                        amount: {
                                            value: '2.99'
                                        }
                                    }]
                                });
                            },
                            onApprove: function(data, actions) {
                                return actions.order.capture().then(function(details) {
                                    $.ajax({
                                        type: "POST",
                                        url: "transaction-completed.php",
                                        data: {
                                            orderID: data.orderID,
                                            userID: <?php echo $user_id;?>
                                        }
                                    })
                                    .done(function (msg) {
                                        if(msg == "ok")
                                            window.location.href = "payment-success.php?result=SUCCESS"
                                        // else fallimento                                        
                                    });
                                });
                            },
                            onError: function (err) {
                                window.location.href = "payment-success.php?result=ERROR&error="+err
                            }
                        }).render('#paypal-button-container');
                        </script>
                    </div>
                </div>
                
                <br><br><br>

            </div> <!--.\ card-body -->
            <div> <!--.\ card -->
        </div> <!--.\ content -->
    </div>  <!--.\ container -->






<br><br><br><br><br><br><br><br>



<?php

 require "footer.php";
?>
