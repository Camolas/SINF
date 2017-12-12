

<?php
if (!empty($_GET["CodCliente"]) && !empty($_GET["NumContribuinte"]))
	{
		
		
		$json = array( 	'Morada' => $_GET["Morada"],
						'CodCliente' => $_GET["CodCliente"],
						'NomeCliente' => $_GET["NomeCliente"],
						'NumContribuinte' => $_GET["NumContribuinte"],
						'Moeda' => $_GET["Moeda"],
						'Email' => $_GET["Email"],
						'Telefone' => $_GET["Telefone"]);
						
		
		$client = json_encode($json);
		echo $client;
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt($curl, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/clientes/');
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($curl, CURLOPT_POSTFIELDS, $client);                                                                  
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',                                                                                
		'Content-Length: ' . strlen($client))                                                                       
		); 
			
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// Close request to clear up some resources
		
		curl_close($curl);
		echo "<script>location.href='../pages/sales_orders.php';</script>";
	
	}
?>


<div class="well">

	<div class="form-group">
	
		<form action="new_client.php">
			
			<label>Client code:</label><br>
			<input class="form-control" placeholder="Client Code" name="CodCliente" required><br>
			
			<label>Client name:</label><br>
			<input class="form-control" placeholder="Client Name" name="NomeCliente"><br>
			
			<label>NIF:</label><br>
			<input class="form-control" placeholder="NIF" name="NumContribuinte" required><br>
			
			<!--<label>Currency:</label><br>
			<input class="form-control" placeholder="Currency" name="Moeda"><br>-->
			
			<label>Adress:</label><br>
			<input class="form-control" placeholder="Adress" name="Morada"><br>
			
			<label>Email:</label><br>
			<input class="form-control" placeholder="Email" name="Email"><br>
			
			<label>Phone number:</label><br>
			<input class="form-control" placeholder="Telefone" name="Telefone"><br>
			
			<input type="submit" class="btn btn-default btn" value="Submit">
		</form>
	</div>
	
	<br>
</div>