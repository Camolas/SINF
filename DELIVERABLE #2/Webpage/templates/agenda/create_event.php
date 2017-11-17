	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">New Event</h1>
        </div>
    </div>
	

	
	<div class="well">
	
		<div class="form-group">
			<form action="<?= $BASE_URL?>actions/event/create_event.php" method="post">
				<label>Title</label>
				<input class="form-control" name="title">
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
				<input class="form-control" name="client" value="SOFRIO">
				<br>
				<label>Location</label>
				<input class="form-control" name="location">
				<br>
				<label>Notes</label>
				<textarea class="form-control" rows="3" name="notes"></textarea>
				<br>
				<label>Strating Date</label>
				<input class="form-control" type="datetime-local" value="<?= date("Y-m-d") . 'T' . date('h:i')?>" name="start_date">
				
				<br>
				<label>Ending Date</label>
				<input class="form-control" type="datetime-local" value="<?= date("Y-m-d") . 'T' . date('h:i')?>" name="end_date">
				<br>
				<br>
				<input type="submit" class="btn btn-default btn" value="Create">
			</form>
        </div>
		<br>
	</div>
