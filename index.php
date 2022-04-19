<?php 

  //header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Cache-Control");
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET, POST, PUT');
  // header('content-type: application/json; charset=utf-8');

  include 'include/utils/Shopify.php';
  include 'include/utils/Tools.php';


  $Shopify = new Shopify();
  // $shop_url = "rebuilt-meals-llc.myshopify.com"; //Tools::getShopUrl()
  // $access_token = "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"; 
  // define('API_SECRET_KEY', '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');
  
  // function verify_webhook($data, $hmac_header)
  // {
  //   $calculated_hmac = base64_encode(hash_hmac('sha256', $data, API_SECRET_KEY, true));
  //   return hash_equals($hmac_header, $calculated_hmac);
  // }
  // $hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
  // $data = file_get_contents('php://input');
  // $verified = verify_webhook($data, $hmac_header);
  // error_log('Webhook verified: '.var_export($verified, true)); // Check error.log to see the result

  // $json = $data;
  // $json = json_decode($json, true);
  // $id = $json['id'];
  // $na_tags_value = $json['tags'];
  // $t = json_encode($json['note_attributes']);
  // $note_attributes = json_decode($t, true);
  // foreach ($note_attributes as $value) {
  //   $name = $value['name'];
  //   $v = $value['value'];

  //   if($name == 'data tags') {
  //     if (strpos($na_tags_value, ',')) {
  //       if($v != '') {
  //         $na_tags_value = $na_tags_value.','.$v;
  //         break;
  //       }
  //     } else{
  //       $na_tags_value = $v;
  //     }
  //   }
  // }
  // $Shopify->updateOrderTag($shop_url, $access_token, $id, $na_tags_value);
  echo "hello hi";
?>