<?php 
class HubspotContacts extends Hubspot
{  
    function __construct() {
        parent::__construct();
    } 
    public function getContactList($limit = 10,$after = '',$properties=''){
        /**
         * limit :  maximum number of results
         * after :  strting - paging.next.after
         * properties : comma separated list of the properties 
         * url : "https://api.hubapi.com/crm/v3/objects/contacts?limit=10&archived=true&hapikey=YOUR_HUBSPOT_API_KEY"
         */
        $params = "limit=".$limit;
        if($after!=''){
            $params .= "&after=".$after; 
        }  
        if($properties!=''){
            $params .= "&properties=".$properties; 
        }  
        return $this->callApi('objects/contacts','GET',$params);
    } 
    public function addContact($properties =[]){
        
        if(sizeof($properties) > 0)
        {
            $postjson = json_encode($properties);
            $params = "";  
            return $this->callApi('objects/contacts',$method='POST',$params='',$postjson);
        } 
        return false;
    } 
    public function updateContact($contactId,$properties){

         
        if(sizeof($properties) > 0 && $contactId > 0)
        {
            $postjson = json_encode($properties);
            $params = "";  
            return $this->callApi('objects/contacts/'.$contactId,$method='PATCH',$params='',$postjson);
        } 
        return false;
    } 
    public function getContactById($id = 10){ 
        /* BETA: https://packagist.org/packages/hubspot/api-client */ 
        $curl = curl_init(); 
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.hubapi.com/crm/v3/objects/contacts/688551?archived=false&hapikey=".$this->hubspot_key,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "accept: application/json"
          ),
        ));
        
        echo $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }
    }

    public function searchContacts($searchjson){  
        $params = ""; 
        return $this->callApi('objects/contacts/search','POST',$params,$searchjson); 
    } 
}

?>