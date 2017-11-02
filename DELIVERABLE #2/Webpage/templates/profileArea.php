<div id="page-wrapper">
	
	<?php
	// Get cURL resource
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt($curl, CURLOPT_URL, 'http://localhost:49822/api/clientes/SSE');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	// Send the request & save response to $resp
	$resp = curl_exec($curl);
	// Close request to clear up some resources
	curl_close($curl);
	?>	
	
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Profile</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="well">
        <?php
			$obj = json_decode($resp);
			print "Nome Cliente: ";
			print $obj->{'NomeCliente'};
			echo '<br>';
			print "Numero Contribuinte: ";
			print $obj->{'NumContribuinte'};
			echo '<br>';
			print "Moeda: ";
			print $obj->{'Moeda'};
			echo '<br>';
			print "Morada: ";
			print $obj->{'Morada'};
		?>
    </div>
</div>