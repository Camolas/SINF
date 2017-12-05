<script type="text/javascript">
	$(document).ready(function() {
		$("#add").click(function() {
			
			//var $obj = $('#form tbody>tr:first').clone(true);obj.insertAfter
			$('#form tbody:last').append('<tr class="product" style="width:100%;"><td style="width:60%;"><label>'+ $("#select_product option:selected").text() + '</label><input class="form-control" name="prod_code[]" placeholder="Product Code" value='+ $("#select_product").val() + ' type="hidden"></td><td><input class="form-control" name="prod_quant[]" placeholder="Quantity" ></td><td><input class="form-control" name="prod_discount[]" placeholder="Discount" ></td></tr>');
		
		});
		
		$('#select_product').select2();
		});
</script>

<?php

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
							<td><input class="form-control" name="prod_code[]" placeholder="Product Code" type="text" value="<?php echo $products[$i][0]; ?>"></td>
							<td><input class="form-control" name="prod_quant[]" placeholder="Product Quantity" type="text" value="<?php echo $products[$i][1]; ?>"></td>
							<td><input class="form-control" name="prod_discount[]" placeholder="Product Discount" type="text" value="<?php echo $products[$i][2]; ?>"></td>
						</tr>
								
					<?php } ?>
					
					</tbody>
				</table>
				<br>
				<input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
				<input type="submit" class="btn btn-default btn" value="Submit">
			</form>
        </div>
		
		<br>
	</div>

