
	<?php
	
	// Get cURL resource
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt($curl, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/Artigos/' . $_GET["id"]);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	// Send the request & save response to $resp
	$resp = curl_exec($curl);
	// Close request to clear up some resources
	curl_close($curl);
	
	// Get cURL resource
	$curl2 = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt($curl2, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/DocVenda/' . $_GET["id"]);
	curl_setopt($curl2, CURLOPT_RETURNTRANSFER, TRUE);
	// Send the request & save response to $resp
	$resp2 = curl_exec($curl2);
	// Close request to clear up some resources
	curl_close($curl2);
		
	$obj2 = json_decode($resp2);


	$entries = [];
	foreach($obj2 as $k => $cur)
	{
		$table_headers = ["Date","Entity","Serie(NumDoc)","QTY","PPU","Total Price"];
		
		$LinhasDoc = $cur->{'LinhasDoc'};
		
		$products = [];
		$cod_arts =[];
		foreach($LinhasDoc as $k => $cur2){
			if ($cur2->{'Quantidade'} != 0){
				$product_quant = $cur2->{'Quantidade'};
				$product_unit_price = $cur2->{'PrecoUnitario'};
				$product_liquid = $cur2->{'TotalLiquido'};
			}
		}
		
		$entry = [
				"Date"=> $cur->{'Data'},
				"Entity"=> '<a href="profile.php?clientName=' . $cur->{'Entidade'} .'">' .$cur->{'Entidade'}.'</a>',
				"Serie(NumDoc)"=> $cur->{'Serie'}.' ('.$cur->{'NumDoc'}. ') ',
				"QTY" => $product_quant,
				"PPU" => $product_unit_price,
				"Total Price" => $product_liquid
			];
		
			
		array_push($entries, $entry);
	}
	
	
	
	?>	
	
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Product</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="well">
        <?php
			$obj = json_decode($resp);
			print "Product code: ";
			print $_GET["id"];
			echo '<br>';
			print "Description: ";
			print $obj->{'DescArtigo'};
			echo '<br>';
			print "Stock atual: ";
			print $obj->{'STKAtual'};
			echo '<br>';
			print "PVP1: ";
			print $obj->{'PVP1'};
			echo '<br>';
			print "PVP2: ";
			print $obj->{'PVP2'};
			echo '<br>';
			print "PVP3: ";
			print $obj->{'PVP3'};
			echo '<br>';
			print "Total earnings(€): ";
			print $obj->{'TotalEarnings'};
		?>
    </div>
