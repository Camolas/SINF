<?php

	// load clients
	$curl2 = curl_init();
	curl_setopt($curl2, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/clientes/');
	curl_setopt($curl2, CURLOPT_RETURNTRANSFER, TRUE);
	$resp2 = curl_exec($curl2);
	curl_close($curl2);	
	$obj2 = json_decode($resp2);
	
	// load products
	$curl4 = curl_init();
	curl_setopt($curl4, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/artigos/');
	curl_setopt($curl4, CURLOPT_RETURNTRANSFER, TRUE);
	$resp4 = curl_exec($curl4);
	curl_close($curl4);	
	$obj4 = json_decode($resp4);
	
	
	if (!empty($_GET["entity"]) && !empty($_GET["serie"]))
	{	
		$code_array = $_GET['prod_code'];
		$products = array();
		for ($i=0;$i < sizeof($code_array); $i++)
		{
			if (!empty($_GET["prod_code"]["$i"])){
				array_push($products, array('CodArtigo' =>$_GET["prod_code"]["$i"],'Quantidade' =>(int)$_GET["prod_quant"]["$i"],'Desconto' => (int)$_GET["prod_discount"]["$i"]));
			}
		}
		$order_id = urldecode($_GET["id"]);
		echo $order_id;
		
		$json = array( 'Entidade' => $_GET["entity"], 'Serie' => $_GET["serie"],'LinhasDoc' => $products);
		$sale = json_encode($json);
		echo $sale;
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt($curl, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/DocVenda/'. $order_id);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");    
		curl_setopt($curl, CURLOPT_HEADER, false);		
		curl_setopt($curl, CURLOPT_POSTFIELDS, $sale);                                                                  
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',                                                                                
		'Content-Length: ' . strlen($sale))                                                                       
		); 
			
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// Close request to clear up some resources
		
		curl_close($curl);
		echo "<script>location.href='../pages/sales_orders.php';</script>";
	
	}
	else
	{
		// Get cURL resource
		$curl2 = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt($curl2, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/DocVenda/?serie='. $_GET["serie"].'&id=' .$_GET["docNum"]);
		curl_setopt($curl2, CURLOPT_RETURNTRANSFER, TRUE);
		// Send the request & save response to $resp
		$resp2 = curl_exec($curl2);
		// Close request to clear up some resources
		curl_close($curl2);
			
		$obj = json_decode($resp2);
		
		$LinhasDoc = $obj->{'LinhasDoc'};
			
		$products = [];
		foreach($LinhasDoc as $k => $cur2){
			if ($cur2->{'Quantidade'} != 0)
				$product = [$cur2->{'CodArtigo'},$cur2->{'Quantidade'},$cur2->{'Desconto'},$cur2->{'PrecoUnitario'}];
				array_push($products, $product);
		}
		
	}
	

	

?>


	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Order</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
	

	
	<div class="well">
	
		<div class="form-group">
			<form action="edit_sale_order.php">
				<label>Entity</label>
				<input class="form-control" name="entity" placeholder="Entity" type="text" readonly value="<?php echo $obj->{'Entidade'}; ?>">
				<br>
				<label>Serie</label>
				<input class="form-control" name="serie" placeholder="Serie" type="text" readonly value="<?php echo $obj->{'Serie'}; ?>">
				<br>
				<label>Products</label>
				<br>
				<select id="select_product">
					<option value=""></option>
					<?php 
						foreach($obj4 as $k => $cur)
						{?>
							<option value="<?php echo $cur->{'CodArtigo'}; ?>"> <?php echo ($cur->{'CodArtigo'} . " | " . $cur->{'DescArtigo'} . " | " . $cur->{'STKAtual'}. "<br>"); ?> </option>;
					<?php } ?>
				</select>
				<a id="add"><button type="button" class="btn btn-primary btn-sm">Add Product</button></a>
				<br><br>
				<label>Product Code / Quantity / Discount / Unit price
				<table id="form">
					<tbody>
					<?php
						for ($i = 0; $i < sizeof($products); $i++){?>
						<tr class="product">
							<td>
							<select id="select_product<?php echo $i ;?>">
								<option value=""></option>
								<?php 
									foreach($obj4 as $k => $cur)
									{   if ($products[$i][0] == $cur->{'CodArtigo'}){?>
											<option value="<?php echo $cur->{'CodArtigo'}; ?>" selected> <?php echo ($cur->{'CodArtigo'} . " | " . $cur->{'DescArtigo'} . " | " . $cur->{'STKAtual'}. "<br>"); ?> </option>
									<?php }else{ ?>
											<option value="<?php echo $cur->{'CodArtigo'}; ?>" > <?php echo ($cur->{'CodArtigo'} . " | " . $cur->{'DescArtigo'} . " | " . $cur->{'STKAtual'}. "<br>"); ?> </option>
									<?php }} ?>
							</select>
							
							<input class="form-control" name="prod_code[]" placeholder="Product Code" value="<?php echo $products[$i][0]; ?>" type="hidden">
						
							</td>
							<td><input class="form-control" name="prod_quant[]" placeholder="Product Quantity" value="<?php echo $products[$i][1]; ?>"></td>
							<td><input class="form-control" name="prod_discount[]" placeholder="Product Discount" value="<?php echo $products[$i][2]; ?>"></td>
							<td> <a class="delete" ><button type="button" class="btn btn-danger btn-xs">Delete</button></a></td>
						</tr>
								
					<?php } ?>
					
					</tbody>
				</table>
				<label>Total price: </label>
				<label id="price">0</label>
				<br>
				<label>Total price(w/ IVA): </label>
				<label id="priceIVA">0</label>
				<br>
				<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
				<input type="submit" class="btn btn-default btn" value="Submit">
			</form>
        </div>
		
		<br>
	</div>

<script type="text/javascript">
	$(document).ready(function() {
		
		var clients_json = <?php echo json_encode($obj2);?>;
		var products_json = <?php echo json_encode($obj4);?>;
		var array_prices = [];
		var array_prices_IVA = [];

		$("#add").click(function() {			
			//var $obj = $('#form tbody>tr:first').clone(true);obj.insertAfter
			$('#form tbody:last').append('<tr class="product" style="width:100%;"><td style="width:60%;"><label>'+ $("#select_product option:selected").text() + '</label><input class="form-control" name="prod_code[]" placeholder="Product Code" value='+ $("#select_product").val() + ' type="hidden"></td><td><input class="form-control" name="prod_quant[]" value="1" placeholder="Quantity" ></td><td><input class="form-control" name="prod_discount[]" value="0" placeholder="Discount" ></td><td><a class="delete" ><button type="button" class="btn btn-danger btn-xs">Delete</button></a></td></tr>');
			$("#form").trigger("change");
		});
		
		$('#select_product').select2();
		
		$('select')
			.filter(function() {
				return this.id.match(/select_product[0-99]/);
			}).select2();
		
		$('select')
			.filter(function() {
				return this.id.match(/select_product[0-99]/);
			}).load(function(){
			var id = this.id.match(/\d+/);
			var k = 0;
			$('input[name^="prod_code"]').each(function() {
				if (k == id[0])
					$('#select_product'+id[0]+' option[value="'+ $(this).val() +'"]').attr('selected', 'selected');
				k++;
			});	
			$("#form").trigger("change");
		});
				
		$('select')
			.filter(function() {
				return this.id.match(/select_product[0-99]/);
			}).change(function(){
			var id = this.id.match(/\d+/);
			var new_value = this.value;
			var k = 0;
			$('input[name^="prod_code"]').each(function() {
				if (k == id[0])
					$(this).val(new_value);
				k++;
			});	
			$("#form").trigger("change");
		});
		
		$("#form").change(function() {
			var price;
			var undef_tr = 1;//first tr is empty
			$("#price").empty();
			$("#priceIVA").empty();
			var rowCount = $('#form tr').length;
			console.log (rowCount);
			array_prices = [];
			array_prices_IVA = [];
			var pvp = 0;
			for (k = 0; k < Object.keys(clients_json).length; k++){
				if (clients_json[k].CodCliente == $('input[name^="entity"]').val()){
					pvp = clients_json[k].PVP;
				}
			}
			
			$("tr").each(function() {

				var prod_code = $(this).find('input[name^="prod_code"]').val();
				console.log(prod_code);
				var i = 0;
				for (i = 0; i < Object.keys(products_json).length; i++){
					if (products_json[i].CodArtigo == prod_code){
						var prod_quant = $(this).find('input[name^="prod_quant"]').val();
						var prod_discount = $(this).find('input[name^="prod_discount"]').val();
						console.log(products_json[i].PVP1);
						if (prod_quant > 0){
							var unit_price = 0;
							if (pvp == 1)
								unit_price = products_json[i].PVP1;
							else if (pvp == 2)
								unit_price = products_json[i].PVP2;
							else if (pvp == 3)
								unit_price = products_json[i].PVP3;
							var price = (unit_price*(1-(prod_discount*0.01))) * prod_quant;
							var priceIVA = ((unit_price*(1-(prod_discount*0.01)))+((unit_price*(1-(prod_discount*0.01)))*(products_json[i].IVA *0.01))) * prod_quant;
							price = price.toFixed(2);
							priceIVA = priceIVA.toFixed(2);
							//console.log(price);
							//console.log(priceIVA);
							array_prices.push(price);
							array_prices_IVA.push(priceIVA);
							//console.log(array_prices.length);
							if (array_prices.length == rowCount){
								$("#price").append(price);
								$("#priceIVA").append(priceIVA);
							}
							else{
								$("#price").append(price + " + ");
								$("#priceIVA").append(priceIVA + " + ");
							}
						}
					}
				}

			});
			
			var total_price = 0;
			var total_price_IVA = 0;
			for(var j=0;j < array_prices.length; j++) 
			{ 
				//console.log(array_prices[j]);
				//console.log(array_prices_IVA[j]);
				total_price += parseFloat(array_prices[j]); 
				total_price_IVA += parseFloat(array_prices_IVA[j]); 
			}
			$("#price").append(" = " + total_price + " €");
			$("#priceIVA").append(" = " + total_price_IVA + " €");
		});
		
		
		
		$("#form").on("click",".delete",function() {
        var td = $(this).parent();
        var tr = td.parent();
        tr.fadeOut(200, function(){
            tr.remove();
			$("#form").trigger("change");
			});
		});
		
		$("#form").trigger("change");
	});
</script>
