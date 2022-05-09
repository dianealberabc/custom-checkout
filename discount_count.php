<?php 

  //header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Cache-Control");
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET, POST, PUT');
  // header('content-type: application/json; charset=utf-8');

  include 'include/utils/Shopify.php';
  include 'include/utils/Tools.php';


  $Shopify = new Shopify();
  $str_json = file_get_contents('php://input');
  $discount_data = json_decode($str_json);
  $discount_input = $discount_data->discount_code;
  $price_rule_id = $discount_data->price_rule_id;
  $created_assets = $Shopify->checkDiscountNo_count("diane-alber.myshopify.com","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", $discount_input,$price_rule_id);
  echo json_encode($created_assets);
    
?>