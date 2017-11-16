<?php 
include('../../config/init.php');

$activity['title'] = $_POST['title'];
$activity['id'] = $_POST['id'];
$activity['type'] = $_POST['type'];
$activity['client'] = $_POST['client'];
$activity['location'] = $_POST['location'];
$activity['notes'] = $_POST['notes'];
$activity['strating_date'] = explode ('T' , $_POST['strating_date'])[0] . ' ' . explode ('T' , $_POST['strating_date'])[1];
$activity['ending_date'] = explode ('T' , $_POST['ending_date'])[0] . ' ' . explode ('T' , $_POST['ending_date'])[1];
$activity['representative_id'] = $_SESSION['user_id'];


$json_act = json_encode($activity);
$curl = curl_init();
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
}
?>