<?php 
include('../../config/init.php');

$activity['opportunity_id'] = $_POST['opportunity_id'];
$activity['customer_id'] = $_POST['customer_id'];
$activity['product_id'] = $_POST['product_id'];
$activity['opportunity_type'] = $_POST['opportunity_type'];
$activity['representative_id'] = $_SESSION['user_id'];


$json_act = json_encode($activity);
echo $json_act;
/*$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/agenda/?id='. $activity['id']);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");                                                                     
curl_setopt($curl, CURLOPT_POSTFIELDS, $json_act);                                                                  
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
'Content-Type: application/json',                                                                                
'Content-Length: ' . strlen($json_act))                                                                       
);
$resp = curl_exec($curl);

curl_close($curl);

if(strcmp($resp, "Sucesso") ==-1) {
	echo "<h1>Updated! Reload the page!</h1>";
}*/
?>