<?php 

  //header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Cache-Control");
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET, POST, PUT');
  // header('content-type: application/json; charset=utf-8');

  include 'include/utils/Shopify.php';
  include 'include/utils/Tools.php';


  $Shopify = new Shopify();
  $shop_url = "diane-alber.myshopify.com"; //Tools::getShopUrl()
  $access_token = "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"; 
  $str_json = file_get_contents('php://input');
  $snippet_data_ary = json_decode($str_json);
  $snippet_data = json_encode(array('asset' => array(
    'key' => 'assets/'.$snippet_data_ary->imageName,
    'attachment' => $snippet_data_ary->base64
  ))); 
  
  $created_assets = $Shopify->createAssetImage($shop_url,$access_token, $snippet_data);
  echo json_encode($created_assets);
?>