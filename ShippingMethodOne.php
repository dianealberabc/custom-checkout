<?php 
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Cache-Control");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT');
    header('content-type: application/json; charset=utf-8');
    // require 'include/db/Store.php';
    include 'include/utils/Shopify.php';
    include 'include/utils/Tools.php';

    $Shopify = new Shopify();
  
   $str_json = file_get_contents('php://input');
   $carrier_service_id = json_decode($str_json);
   $result = $Shopify->shippingServiceOne("diane-alber.myshopify.com","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", $carrier_service_id);
   echo json_encode($result);

?>