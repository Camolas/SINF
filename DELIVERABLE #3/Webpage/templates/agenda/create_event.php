<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">New Event</h1>
	</div>
</div>



<div class="well">

	<div class="form-group">
		<form action="<?= $BASE_URL?>actions/event/create_event.php" method="post">
			<label>Title</label>
			<input class="form-control" name="title" required>
			<br>
			<label>Type</label>
			<select class="form-control" name="type">
				<option value="Compromisso">Compromisso</option>
				<option value="Envio de Carta">Envio de Carta</option>
				<option value="Reunião">Reunião</option>
				<option value="Envio de Email">Envio de Email</option>
				<option value="Telefonema">Telefonema</option>
				<option value="Cobrança">Cobrança</option>
				<option value="Tarefa">Tarefa</option>
				<option value="Envio de Proposta">Envio de Proposta</option>
				<option value="Apresentação de proposta">Apresentação de proposta</option>
			</select>
			<br>
			<label>Client</label>
			<br>
			<select id="customer_id" name="client">
				<?php
				foreach($clients as $id => $client){
					if(strcmp($client['CodCliente'], $_GET['CodCliente']) == 0){ ?>
						<option value="<?= $client['CodCliente']?>" selected="selected"><?= $client['NomeCliente']?> </option>;
					<?php } else {?>
						<option value="<?= $client['CodCliente']?>"><?= $client['NomeCliente']?> </option>;
					<?php }
				} ?>
			</select>
			<br>
			<br>
			<label>Location</label>
			<input class="form-control" name="location">
			<br>
			<label>Notes</label>
			<textarea class="form-control" rows="4" name="notes"></textarea>
			<br>
			<label>Start Date</label>
			<input class="form-control" type="datetime-local" value="<?= date("Y-m-d") . 'T' . (date('H') - date('O')[2]) . date(':i')?>" name="start_date">

			<br>
			<label>End Date</label>
			<input class="form-control" type="datetime-local" value="<?= date("Y-m-d") . 'T' . (date('H') - date('O')[2]) . date(':i')?>" name="end_date">
			<br>
			<label>Opportunity</label>
			<br>
			<select id="opportunities" name="opportunity_id">
				<option value="null">No Opporunity</option>
				<?php foreach($oports as $oppotunity){
					if(strcmp($oppotunity['opportunity_id'], $_GET['opportunity_id']) == 0){ ?>
						<option value="<?= $oppotunity['opportunity_id']?>" selected="selected"><?= $oppotunity['opportunity_type']?>: <?= $oppotunity['customer_name']?> (<?= $oppotunity['product_name']?>) </option>
					<?php } else { ?>
						<option value="<?= $oppotunity['opportunity_id']?>"><?= $oppotunity['opportunity_type']?>: <?= $oppotunity['customer_name']?> (<?= $oppotunity['product_name']?>) </option>
					<?php }
				} ?>
			</select>
			<br>
			<br>
			<input type="submit" class="btn btn-default btn" value="Create">
		</form>
	</div>
	<br>
</div>

<script type="text/javascript">
$('#customer_id').select2();
$('#opportunities').select2();
</script>
