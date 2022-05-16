<?php 
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Cache-Control");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT');
    header('content-type: application/json; charset=utf-8');
    include 'include/utils/Shopify.php';
    include 'include/utils/Tools.php';

    $Shopify = new Shopify();
  
   $str_json = file_get_contents('php://input');
   $collection_data = json_decode($str_json);
   $result = $Shopify->collectionData("diane-alber.myshopify.com/","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", $collection_data);
   echo json_encode($result);
?>