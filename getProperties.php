<?php  
include_once dirname(__FILE__).'/../includes/sitefunctions.php';
include_once $serverpath.'includes/common_functions.php';

include_once 'classes/hubsportBase.php'; 
include_once 'classes/hubspotProperties.php'; 
$propertieObj = new HubspotProperties();
/* $contacts = $propertieObj -> getContact();
print_r($contacts); */ 
$response = $propertieObj -> getProperties();
?>
<style>
table td, table th{ padding : 5px; border:1px solid;}
</style>
<?php 
if($response['curl_errors'] =='' && $response['status_code'] == '200'){ 
    $results =json_decode($response['response'],true);
    echo "<table style='border: 2px solid; padding: 10px; border-collapse: collapse;'>";
   echo "<tr><th>name</th> <th>label</th> <th>type</th> <th>fieldType</th> <th>groupName</th> <th>createdUserId</th> <th>updatedUserId</th> <th>displayOrder</th> <th>calculated</th> <th>externalOptions</th> <th>archived</th> <th>hasUniqueValue</th> <th>hidden</th> <th>showCurrencySymbol</th> <th>modificationMetadata</th> <th>formField</th><th>updatedAt</th> <th>createdAt</th> </tr>";
   foreach($results['results'] as $k => $v)
   {
        echo "<tr>";  
        echo "<td>".$v['name']."</td>";
        echo "<td>".$v['label']."</td>";
        echo "<td>".$v['type']."</td>";
        echo "<td>".$v['fieldType']."</td>";
        echo "<td>".$v['groupName']."</td>";
        echo "<td>".$v['createdUserId']."</td>";
        echo "<td>".$v['updatedUserId']."</td>";
        echo "<td>".$v['displayOrder']."</td>";
        echo "<td>".$v['calculated']."</td>";
        echo "<td>".$v['externalOptions']."</td>";
        echo "<td>".$v['archived']."</td>";
        echo "<td>".$v['hasUniqueValue']."</td>";
        echo "<td>".$v['hidden']."</td>";
        echo "<td>".$v['showCurrencySymbol']."</td>";
        echo "<td>".json_encode($v['modificationMetadata'])."</td>";
        echo "<td>".$v['formField']."</td>";
        echo "<td>".$v['updatedAt']."</td>";
        echo "<td>".$v['createdAt']."</td>"; 
        echo "</tr>";  
   }
   echo "</table>";
}
else{
    print_r($response['curl_errors']);
}

?>