<?php  
include_once 'classes/hubsportBase.php'; 
include_once 'classes/hubspotContacts.php'; 
$contactObj = new HubspotContacts();   
$properties=[]; 
$properties['properties']["email"] = "prahlad@test.com";  
$properties['properties']["firstname"] ="Prahlad";
$properties['properties']["lastname"] = "Makwana"; 
$response = $contactObj -> addContact($properties); 
if($response['curl_errors'] =='' && $response['status_code'] == '201'){ 
    $results =json_decode($response['response'],true);
    $contactId = $results['id'];
    // sucess 
}
else{
    // error
}