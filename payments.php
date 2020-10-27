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
                <h5 class="card-title m-0">Subscribe to our program</h5>
            </div>

            <div class="card-body">

                <br>

                <div class="row justify-content-center" >
                    <div class="col-mb-8">
                        <p>Collection Sight is a project that wants to expand and get bigger. </p>
                        <text>
                        For the first month the use of this platform is free. To mantain your data for a long time (life-long), you only need to pay 2€. 
                        After that, your account will be mantained forever in our databases. Try yourself for the first month and enjoy. <br><br> <p>The Team of Collection Sight.</p>
                        </text>
                        
                        
                    </div>
                </div>

                <br><br><br><br>


                <div class="row justify-content-center">
                    <div class="col-md-8">

                        <div id="paypal-button-container"></div>
                        <script src="https://www.paypal.com/sdk/js?client-id=ATaeq_M12RICGMFIYdeHED_rKYc5o0UUT7BxGfTOBlgtmE0cDStu0KMSUfX7YzAloMOZMqE1yu0h7rZN&currency=EUR" data-sdk-integration-source="button-factory"></script>
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
                                            value: '2'
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
