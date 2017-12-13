<?php
include('../../config/init.php');

$activity ['customer_id'] = $_POST['customer_id'];
$activity ['opportunity_type'] = $_POST['opportunity_type'];
$activity ['representative_id'] = $_SESSION['user_id'] . '';
$activity ['opportunity_state'] = "Open";
$activity ['products'] = $_POST['products'];

$json_act = json_encode($activity);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/opportunities/');
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POSTFIELDS, $json_act);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Content-Length: ' . strlen($json_act))
);
$resp = curl_exec($curl);

curl_close($curl);

header("Location: ". $BASE_URL . 'pages/opportunities.php');
?>
