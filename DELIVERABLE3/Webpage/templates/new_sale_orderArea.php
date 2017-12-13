

<?php
	// load clients
	$curl2 = curl_init();
	curl_setopt($curl2, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/clientes/');
	curl_setopt($curl2, CURLOPT_RETURNTRANSFER, TRUE);
	$resp2 = curl_exec($curl2);
	curl_close($curl2);	
	$obj2 = json_decode($resp2);
	
	
	// load series
	$curl3 = curl_init();
	curl_setopt($curl3, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/series/');
	curl_setopt($curl3, CURLOPT_RETURNTRANSFER, TRUE);
	$resp3 = curl_exec($curl3);
	curl_close($curl3);	
	$obj3 = json_decode($resp3);
	
	// load products
	$curl4 = curl_init();
	curl_setopt($curl4, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/artigos/');
	curl_setopt($curl4, CURLOPT_RETURNTRANSFER, TRUE);
	$resp4 = curl_exec($curl4);
	curl_close($curl4);	
	$obj4 = json_decode($resp4);
	
	
	/*foreach($obj4 as $k => $cur)
	{
		echo $cur->{'CodArtigo'};echo ( '<br>');//echo $cur->{'DescArtigo'};echo ( '<br>');echo $cur->{'STKAtual'};echo ( '<br>');
	}*/
	

	
	if (!empty($_GET["entity"]) && !empty($_GET["serie"]) && !empty($_GET["prod_code"]) && !empty($_GET["prod_quant"]))
	{
		$code_array = $_GET['prod_code'];
		print_r($code_array);
		echo sizeof($code_array);
		$first = $_GET['prod_code']['0'];
		$sec = $_GET['prod_code']['1'];
		echo $first;
		echo $sec;
		
		$products = array();
		for ($i=0;$i < sizeof($code_array); $i++)
		{
			array_push($products, array('CodArtigo' =>$_GET["prod_code"]["$i"],'Quantidade' =>(int)$_GET["prod_quant"]["$i"],'Desconto' => (int)$_GET["prod_discount"]["$i"]));
		}
		
		$json = array( 'Entidade' => $_GET["entity"], 'Serie' => $_GET["serie"],'LinhasDoc' => $products );
		$sale = json_encode($json);
		echo $sale;
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt($curl, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/DocVenda/');
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
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
		//echo "An error occurred.";
	}
	

?>


	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">New Order</h1>
        </div>
    </div>
	

	
	<div class="well">
	
		<div class="form-group">
		
			<form action="new_sale_order.php">
				
				<label>Entity</label><br>
				<select class="js-example-basic-single" id="select_entity">
					<option value=""></option>
					<?php 
						foreach($obj2 as $k => $cur)
						{?>
							<option value="<?php echo $cur->{'CodCliente'}; ?>"> <?php echo $cur->{'CodCliente'}; ?> </option>;
					<?php } ?>
				</select>
	
				<input class="form-control" name="entity" placeholder="Entity" id="entity_input" value="example" type="hidden">
				<br><br>
				
				<label>Serie</label><br>
				<select class="js-example-basic-single" id="select_serie">
					<option value=""></option>
					<?php 
						foreach($obj3 as $k => $cur)
						{?>
							<option value="<?php echo $cur->{'CodSerie'}; ?>"> <?php echo $cur->{'CodSerie'}; ?> </option>;
					<?php } ?>
				</select>
				
				<input class="form-control" name="serie" placeholder="Serie" id="serie_input" value="example" type="hidden">
				<br><br>
				
				<label>Products( Product code | Name | Actual Stock )</label>
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
				<label>Product / Quantity / Discount</label>
				
				<table id="form" >
					<tbody>
						<tr class="product" >
							<td><input class="form-control" name="prod_code[]" placeholder="Product Code" type="hidden" disabled></td>
							<td><input class="form-control" name="prod_quant[]" placeholder="Product Quantity" type="hidden" disabled></td>
							<td><input class="form-control" name="prod_discount[]" placeholder="Product Discount" type="hidden" disabled></td>
						</tr>
					</tbody>
				</table>
				<label>Total price: </label>
				<label id="price">0</label>
				<br>
				<label>Total price(w/ IVA): </label>
				<label id="priceIVA">0</label>
				<br>
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
		
		$("#delete").click(function() {
			 $(this).closest('td').remove();
			 $("#form").trigger("change");
		});
		
		$('.js-example-basic-single').select2({
			width:'fit',
			dropdownAutoWidth : true,
			allowClear: true,
			placeholder: "Select an option",
			});
			

		
		$("#select_entity").change(function(){
			$("#entity_input").val(this.value);
			$("#form").trigger("change");
			
		});
		
		$("#select_serie").change(function(){
			$("#serie_input").val(this.value);
		});
		
		$('#select_product').select2();
		
		$("#form").change(function() {
			var price;
			var undef_tr = 1;//first tr is empty
			$("#price").empty();
			$("#priceIVA").empty();
			var rowCount = $('#form tr').length;
			//console.log (rowCount);
			array_prices = [];
			array_prices_IVA = [];
			var pvp = 0;
			for (k = 0; k < Object.keys(clients_json).length; k++){
				if (clients_json[k].CodCliente == $("#entity_input").val()){
					pvp = clients_json[k].PVP;
				}
			}
			
			$("tr").each(function() {
				if (undef_tr == 0){
					var prod_code = $(this).find('input[name^="prod_code"]').val();
					
					var i = 0;
					for (i = 0; i < Object.keys(products_json).length; i++){
						if (products_json[i].CodArtigo == prod_code){
							var prod_quant = $(this).find('input[name^="prod_quant"]').val();
							var prod_discount = $(this).find('input[name^="prod_discount"]').val();
							//console.log(products_json[i].PVP1);
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
								if (array_prices.length == rowCount-1){
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
				}
				else
					undef_tr = 0;
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
		
		});
		

</script>
