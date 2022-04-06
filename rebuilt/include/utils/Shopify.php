<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);


class Shopify{

	private $_APP_KEY;
	private $_APP_SECRET;
	
	public function __construct(){
		$this->initializeKeys();
	}

	protected function initializeKeys() {
            $this->_APP_KEY = "e3676ad1f3f88550aef8f967ceb12587";
            $this->_APP_SECRET = "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";
    }

	    public function exchangeTempTokenForPermanentToken($shop, $TempCode) {            
        // encode the data
        $data = json_encode(array("client_id" => $this->_APP_KEY, "client_secret" => $this->_APP_SECRET, "code" => $TempCode));        
        // the curl url
        $curl_url = "https://$shop/admin/oauth/access_token";
        // set curl options
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curl_url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // execute curl
        $response = json_decode(curl_exec($ch), true);

        // close curl
        curl_close($ch);
        return $response;
    }

    public function getOrders($shop, $access_token,$date){
        $curl_url = "https://$shop/admin/orders.json?status=any&limit=250";
        if($date != ''){
            $curl_url.='&created_at_min='.$date;
        }
        // set curl options
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curl_url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "X-Shopify-Access-Token:$access_token"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // execute curl
        $response = json_decode(curl_exec($ch));

        // close curl
        curl_close($ch);
        return $response;
    }

     public function getOrderById($shop, $access_token,$id){
        $curl_url = "https://$shop/admin/orders/$id.json";
                // set curl options
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curl_url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "X-Shopify-Access-Token:$access_token"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // execute curl
        $response = json_decode(curl_exec($ch));

        // close curl
        curl_close($ch);
        return $response;
    }



    public function getLocations($shop, $access_token){
        $curl_url = "https://$shop/admin/locations.json?limit=250";
        // set curl options
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curl_url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "X-Shopify-Access-Token:$access_token"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // execute curl
        $response = json_decode(curl_exec($ch));

        // close curl
        curl_close($ch);
        return $response;
    }


    public function inventoryLevels($shop, $access_token,$locId){
        $curl_url = "https://$shop/admin/locations/".$locId."/inventory_levels.json?limit=250";
        // set curl options
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curl_url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "X-Shopify-Access-Token:$access_token"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // execute curl
        $response = json_decode(curl_exec($ch));

        // close curl
        curl_close($ch);
        return $response;
    }

      public function getProducts($shop, $access_token,$collection_id){
        $curl_url = "https://$shop/admin/products.json?limit=250";
        // set curl options
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curl_url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "X-Shopify-Access-Token:$access_token"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // execute curl
        $response = json_decode(curl_exec($ch));

        // close curl
        curl_close($ch);
        return $response;
    }

    public function updateOrderTag($shop, $access_token, $orderId, $tag) {  

        // For Format:- {"order":{"id":450789469,"tags":"External, Inbound, Outbound"}} 
        $data = json_encode(array("order" => array("id" => $orderId, "tags" => $tag)));    
        // the curl url
        $curl_url = "https://$shop/admin/api/2022-01/orders/$orderId.json";
        // set curl options
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curl_url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "X-Shopify-Access-Token:$access_token"));
        curl_setopt($ch, CURLOPT_POSTFIELDS ,$data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // execute curl
        $response = json_decode(curl_exec($ch)); 
        // close curl
        curl_close($ch);    
        return $response;
    }

    public function getAuthUrl($shop, $scope = null){
        $scopes = ["read_products", "read_orders","write_orders","write_products","read_themes", "write_themes", "read_customers","read_inventory","write_inventory"];
        //print_r($scopes);
        //echo SHOPIFY_API_KEY;
        return 'https://' . $shop . '/admin/oauth/authorize?'
                . 'scope=' . implode("%2C", $scopes)
                . '&client_id=' . SHOPIFY_API_KEY
                . '&redirect_uri=' . SHOPIFY_URL;
    }

    public function validateMyShopifyName($shop) {
        $subject = $shop;
        $pattern = '/^(.*)?(\.myshopify\.com)$/';
        preg_match($pattern, $subject, $matches);
        return $matches[2] == '.myshopify.com';
    }

    function validateRequestOriginIsShopify($code,$shop,$timestamp,$signature) {
        $get_params_string = 'code='.$code.'shop='.$shop.'timestamp='.$timestamp.'';
        $calculated_signature = md5(SHOPIFY_APP_PASSWORD . $calculated_signature);
        if($calculated_signature == $signature){
            return true;
        }else if($_GET['origin'] == 'shopify'){
            return true;
        }else{
            return false;
        }
    }
}

