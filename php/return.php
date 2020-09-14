<?php

/*
Working Example PHP with libcurl Library

App Token: bfaD9xOU0SXBhtBP
App Secret: pChvrpp6AEOEwxBIIUBOvWcRG3X9xL4Y
Access Token: lBY1xptUJ7ZJSK01x4fNwzw8kAe5b10Q (either it comes from the /access request or is set for a dedicated/widget app)
Access Token Secret: hc1wJAOX02pGGJK2uAv1ZOiwS7I9Tpoe (either it comes from the /access request or is set for a dedicated/widget app)
Request: /account request from the API 1.1: GET https://api.cardmarket.com/ws/v1.1/account
Time stamp: 1407917892
Nonce: 53eb1f44909d6

EXAMPLE REQUEST

1. Get all articles for the product with idProduct 266361:

GET https://api.cardmarket.com/ws/v2.0/articles/266361

2. Get articles for the product with idProduct 266361 that

    are from private sellers (userType=private,
    are in English (idLanguage=1),
    and are in minimum near mint condition (minCondition=NM),
    return only 10 entities starting from 0:

GET https://api.cardmarket.com/ws/v2.0/articles/266361?userType=private&idLanguage=1&minCondition=NM&start=0&maxResults=10 

*/

/**
* Declare and assign all needed variables for the request and the header
*
* @var $method string Request method
* @var $url string Full request URI
* @var $appToken string App token found at the profile page
* @var $appSecret string App secret found at the profile page
* @var $accessToken string Access token found at the profile page (or retrieved from the /access request)
* @var $accessSecret string Access token secret found at the profile page (or retrieved from the /access request)
* @var $nonce string Custom made unique string, you can use uniqid() for this
* @var $timestamp string Actual UNIX time stamp, you can use time() for this
* @var $signatureMethod string Cryptographic hash function used for signing the base string with the signature, always HMAC-SHA1
* @var version string OAuth version, currently 1.0
*/

$id_product = 489259;
$language = 5;
$cond = "NM";
$maxResults = 5;
$start = 0;

$method             = "GET";
$url                = "https://api.cardmarket.com/ws/v2.0/output.json/articles/".$id_product;
$appToken           = "D5lSR859bgB50sVj";
$appSecret          = "DLszKXEZCrNbZRQ8dTc1kLo6QxyDkicR";
$accessToken        = "";
$accessSecret       = "";
$nonce              = "53eb1f44909d6";
$timestamp          = "1407917892";
$signatureMethod    = "HMAC-SHA1";
$version            = "1.0";

/**
* Gather all parameters that need to be included in the Authorization header and are know yet
*
* Attention: If you have query parameters, they MUST also be part of this array!
*
* @var $params array|string[] Associative array of all needed authorization header parameters
*/
$params             = array(
   'realm'                     => $url,
   'oauth_consumer_key'        => $appToken,
   'oauth_token'               => $accessToken,
   'oauth_nonce'               => $nonce,
   'oauth_timestamp'           => $timestamp,
   'oauth_signature_method'    => $signatureMethod,
   'oauth_version'             => $version,
   'idLanguage'                => $language,
   'minCondition'              => $cond,
   'start'                     => $start,
   'maxResults'                => $maxResults
);

/**
* Start composing the base string from the method and request URI
*  $url    = "https://api.cardmarket.com/ws/v2.0/articles/".$id_product. "&idLanguage=".$language."&minCondition=".$cond."&start=0&maxResults=10";
* Attention: If you have query parameters, don't include them in the URI
*
* @var $baseString string Finally the encoded base string for that request, that needs to be signed
*/
$baseString         = strtoupper($method) . "&";
$baseString        .= rawurlencode($url) . "&";

/*
* Gather, encode, and sort the base string parameters
*/
$encodedParams      = array();
foreach ($params as $key => $value)
{
   if ("realm" != $key)
   {
       $encodedParams[rawurlencode($key)] = rawurlencode($value);
   }
}
ksort($encodedParams);

/*
* Expand the base string by the encoded parameter=value pairs
*/
$values             = array();
foreach ($encodedParams as $key => $value)
{
   $values[] = $key . "=" . $value;
}
$paramsString       = rawurlencode(implode("&", $values));
$baseString        .= $paramsString;

/*
* Create the signingKey
*/
$signatureKey       = rawurlencode($appSecret) . "&" . rawurlencode($accessSecret);

/**
* Create the OAuth signature
* Attention: Make sure to provide the binary data to the Base64 encoder
*
* @var $oAuthSignature string OAuth signature value
*/
$rawSignature       = hash_hmac("sha1", $baseString, $signatureKey, true);
$oAuthSignature     = base64_encode($rawSignature);

/*
* Include the OAuth signature parameter in the header parameters array
*/
$params['oauth_signature'] = $oAuthSignature;

/*
* Construct the header string
*/
$header             = "Authorization: OAuth ";
$headerParams       = array();
foreach ($params as $key => $value)
{
   $headerParams[] = $key . "=\"" . $value . "\"";
}
$header            .= implode(", ", $headerParams);

/*
* Get the cURL handler from the library function
*/
$curlHandle         = curl_init();

/*
* Set the required cURL options to successfully fire a request to MKM's API
*
* For more information about cURL options refer to PHP's cURL manual:
* http://php.net/manual/en/function.curl-setopt.php
*/
$url = "https://api.cardmarket.com/ws/v2.0/output.json/articles/".$id_product. "?idLanguage=".$language."&minCondition=".$cond."&start=".$start."&maxResults=".$maxResults;

curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curlHandle, CURLOPT_URL, $url);
curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array($header));
curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);

/**
* Execute the request, retrieve information about the request and response, and close the connection
*
* @var $content string Response to the request
* @var $info array Array with information about the last request on the $curlHandle
*/
$content            = curl_exec($curlHandle);
$info               = curl_getinfo($curlHandle);
curl_close($curlHandle);

/*
* Convert the response string into an object
*
* If you have chosen XML as response format (which is standard) use simplexml_load_string
* If you have chosen JSON as response format use json_decode
*
@var $decoded \SimpleXMLElement|\stdClass Converted Object (XML|JSON)
*/
$decoded            = json_decode($content);
//$decoded            = simplexml_load_string($content);

//echo "Contenuto  ". $content;
//echo "Informazioni  ";
//print_r($info );


//idArticle
//price

$jsonIterator = new RecursiveIteratorIterator(
   new RecursiveArrayIterator(json_decode($content, TRUE)),
   RecursiveIteratorIterator::SELF_FIRST);

$prezzi = array();
$verification = false;

foreach ($jsonIterator as $key => $val) {
   if(is_array($val)) {
       //echo "$key:\n";
   } else {
       //echo "$key => $val\n";
       if($key == "comments"){
            $verification = true;
       }
       if($key == "price" and $verification == true){
         array_push($prezzi, $val);
         $verification =false;
       }
       
   }
}


print_r($prezzi);

if(count($prezzi)) {
   echo $average = array_sum($prezzi)/count($prezzi);
}

?>