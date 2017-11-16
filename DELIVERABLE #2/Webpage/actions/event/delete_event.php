<?php 
include('../../config/init.php');

$id = $_GET['id'];


$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/agenda/' . $id);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");                                                                
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$resp = curl_exec($curl);

curl_close($curl);
if(strcmp($resp, "Sucesso") ==-1) {
	echo "<h1>Deleted!  Reload the page!</h1>";
}
//header("Location: ". $BASE_URL . 'pages/agenda.php');
?>