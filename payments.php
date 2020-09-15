<?php
    require "header.php";
?>

<br><br><br><br>



<div class="content">
      <div class="container">

        <div class="row justify-content-center" >
            <div class="col-md-8">
                <p>Dragon Collection is a project that wants to expand and get bigger. </p>
                <text>
                 For the first month the use of this platform is free. To mantain your data for a long time (life-long), you only need to pay 2€. 
                 After that, your account will be mantained forever in our databases. Try yourself for the first month and enjoy. 
                </text>
            </div>
        </div>

<br><br><br><br>

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div id="paypal-button-container"></div>
                <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=EUR" data-sdk-integration-source="button-factory"></script>
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
                            alert('Transaction completed by ' + details.payer.name.given_name + '!');
                        });
                    }
                }).render('#paypal-button-container');
                </script>
                
            </div>
        </div>
    </div>
</div>






<br><br><br><br><br><br><br><br>



<?php

 require "footer.php";
?>