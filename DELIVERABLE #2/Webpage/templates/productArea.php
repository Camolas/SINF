
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
