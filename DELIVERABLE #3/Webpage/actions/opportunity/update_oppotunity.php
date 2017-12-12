<?php
include('../../config/init.php');

$activity['opportunity_id'] = $_GET['opportunity_id'];
$activity['customer_id'] = $_GET['customer_id'];
$activity['product_id'] = $_GET['product_id'];
$activity['opportunity_type'] = $_GET['opportunity_type'];
$activity['representative_id'] = $_SESSION['user_id'];
$activity['opportunity_state'] = "Open";

$json_act = json_encode($activity);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/opportunities/?opportunity_id='. $activity['opportunity_id']);
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
	header("Location: " . $BASE_URL . "pages/opportunities.php");
}
?>
