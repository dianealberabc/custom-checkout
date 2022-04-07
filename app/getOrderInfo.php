<?php 

  //header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Cache-Control");
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET, POST, PUT');
  header('content-type: application/json; charset=utf-8');
 
  include '../include/utils/Shopify.php';
  include '../include/utils/Tools.php';


  $Shopify = new Shopify();
  $shop_url = "rebuilt-meals-llc.myshopify.com";//Tools::getShopUrl()
  $access_token = "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"; 

  $str_json = file_get_contents('php://input');
  $data = json_decode($str_json, true);
  $order_id = $data['id'];


  $orderById =  $Shopify->getOrderById($shop_url, $access_token,$order_id);
  
  echo json_encode($orderById);
  exit;
?>