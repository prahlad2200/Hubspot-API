<?php 
class Hubspot
{  
    function __construct() {
        $this->hubspot_key = HUBSPOT_KEY;
        $this->hubspot_api_url = HUBSPOT_API_URL;
    }  
    public function callApi($url,$method='GET',$params='',$postjson=''){

        $this->hubspot_api_url; 
        $endpoint = $this->hubspot_api_url.$url.'?hapikey='.$this->hubspot_key;
        if($params !='')
        {
            $endpoint .="&".$params;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING,"");
        curl_setopt($ch, CURLOPT_MAXREDIRS,10);
        curl_setopt($ch, CURLOPT_TIMEOUT,30);
        curl_setopt($ch, CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1); 
        if($method == "POST")
        {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            if($postjson !='')
            { 
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postjson); 
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, array( "accept: application/json", "content-type: application/json")); 
        }
        else if($method == "PATCH"){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
            if($postjson !='')
            { 
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postjson); 
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, array( "accept: application/json", "content-type: application/json"));
        }
        else{
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"GET");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array( "accept: application/json" )); 
        } 
        $response = curl_exec($ch);
        $err = curl_error($ch); 
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch); 
        if ($err) { 
            return array('status_code'=>$status_code,'response' =>'','curl_errors'=>$err);
        } else {
            return array('status_code'=>$status_code,'response' =>$response,'curl_errors'=>$err);
        } 
    }
}
