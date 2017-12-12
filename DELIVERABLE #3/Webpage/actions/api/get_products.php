<?php include('../../config/init.php');

//Load products
$curl4 = curl_init();
curl_setopt($curl4, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/artigos/');
curl_setopt($curl4, CURLOPT_RETURNTRANSFER, TRUE);
$resp4 = curl_exec($curl4);
curl_close($curl4);
$products = json_decode($resp4, true);
echo json_encode ($products);
?>
