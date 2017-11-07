<?php

	// Get cURL resource
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt($curl, CURLOPT_URL, 'http://localhost:49822/api/DocVenda/');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	// Send the request & save response to $resp
	$resp = curl_exec($curl);
	// Close request to clear up some resources
	curl_close($curl);
		
	$obj = json_decode($resp);


	$entries = [];
	foreach($obj as $k => $cur)
	{
		$table_headers = ["Date","Entity","Product (QTY) (PPU)(€) (TP)(€)","TotalMerc(€)"];
		
		$LinhasDoc = $cur->{'LinhasDoc'};
		
		$products = [];
		foreach($LinhasDoc as $k => $cur2){
			if ($cur2->{'Quantidade'} != 0)
				$product = [$cur2->{'DescArtigo'},' (' .$cur2->{'Quantidade'} .') ',' (' .$cur2->{'PrecoUnitario'} .') ',' (' .$cur2->{'TotalILiquido'} .')'];
			array_push($products, $product);
		}
		//remove unnecessary from the json string
		$products = json_encode($products);
		$products_info = substr($products, 2, strlen($products)-4);  // returns "cde"
		$products_info = str_replace(array('"',',','['), '', htmlspecialchars($products_info , ENT_NOQUOTES));
		$products_info = str_replace(array(']'), '<br>', htmlspecialchars($products_info , ENT_NOQUOTES));
		
		$entry = [
				"Date"=> $cur->{'Data'},
				"Entity"=> '<a href="profile.php?clientName=' . $cur->{'Entidade'} .'">' .$cur->{'Entidade'}.'</a>',
				"Product (QTY) (PPU)(€) (TP)(€)" => $products_info,
				"TotalMerc(€)"=> $cur->{'TotalMerc'}
			];

		array_push($entries, $entry);
	}
	include('../templates/header.php');
	include('../templates/table.php');
	include('../templates/orderButton.php');
	include('../templates/footer.php');
?>
