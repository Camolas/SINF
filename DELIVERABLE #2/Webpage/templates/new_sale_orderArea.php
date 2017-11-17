
<script type="text/javascript">
	$(document).ready(function() {
		$("#add").click(function() {
			$('#form tbody>tr:last').clone(true).insertAfter('#form tbody>tr:last');
			return false;
			});
		});
</script>
<?php
	
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
				<label>Entity</label>
				<input class="form-control" name="entity" placeholder="Entity">
				<br>
				<label>Serie</label>
				<input class="form-control" name="serie" placeholder="Serie">
				<br>
				<label>Products</label>
				<br>
				<a id="add"><button type="button" class="btn btn-primary btn-sm">Add Product</button></a>
				<br><br>
				<label>Product Code / Quantity / Discount / Unit price
				<table id="form">
					<tbody>
						<tr class="product">
							<td><input class="form-control" name="prod_code[]" placeholder="Product Code"></td>
							<td><input class="form-control" name="prod_quant[]" placeholder="Product Quantity"></td>
							<td><input class="form-control" name="prod_discount[]" placeholder="Product Discount"></td>
						</tr>
					</tbody>
				</table>
				<br>
				<input type="submit" class="btn btn-default btn" value="Submit">
			</form>
        </div>
		
		<br>
	</div>
