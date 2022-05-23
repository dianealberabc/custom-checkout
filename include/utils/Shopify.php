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
    public function storeCountries($shop, $access_token) { 
       
           $curl_url = "https://$shop/admin/api/2022-04/shipping_zones.json";
           // return $curl_url;
               $ch = curl_init();
               curl_setopt($ch, CURLOPT_URL, $curl_url);
               curl_setopt($ch, CURLOPT_HEADER, false);
               curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json","X-Shopify-Access-Token:$access_token"));
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
               curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
               // execute curl
               $response = curl_exec($ch);
                curl_close($ch);
               $finalCountryCode = json_decode($response);
                // $country_res[] = $finalCountryCode->country->code;
                return $finalCountryCode; 
       
    }
    public function shippingMethod($shop, $access_token){
        $curl_url = "https://$shop/admin/api/2022-04/carrier_services.json";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curl_url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json","X-Shopify-Access-Token:$access_token"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // execute curl
        $response = curl_exec($ch);
         curl_close($ch);
        $shippingDataAll = json_decode($response);
         // $country_res[] = $finalCountryCode->country->code;
         return $shippingDataAll;
    }

    // discount code apply--------------------------------------------------------------------->>>>>>>>>>>>>>>>>>
    public function checkDiscountNo($shop, $access_token, $asset_data) { 
        $curl_url = "https://$shop/admin/api/2022-01/discount_codes/lookup.json?code=$asset_data";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $curl_url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json", "X-Shopify-Access-Token:$access_token"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);      
            curl_setopt($ch, CURLOPT_NOBODY, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // follow redirects
            curl_setopt($ch, CURLOPT_AUTOREFERER, 1); 

            // execute curl
                $response = curl_exec($ch);
                $target = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
                curl_close($ch);
                $ch2 = curl_init();
                curl_setopt($ch2, CURLOPT_URL, $target);
                curl_setopt($ch2, CURLOPT_HEADER, false);
                curl_setopt($ch2, CURLOPT_HTTPHEADER, array("Content-Type:application/json","X-Shopify-Access-Token:$access_token"));
                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
                $response2 = json_decode(curl_exec($ch2));
                curl_close($ch2);
                return $response2;
     }

     public function ruleSetDiscountNo($shop, $access_token, $asset_data) { 
        $curl_url = "https://$shop/admin/api/2022-01/price_rules/$asset_data.json";
        // return $curl_url;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $curl_url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json","X-Shopify-Access-Token:$access_token"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // execute curl
            $response = curl_exec($ch);
             curl_close($ch);
            return  json_decode($response);
            
     }
     public function savedSearchIds($shop, $access_token, $saved_search_ids) { 
        $saved_search_ids_res = array();
        for($i = 0 ; $i < count($saved_search_ids); $i++){
           $curl_url = "https://$shop/admin/api/2021-10/customer_saved_searches/$saved_search_ids[$i].json";
           // return $curl_url;
               $ch = curl_init();
               curl_setopt($ch, CURLOPT_URL, $curl_url);
               curl_setopt($ch, CURLOPT_HEADER, false);
               curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json","X-Shopify-Access-Token:$access_token"));
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
               curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
               // execute curl
               $response = curl_exec($ch);
                curl_close($ch);
               
                $saved_search_ids_res[] = json_decode($response);
             
       }
       return $saved_search_ids_res;
           
    }
    
    public function checkcountries($shop, $access_token, $countries_id) { 
       
        $country_res = array();
        for($i = 0 ; $i < count($countries_id); $i++){
           $curl_url = "https://$shop/admin/api/2021-10/countries/$countries_id[$i].json";
           // return $curl_url;
               $ch = curl_init();
               curl_setopt($ch, CURLOPT_URL, $curl_url);
               curl_setopt($ch, CURLOPT_HEADER, false);
               curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json","X-Shopify-Access-Token:$access_token"));
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
               curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
               // execute curl
               $response = curl_exec($ch);
                curl_close($ch);
               $finalCountryCode = json_decode($response);
                $country_res[] = $finalCountryCode->country->code;
             
       }
       return $country_res;
           
    }

    public function checkDiscountNo_count($shop,$access_token,$discount_code,$price_rule_id){
        $curl_url = "https://$shop/admin/api/2021-10/price_rules/$price_rule_id/discount_codes/$discount_code.json";
        // return $curl_url;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $curl_url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json","X-Shopify-Access-Token:$access_token"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // execute curl
            $response = curl_exec($ch);
             curl_close($ch);
            return  json_decode($response);
    }

    public function collectionData($shop, $access_token, $collection) { 
        $collection_res = array();
        for($i = 0 ; $i < count($collection); $i++){
           $curl_url = "https://$shop/admin/api/2021-10/collections/$collection[$i]/products.json?fields=id,handle&limit=250";
           // return $curl_url;
               $ch = curl_init();
               curl_setopt($ch, CURLOPT_URL, $curl_url);
               curl_setopt($ch, CURLOPT_HEADER, false);
               curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json","X-Shopify-Access-Token:$access_token"));
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
               curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
               // execute curl
               $response = curl_exec($ch);
                curl_close($ch);
               
                $collection_res[] = json_decode($response);
       }
       return $collection_res;
           
    }

    public function productData($shop, $access_token, $pro_data) { 
        $pro_res = array();
        for($i = 0 ; $i < count($pro_data); $i++){
           $curl_url = "https://$shop/admin/api/2021-10/products/$pro_data[$i].json";
           // return $curl_url;
               $ch = curl_init();
               curl_setopt($ch, CURLOPT_URL, $curl_url);
               curl_setopt($ch, CURLOPT_HEADER, false);
               curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json","X-Shopify-Access-Token:$access_token"));
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
               curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
               // execute curl
               $response = curl_exec($ch);  
                curl_close($ch);
               
                $pro_res[] = json_decode($response);
        // $pro_res[] = $pro_data[$i];
             
       }
       return $pro_res;
   
           
    }

    public function draftOrderFun($shop, $access_token, $draft_order_data){
        $curl_url = "https://$shop/admin/api/2022-04/draft_orders.json";
        // return $curl_url;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $curl_url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS ,json_encode($draft_order_data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json","X-Shopify-Access-Token:$access_token"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // execute curl
            $response = curl_exec($ch);
             curl_close($ch);
            return  json_decode($response);
    }

}

