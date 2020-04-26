<?php 
class HubspotProperties extends Hubspot
{ 
    function __construct() {
        parent::__construct();
    }
    public function getProperties(){  
        return $this->callApi('properties/Contacts','GET',''); 
    } 
}

?>