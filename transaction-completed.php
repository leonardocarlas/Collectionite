<?php

namespace Sample;

require __DIR__ . '/vendor/autoload.php';
//1. Import the PayPal SDK client that was created in `Set up Server-Side SDK`.
use Sample\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
require 'paypal-client.php';

class GetOrder
{

  // 2. Set up your server to receive a call from the client
  /**
   *You can use this function to retrieve an order by passing order ID as an argument.
   */
  public static function getOrder($orderId)
  {
    // 3. Call PayPal to get the transaction details
    $client = PayPalClient::client();
    $response = $client->execute(new OrdersGetRequest($orderId));
    //$orderID = $response->result->id;
    //$email = $response->result->payer->email_address;

    include("php/dbh.php");

    $stmt = $connessione->prepare("UPDATE user SET Payed = 1, Payment_date = NOW() WHERE Iduser=?");
    $stmt->bind_param("i",$_POST['userID']);
    $stmt->execute();
    if($stmt)
        echo "ok";
    else
        echo 'Errore esecuzione query '.mysqli_error($connessione);
    $stmt->close();
    $connessione->close();
  }
}

if (!count(debug_backtrace()))
{
  GetOrder::getOrder($_POST['orderID'], true);
}
?>