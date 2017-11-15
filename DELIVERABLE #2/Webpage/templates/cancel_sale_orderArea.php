<div id="page-wrapper">
<?php
	
	if (!empty($_GET["bttn_press"])){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/DocVenda/'.$_GET["id"]);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $_GET["id"]);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($curl);
		$result = json_decode($result);
		curl_close($curl);
		
		echo "<script>location.href='../pages/sales_orders.php';</script>";
	}
	
?>
<form action="cancel_sale_order.php">
	<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
	<input type="hidden" name="bttn_press" value=true>
	<br>
	<label>Cancel chosen order?</label>
	<br><br>
	<input type="submit" class="btn btn-danger btn" value="Confirm order cancellation">
</form>
</div>
